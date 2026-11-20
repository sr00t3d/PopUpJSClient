<?php
/**
 * +============================================================================+
 * | lib/ModuleController.php                                                   |
 * | PopUpJSClient WHMCS Addon Module v2.0.0                                    |
 * | Addon configuration, schema lifecycle, input validation, and i18n loader.  |
 * |                                                                            |
 * | Copyright 2024-2026 Percio Castelo                                         |
 * | SPDX-License-Identifier: Apache-2.0                                        |
 * +============================================================================+
 */

declare(strict_types=1);

namespace WHMCS\Module\Addon\popupjsclient;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;
use WHMCS\Module\Addon\popupjsclient\Model as Announcement;
use WHMCS\Module\Addon\popupjsclient\ModuleView as AnnouncementView;

class ModuleController
{
    public const VERSION = '2.0.0';

    public static function config(): array
    {
        return [
            'name' => 'PopUpJSClient',
            'description' => 'Display targeted, prioritized, scheduled modal announcements in the WHMCS client area.',
            'version' => self::VERSION,
            'author' => 'Percio Castelo',
            'author_email' => 'contato@perciocastelo.com.br',
            'fields' => [],
        ];
    }

    public static function activate(): array
    {
        try {
            if (!Capsule::schema()->hasTable('tbl_popupjsclient_lists')) {
                Capsule::schema()->create('tbl_popupjsclient_lists', function ($table) {
                    $table->increments('id');
                    $table->text('announcement');
                    $table->timestamp('start_at')->nullable();
                    $table->timestamp('created_at')->useCurrent();
                    $table->timestamp('expires_at')->nullable();
                    $table->string('user_group')->nullable();
                    $table->integer('views')->default(0);
                    $table->boolean('is_multimedia')->default(false);
                    $table->text('url');
                    $table->integer('priority')->default(3);
                });
            }
        } catch (Exception $e) {
            return ['status' => 'error', 'description' => 'Unable to create table: ' . $e->getMessage()];
        }

        return ['status' => 'success', 'description' => 'PopUpJSClient v' . self::VERSION . ' activated successfully.'];
    }

    public static function deactivate(): array
    {
        try {
            Capsule::schema()->dropIfExists('tbl_popupjsclient_lists');
        } catch (Exception $e) {
            return ['status' => 'error', 'description' => 'Unable to drop table: ' . $e->getMessage()];
        }

        return ['status' => 'success', 'description' => 'PopUpJSClient deactivated successfully.'];
    }

    /**
     * Normalize and validate announcement payload from POST input.
     *
     * @param array<string, mixed> $input
     * @return array<string, mixed>
     */
    public static function sanitizePayload(array $input): array
    {
        $rawStart = trim((string)($input['start_at'] ?? ''));
        $rawExpires = trim((string)($input['expires_at'] ?? ''));
        $rawGroup = trim((string)($input['user_group'] ?? ''));
        $rawUrl = trim((string)($input['url'] ?? ''));

        $safeUrl = '';
        if ($rawUrl !== '' && preg_match('#^https?://#i', $rawUrl) === 1) {
            $safeUrl = filter_var($rawUrl, FILTER_SANITIZE_URL) ?: '';
        }

        $priority = (int)($input['priority'] ?? 3);
        if ($priority < 1 || $priority > 99) {
            $priority = 3;
        }

        return [
            'announcement' => trim((string)($input['announcement'] ?? '')),
            'start_at' => $rawStart !== '' ? $rawStart : null,
            'expires_at' => $rawExpires !== '' ? $rawExpires : null,
            'user_group' => $rawGroup !== '' ? $rawGroup : null,
            'is_multimedia' => !empty($input['is_multimedia']) ? 1 : 0,
            'url' => $safeUrl,
            'priority' => $priority,
        ];
    }

    /**
     * @param array<string, mixed> $vars
     * @throws Exception
     */
    public static function manage(array $vars): void
    {
        $lang = self::getLang($vars);
        $e = static fn(string $v): string => htmlspecialchars($v, ENT_QUOTES, 'UTF-8');

        if (isset($_POST['new_announcement'])) {
            $data = self::sanitizePayload($_POST);
            if ($data['announcement'] !== '') {
                try {
                    Announcement::add($data);
                    echo '<div class="successbox">' . $e($lang['add_announcement_success']) . '</div>';
                } catch (Exception $ex) {
                    echo '<div class="errorbox">' . $e($lang['add_announcement_error'] . $ex->getMessage()) . '</div>';
                }
            }
        }

        if (isset($_POST['edit_announcement'])) {
            $announcementId = (int)($_POST['announcement_id'] ?? 0);
            $data = self::sanitizePayload($_POST);
            if ($announcementId > 0 && $data['announcement'] !== '') {
                try {
                    Announcement::update($announcementId, $data);
                    echo '<div class="successbox">' . $e($lang['update_announcement_success']) . '</div>';
                } catch (Exception $ex) {
                    echo '<div class="errorbox">' . $e($lang['update_announcement_error'] . $ex->getMessage()) . '</div>';
                }
            }
        }

        if (isset($_POST['delete_announcement'])) {
            $announcementId = (int)($_POST['announcement_id'] ?? 0);
            if ($announcementId > 0) {
                try {
                    Announcement::delete($announcementId);
                    echo '<div class="successbox">' . $e($lang['delete_announcement_success']) . '</div>';
                } catch (Exception $ex) {
                    echo '<div class="errorbox">' . $e($lang['delete_announcement_error'] . $ex->getMessage()) . '</div>';
                }
            }
        }

        AnnouncementView::renderForm($lang, $_POST);
        $announcements = Announcement::getAll();
        AnnouncementView::renderAnnouncementsList($lang, $announcements);
    }

    /**
     * Load language dictionary safely (prevents directory traversal).
     *
     * @param array<string, mixed> $vars
     * @return array<string, string>
     */
    public static function getLang(array $vars = []): array
    {
        $rawLang = (string)($vars['language'] ?? ($GLOBALS['CONFIG']['Language'] ?? 'en'));
        $safeLang = preg_replace('/[^a-zA-Z0-9_-]/', '', strtolower($rawLang)) ?: 'en';
        $langFile = __DIR__ . '/../resources/lang/' . $safeLang . '.php';

        if (is_file($langFile)) {
            return include $langFile;
        }

        return include __DIR__ . '/../resources/lang/en.php';
    }
}
