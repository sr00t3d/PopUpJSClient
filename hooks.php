<?php

use WHMCS\Module\Addon\PopupJSClient\ModuleController as AnnouncementController;
use WHMCS\Module\Addon\PopupJSClient\Model as Announcement;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

add_hook('ClientAreaFooterOutput', 1, 'ClientAreaFooterOutput_ModuleView');

/**
 * @throws Exception
 */
function ClientAreaFooterOutput_ModuleView($vars)
{
    $lang = AnnouncementController::getLang($vars);
    $userGroup = $vars['clientsdetails']['groupid'] ?? null;
    $announcement = Announcement::getLatest($userGroup);

    if ($announcement && !empty($announcement->announcement)) {
        Announcement::incrementViews($announcement->id);
        $announcementText = addslashes($announcement->announcement);
        $interactionLink = $lang['interaction_link'];
        echo "<script>
            window.addEventListener('load', function() {
                var popup = document.createElement('div');
                popup.innerHTML = `
                    <div style=\"position: fixed; top: 20px; right: 20px; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.2);\">
                        <p>${announcementText}</p>
                        <a href=\"#\" onclick=\"this.parentElement.style.display='none'; return false;\">${interactionLink}</a>
                    </div>
                `;
                document.body.appendChild(popup);
            });
        </script>";
    }
}