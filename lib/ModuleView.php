<?php

namespace WHMCS\Module\Addon\popupjsclient;

class ModuleView {
    public static function renderForm($lang, $data = []) {
        echo '<div class="panel panel-default" style="padding: 20px; margin-bottom: 20px;">
                <div class="panel-heading" style="font-weight: bold; font-size: 16px;">' . $lang['add_edit_announcement'] . '</div>
                <div class="panel-body">
                    <form method="post" style="margin-bottom: 20px;">
                        <input type="hidden" name="announcement_id" value="' . ($data['announcement_id'] ?? '') . '">
                        <textarea name="announcement" rows="5" cols="100" placeholder="' . $lang['announcement_text_placeholder'] . '" class="form-control" style="margin-bottom: 10px;">' . ($data['announcement'] ?? '') . '</textarea><br>
                        <input type="date" name="start_at" placeholder="' . $lang['start_date'] . '" class="form-control" style="margin-bottom: 10px;" value="' . ($data['start_at'] ?? '') . '"><br>
                        <input type="date" name="expires_at" placeholder="' . $lang['expiration_date'] . '" class="form-control" style="margin-bottom: 10px;" value="' . ($data['expires_at'] ?? '') . '"><br>
                        <input type="text" name="user_group" placeholder="' . $lang['user_group'] . '" class="form-control" style="margin-bottom: 10px;" value="' . ($data['user_group'] ?? '') . '"><br>
                        <label><input type="checkbox" name="is_multimedia" ' . (isset($data['is_multimedia']) && $data['is_multimedia'] ? 'checked' : '') . '> ' . $lang['multimedia_announcement'] . '</label><br><br>
                        <input type="text" name="url" placeholder="' . $lang['url'] . '" class="form-control" style="margin-bottom: 10px;" value="' . ($data['url'] ?? '') . '"><br>
                        <input type="number" name="priority" placeholder="' . $lang['priority'] . '" class="form-control" style="margin-bottom: 10px;" value="' . ($data['priority'] ?? '3') . '"><br>
                        <input type="submit" name="new_announcement" value="' . $lang['add_announcement'] . '" class="btn btn-success">
                        <input type="submit" name="edit_announcement" value="' . $lang['edit_announcement'] . '" class="btn btn-primary">
                    </form>
                </div>
              </div>';
    }

    public static function renderAnnouncementsList($lang, $announcements) {
        echo '<div class="panel panel-default" style="padding: 20px;">
                <div class="panel-heading" style="font-weight: bold; font-size: 16px;">' . $lang['existing_announcements'] . '</div>
                <div class="panel-body">';
        foreach ($announcements as $announcement) {
            echo '<div class="alert alert-info" role="alert" style="margin-bottom: 10px; padding: 15px; border-radius: 8px;">
                    <strong>' . $lang['announcement'] . ':</strong><br>' . nl2br($announcement->announcement) . '<br>
                    <small>' . $lang['created_at'] . $announcement->created_at . '</small>
                    ' . ($announcement->expires_at ? '<br><small>' . $lang['expires_at'] . $announcement->expires_at . '</small>' : '') . '<br>
                    <small>' . $lang['priority_label'] . $announcement->priority . '</small><br>
                    <small>' . $lang['views_label'] . $announcement->views . '</small>
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="announcement_id" value="' . $announcement->id . '">
                        <input type="hidden" name="announcement" value="' . htmlspecialchars($announcement->announcement) . '">
                        <input type="hidden" name="start_at" value="' . $announcement->start_at . '">
                        <input type="hidden" name="expires_at" value="' . $announcement->expires_at . '">
                        <input type="hidden" name="user_group" value="' . $announcement->user_group . '">
                        <input type="hidden" name="is_multimedia" value="' . $announcement->is_multimedia . '">
                        <input type="hidden" name="url" value="' . $announcement->url . '">
                        <input type="hidden" name="priority" value="' . $announcement->priority . '">
                        <input type="submit" name="edit_announcement" value="' . $lang['edit'] . '" class="btn btn-warning btn-sm" style="margin-top: 10px;">
                        <input type="submit" name="delete_announcement" value="' . $lang['delete'] . '" class="btn btn-danger btn-sm" style="margin-top: 10px;">
                    </form>
                  </div>';
        }
        echo '</div></div>';
    }
}
