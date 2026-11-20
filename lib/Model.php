<?php
/**
 * +============================================================================+
 * | lib/Model.php                                                              |
 * | PopUpJSClient WHMCS Addon Module v2.0.0                                    |
 * | Database access layer with properly grouped scheduling & group predicates. |
 * |                                                                            |
 * | Copyright 2024-2026 Percio Castelo                                         |
 * | SPDX-License-Identifier: Apache-2.0                                        |
 * +============================================================================+
 */

declare(strict_types=1);

namespace WHMCS\Module\Addon\popupjsclient;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Collection;

class Model
{
    private const TABLE = 'tbl_popupjsclient_lists';

    /**
     * @param array<string, mixed> $data
     * @throws Exception
     */
    public static function add(array $data): bool
    {
        try {
            return Capsule::table(self::TABLE)->insert($data);
        } catch (Exception $e) {
            throw new Exception('Failed to add announcement: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * @param int $announcementId
     * @param array<string, mixed> $data
     * @throws Exception
     */
    public static function update(int $announcementId, array $data): int
    {
        try {
            return Capsule::table(self::TABLE)
                ->where('id', $announcementId)
                ->update($data);
        } catch (Exception $e) {
            throw new Exception('Failed to update announcement: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * @param int $announcementId
     * @throws Exception
     */
    public static function delete(int $announcementId): int
    {
        try {
            return Capsule::table(self::TABLE)
                ->where('id', $announcementId)
                ->delete();
        } catch (Exception $e) {
            throw new Exception('Failed to delete announcement: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * @throws Exception
     */
    public static function getAll(): Collection
    {
        try {
            return Capsule::table(self::TABLE)
                ->orderBy('priority', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (Exception $e) {
            throw new Exception('Failed to retrieve announcements: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Fetch the highest-priority active announcement matching the user's group.
     * Uses properly nested WHERE groups so OR predicates never bypass scheduling.
     *
     * @param int|string|null $userGroup
     * @return object|null
     * @throws Exception
     */
    public static function getLatest($userGroup)
    {
        try {
            return Capsule::table(self::TABLE)
                ->where(function ($q) {
                    $q->whereNull('expires_at')
                      ->orWhere('expires_at', '>', Capsule::raw('NOW()'));
                })
                ->where(function ($q) {
                    $q->whereNull('start_at')
                      ->orWhere('start_at', '<=', Capsule::raw('NOW()'));
                })
                ->where(function ($q) use ($userGroup) {
                    $q->whereNull('user_group')
                      ->orWhere('user_group', '=', '');
                    if ($userGroup !== null && $userGroup !== '') {
                        $q->orWhere('user_group', '=', (string)$userGroup);
                    }
                })
                ->orderBy('priority', 'asc')
                ->orderBy('created_at', 'desc')
                ->first();
        } catch (Exception $e) {
            throw new Exception('Failed to retrieve the latest announcement: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * @param int $announcementId
     * @throws Exception
     */
    public static function incrementViews(int $announcementId): int
    {
        try {
            return Capsule::table(self::TABLE)
                ->where('id', $announcementId)
                ->increment('views');
        } catch (Exception $e) {
            throw new Exception('Failed to increment views: ' . $e->getMessage(), 0, $e);
        }
    }
}
