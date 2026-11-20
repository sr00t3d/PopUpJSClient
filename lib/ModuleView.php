<?php
/**
 * +============================================================================+
 * | lib/ModuleView.php                                                         |
 * | PopUpJSClient WHMCS Addon Module v2.0.0                                    |
 * | Admin UI renderer with strict HTML escaping (XSS-safe).                    |
 * |                                                                            |
 * | Copyright 2024-2026 Percio Castelo                                         |
 * | SPDX-License-Identifier: Apache-2.0                                        |
 * +============================================================================+
 */

declare(strict_types=1);

namespace WHMCS\Module\Addon\popupjsclient;

class ModuleView
{
    private static function e($value): string
    {
        return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
    }

    /**
     * @param array<string, string> $lang
     * @param array<string, mixed> $data
     */
    public static function renderForm(array $lang, array $data = []): void
    {
        $checked = !empty($data['is_multimedia']) ? 'checked' : '';
        echo '<div class="panel panel-default" style="padding: 20px; margin-bottom: 20px;">'
            . '<div class="panel-heading" style="font-weight: bold; font-size: 16px;">' . self::e($lang['add_edit_announcement']) . '</div>'
            . '<div class="panel-body">'
            . '<form method="post" style="margin-bottom: 20px;">'
            . '<input type="hidden" name="announcement_id" value="' . self::e($data['announcement_id'] ?? '') . '">'
            . '<textarea name="announcement" rows="5" cols="100" placeholder="' . self::e($lang['announcement_text_placeholder']) . '" class="form-control" style="margin-bottom: 10px;">' . self::e($data['announcement'] ?? '') . '</textarea><br>'
            . '<input type="date" name="start_at" placeholder="' . self::e($lang['start_date']) . '" class="form-control" style="margin-bottom: 10px;" value="' . self::e($data['start_at'] ?? '') . '"><br>'
            . '<input type="date" name="expires_at" placeholder="' . self::e($lang['expiration_date']) . '" class="form-control" style="margin-bottom: 10px;" value="' . self::e($data['expires_at'] ?? '') . '"><br>'
            . '<input type="text" name="user_group" placeholder="' . self::e($lang['user_group']) . '" class="form-control" style="margin-bottom: 10px;" value="' . self::e($data['user_group'] ?? '') . '"><br>'
            . '<label><input type="checkbox" name="is_multimedia" ' . $checked . '> ' . self::e($lang['multimedia_announcement']) . '</label><br><br>'
            . '<input type="url" name="url" placeholder="' . self::e($lang['url']) . '" class="form-control" style="margin-bottom: 10px;" value="' . self::e($data['url'] ?? '') . '"><br>'
            . '<input type="number" name="priority" min="1" max="99" placeholder="' . self::e($lang['priority']) . '" class="form-control" style="margin-bottom: 10px;" value="' . self::e($data['priority'] ?? '3') . '"><br>'
            . '<input type="submit" name="new_announcement" value="' . self::e($lang['add_announcement']) . '" class="btn btn-success"> '
            . '<input type="submit" name="edit_announcement" value="' . self::e($lang['edit_announcement']) . '" class="btn btn-primary">'
            . '</form>'
            . '</div>'
            . '</div>';
    }

    /**
     * @param array<string, string> $lang
     * @param iterable<object> $announcements
     */
    public static function renderAnnouncementsList(array $lang, iterable $announcements): void
    {
        echo '<div class="panel panel-default" style="padding: 20px;">'
            . '<div class="panel-heading" style="font-weight: bold; font-size: 16px;">' . self::e($lang['existing_announcements']) . '</div>'
            . '<div class="panel-body">';

        foreach ($announcements as $announcement) {
            $id = (int)$announcement->id;
            echo '<div class="alert alert-info" role="alert" style="margin-bottom: 10px; padding: 15px; border-radius: 8px;">'
                . '<strong>' . self::e($lang['announcement']) . ':</strong><br>' . nl2br(self::e($announcement->announcement)) . '<br>'
                . '<small>' . self::e($lang['created_at']) . self::e($announcement->created_at) . '</small>'
                . (!empty($announcement->expires_at) ? '<br><small>' . self::e($lang['expires_at']) . self::e($announcement->expires_at) . '</small>' : '') . '<br>'
                . '<small>' . self::e($lang['priority_label']) . self::e($announcement->priority) . '</small><br>'
                . '<small>' . self::e($lang['views_label']) . self::e($announcement->views) . '</small>'
                . '<form method="post" style="display: inline;">'
                . '<input type="hidden" name="announcement_id" value="' . $id . '">'
                . '<input type="hidden" name="announcement" value="' . self::e($announcement->announcement) . '">'
                . '<input type="hidden" name="start_at" value="' . self::e($announcement->start_at) . '">'
                . '<input type="hidden" name="expires_at" value="' . self::e($announcement->expires_at) . '">'
                . '<input type="hidden" name="user_group" value="' . self::e($announcement->user_group) . '">'
                . '<input type="hidden" name="is_multimedia" value="' . self::e($announcement->is_multimedia) . '">'
                . '<input type="hidden" name="url" value="' . self::e($announcement->url) . '">'
                . '<input type="hidden" name="priority" value="' . self::e($announcement->priority) . '">'
                . '<input type="submit" name="edit_announcement" value="' . self::e($lang['edit']) . '" class="btn btn-warning btn-sm" style="margin-top: 10px;"> '
                . '<input type="submit" name="delete_announcement" value="' . self::e($lang['delete']) . '" class="btn btn-danger btn-sm" style="margin-top: 10px;">'
                . '</form>'
                . '</div>';
        }

        echo '</div></div>';
    }
}
