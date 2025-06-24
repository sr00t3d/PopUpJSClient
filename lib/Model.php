<?php

namespace WHMCS\Module\Addon\popupjsclient;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

class Model
{
    /**
     * @throws Exception
     */
    public static function add($data): bool
    {
        try {
            return Capsule::table('tbl_popupjsclient_lists')->insert($data);
        } catch (Exception $e) {
            throw new Exception("Failed to add announcement: " . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public static function update($announcement_id, $data): int
    {
        try {
            return Capsule::table('tbl_popupjsclient_lists')->where('id', $announcement_id)->update($data);
        } catch (Exception $e) {
            throw new Exception("Failed to update announcement: " . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public static function delete($announcement_id): int
    {
        try {
            return Capsule::table('tbl_popupjsclient_lists')->where('id', $announcement_id)->delete();
        } catch (Exception $e) {
            throw new Exception("Failed to delete announcement: " . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public static function getAll(): \Illuminate\Support\Collection
    {
        try {
            return Capsule::table('tbl_popupjsclient_lists')->orderBy('priority', 'asc')->orderBy('created_at', 'desc')->get();
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve announcements: " . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public static function getLatest($userGroup)
    {
        try {
            return Capsule::table('tbl_popupjsclient_lists')
                ->where(function ($query) use ($userGroup) {
                    $query->whereNull('expires_at')->orWhere('expires_at', '>', Capsule::raw('NOW()'));
                    $query->whereNull('start_at')->orWhere('start_at', '<=', Capsule::raw('NOW()'));
                    if ($userGroup) {
                        $query->where('user_group', '=', $userGroup)->orWhereNull('user_group');
                    }
                })
                ->orderBy('priority', 'asc')
                ->orderBy('created_at', 'desc')
                ->first();
        } catch (Exception $e) {
            throw new Exception("Failed to retrieve the latest announcement: " . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public static function incrementViews($announcement_id): int
    {
        try {
            return Capsule::table('tbl_popupjsclient_lists')->where('id', $announcement_id)->increment('views');
        } catch (Exception $e) {
            throw new Exception("Failed to increment views: " . $e->getMessage());
        }
    }
}
