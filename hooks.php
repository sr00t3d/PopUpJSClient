<?php
/**
 * +============================================================================+
 * | hooks.php                                                                  |
 * | PopUpJSClient WHMCS Addon Module v2.0.0                                    |
 * | ClientAreaFooterOutput hook rendering XSS-safe modal announcements with    |
 * | SameSite=Lax cookie dismissal, ESC/backdrop close, and URL validation.     |
 * |                                                                            |
 * | Copyright 2024-2026 Percio Castelo                                         |
 * | SPDX-License-Identifier: Apache-2.0                                        |
 * +============================================================================+
 */

declare(strict_types=1);

use WHMCS\Module\Addon\popupjsclient\Model as Announcement;
use WHMCS\Module\Addon\popupjsclient\ModuleController as AnnouncementController;

if (!defined('WHMCS')) {
    die('This file cannot be accessed directly');
}

add_hook('ClientAreaFooterOutput', 1, 'ClientAreaFooterOutput_ModuleView');

/**
 * Render the client-area announcement modal for authenticated users.
 *
 * @param array<string, mixed> $vars
 * @return string
 * @throws Exception
 */
function ClientAreaFooterOutput_ModuleView(array $vars): string
{
    if (empty($vars['loggedin'])) {
        return '';
    }

    $lang = AnnouncementController::getLang($vars);
    $userGroup = $vars['clientsdetails']['groupid'] ?? null;
    $announcement = Announcement::getLatest($userGroup);

    if (!$announcement || empty($announcement->announcement)) {
        return '';
    }

    Announcement::incrementViews((int)$announcement->id);

    $rawUrl = trim((string)($announcement->url ?? ''));
    $safeUrl = ($rawUrl !== '' && preg_match('#^https?://#i', $rawUrl) === 1) ? $rawUrl : '';

    $payload = [
        'id' => (int)$announcement->id,
        'isMultimedia' => (bool)$announcement->is_multimedia,
        'url' => $safeUrl,
        'text' => (string)$announcement->announcement,
        'seeMore' => (string)($lang['see_more'] ?? 'See more'),
        'interactionLink' => (string)($lang['interaction_link'] ?? 'Close'),
    ];

    $jsonPayload = json_encode(
        $payload,
        JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE
    );

    return <<<HTML
<style>
.areaModal {
    align-items: center;
    background-color: rgba(15, 23, 42, 0.78);
    display: flex;
    height: 100vh;
    justify-content: center;
    left: 0;
    position: fixed;
    top: 0;
    width: 100vw;
    z-index: 9999;
}
.areaModalVal {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    max-height: 85vh;
    max-width: 720px;
    min-height: 120px;
    overflow: auto;
    position: relative;
    width: 92%;
}
.areaModalButton {
    background: #e2f4fb;
    border: none;
    border-radius: 6px;
    color: #235498;
    cursor: pointer;
    font-size: 14px;
    font-weight: 700;
    margin: 12px;
    padding: 4px 14px;
    position: absolute;
    right: 0;
    top: 0;
}
.modalcontent {
    background: #f8fafc;
    border-radius: 6px;
    padding: 14px;
    white-space: pre-wrap;
}
</style>
<script>
(function () {
    var data = {$jsonPayload};

    function getCookie(name) {
        var parts = document.cookie.split(';');
        for (var i = 0; i < parts.length; i++) {
            var c = parts[i].trim();
            if (c.indexOf(name + '=') === 0) {
                return c.substring(name.length + 1);
            }
        }
        return null;
    }

    function setCookie(name, value, days) {
        var date = new Date();
        date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
        var secure = window.location.protocol === 'https:' ? '; Secure' : '';
        document.cookie = name + '=' + value + '; path=/; SameSite=Lax' + secure + '; expires=' + date.toUTCString();
    }

    function isSafeUrl(u) {
        return typeof u === 'string' && /^https?:\/\//i.test(u);
    }

    window.addEventListener('load', function () {
        var cookieName = 'modalDismissID_' + data.id;
        if (getCookie(cookieName)) {
            return;
        }

        var overlay = document.createElement('div');
        overlay.id = 'areaModal';
        overlay.className = 'areaModal';
        overlay.setAttribute('role', 'dialog');
        overlay.setAttribute('aria-modal', 'true');

        var dialog = document.createElement('div');
        dialog.id = 'areaModalVal';
        dialog.className = 'areaModalVal';

        function dismiss() {
            setCookie(cookieName, '1', 1);
            if (overlay.parentNode) {
                overlay.parentNode.removeChild(overlay);
            }
            document.removeEventListener('keydown', onKeyDown);
        }

        function onKeyDown(ev) {
            if (ev.key === 'Escape') {
                dismiss();
            }
        }

        if (data.isMultimedia && isSafeUrl(data.text)) {
            var img = document.createElement('img');
            img.src = data.text;
            img.alt = 'Announcement';
            img.style.maxWidth = '100%';
            img.style.display = 'block';
            if (isSafeUrl(data.url)) {
                var link = document.createElement('a');
                link.href = data.url;
                link.target = '_blank';
                link.rel = 'noopener noreferrer';
                link.appendChild(img);
                dialog.appendChild(link);
            } else {
                dialog.appendChild(img);
            }
        } else {
            var body = document.createElement('div');
            body.className = 'p-4';

            var badge = document.createElement('span');
            badge.className = 'badge badge-info';
            badge.textContent = 'Info';
            body.appendChild(badge);

            var content = document.createElement('div');
            content.className = 'modalcontent mt-3';
            content.textContent = data.text;
            body.appendChild(content);

            if (isSafeUrl(data.url)) {
                var ctaWrap = document.createElement('div');
                ctaWrap.className = 'mt-3';
                var cta = document.createElement('a');
                cta.href = data.url;
                cta.target = '_blank';
                cta.rel = 'noopener noreferrer';
                cta.className = 'btn btn-primary btn-sm';
                cta.textContent = data.seeMore;
                ctaWrap.appendChild(cta);
                body.appendChild(ctaWrap);
            }
            dialog.appendChild(body);
        }

        var closeBtn = document.createElement('button');
        closeBtn.type = 'button';
        closeBtn.className = 'areaModalButton';
        closeBtn.textContent = data.interactionLink;
        closeBtn.addEventListener('click', dismiss);
        dialog.appendChild(closeBtn);

        overlay.addEventListener('click', function (ev) {
            if (ev.target === overlay) {
                dismiss();
            }
        });
        document.addEventListener('keydown', onKeyDown);

        overlay.appendChild(dialog);
        document.body.appendChild(overlay);
    });
})();
</script>
HTML;
}
