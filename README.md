# PopUpJSClient (WHMCS Addon Module)

Readme: [PT-BR](README-ptbr.md)

[![License](https://img.shields.io/badge/license-Apache--2.0-blue.svg)](LICENSE)
[![Version](https://img.shields.io/badge/version-2.0.0-green.svg)](https://github.com/sr00t3d/PopUpJSClient/releases)
[![PHP](https://img.shields.io/badge/php-8.0+-blue.svg)](https://www.php.net/)

<img width="700" src="popupjsclient-cover.webp" alt="PopUpJSClient WHMCS Addon" />

**PopUpJSClient v2.0.0** is a WHMCS addon module in PHP 8+ and vanilla JavaScript for displaying targeted, prioritized, and scheduled modal announcements in the WHMCS Client Area. Version 2.0.0 introduces strict XSS protection, safe DOM construction, corrected SQL scheduling/group query precedence, path-traversal protection for language files, `SameSite=Lax` cookie dismissal, and ESC/backdrop keyboard accessibility.

---

## Features

- **Targeted & Scheduled Popups**: filter by WHMCS client group (`user_group`), schedule `start_at` and `expires_at` windows with properly nested SQL predicates, and rank by `priority`
- **Text & Multimedia Modals**: supports text announcements with CTA links or multimedia image banners
- **Hardened Security (v2.0.0)**:
  - Strict `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')` escaping across the WHMCS Admin UI (`lib/ModuleView.php`)
  - Safe DOM node construction (`textContent`, `JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT`) in `hooks.php` — zero `innerHTML` XSS vectors
  - Strict `https?://` URL allowlist rejecting `javascript:` and `data:` schemes
  - Path-traversal protection in `ModuleController::getLang()`
  - `SameSite=Lax` (plus `Secure` on HTTPS) dismiss cookie with 24-hour TTL
- **Accessible Modal UX**: `role="dialog"`, `aria-modal="true"`, Escape key dismissal, and backdrop click-to-close
- **Multilingual**: English, Portuguese (BR), Spanish, and Farsi dictionaries included in `resources/lang/`

---

## Requirements

- WHMCS 8.x
- PHP 8.0 or higher
- MySQL / MariaDB (via WHMCS `Illuminate\Database\Capsule\Manager`)

---

## Installation

1. Copy this repository into your WHMCS addons directory:
   ```bash
   /path/to/whmcs/modules/addons/popupjsclient/
   ```
2. Log in to **WHMCS Admin** -> **System Settings** -> **Addon Modules**.
3. Locate **PopUpJSClient**, click **Activate**, and grant access to the desired admin role groups.
4. Manage announcements under **Addons** -> **PopUpJSClient**.

---

## Real Output Example

Validated on AlmaLinux 8.10 with PHP 8.2.35 (`php -l` across all 11 PHP files + functional security harness):

```text
$ php -v | head -n 1
PHP 8.2.35 (cli) (built: Nov 10 2026 21:43:08) (NTS)

$ find /opt/src/PopUpJSClient -name '*.php' | sort | xargs -I{} php -l {}
No syntax errors detected in /opt/src/PopUpJSClient/hooks.php
No syntax errors detected in /opt/src/PopUpJSClient/lib/Model.php
No syntax errors detected in /opt/src/PopUpJSClient/lib/ModuleController.php
No syntax errors detected in /opt/src/PopUpJSClient/lib/ModuleView.php
No syntax errors detected in /opt/src/PopUpJSClient/popupjsclient.php
No syntax errors detected in /opt/src/PopUpJSClient/resources/lang/en.php
No syntax errors detected in /opt/src/PopUpJSClient/resources/lang/english.php
No syntax errors detected in /opt/src/PopUpJSClient/resources/lang/fa.php
No syntax errors detected in /opt/src/PopUpJSClient/resources/lang/farsi.php
No syntax errors detected in /opt/src/PopUpJSClient/resources/lang/portuguese-br.php
No syntax errors detected in /opt/src/PopUpJSClient/resources/lang/spanish.php

# Security & Functional Harness Output:
CONFIG: name=PopUpJSClient version=2.0.0 author=Percio Castelo
SANITIZE_BAD_URL: url='' start_at=NULL priority=3
SANITIZE_VALID_URL: url='https://perciocastelo.com.br/status' is_multimedia=1 priority=1
LANG_PT_BR: see_more='Veja mais'
LANG_TRAVERSAL_FALLBACK: see_more=''
XSS_CHECK: raw_script=BLOCKED escaped=YES
E2E_POPUP_PASS
```

---

## License

Apache-2.0. See [LICENSE](LICENSE) for details.

## Author

[Percio Castelo](https://perciocastelo.com.br)
