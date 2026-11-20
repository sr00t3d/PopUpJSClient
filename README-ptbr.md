# PopUpJSClient (Modulo Addon WHMCS)

Readme: [EN](README.md)

[![License](https://img.shields.io/badge/license-Apache--2.0-blue.svg)](LICENSE)
[![Version](https://img.shields.io/badge/version-2.0.0-green.svg)](https://github.com/sr00t3d/PopUpJSClient/releases)
[![PHP](https://img.shields.io/badge/php-8.0+-blue.svg)](https://www.php.net/)

<img width="700" src="popupjsclient-cover.webp" alt="PopUpJSClient WHMCS Addon" />

**PopUpJSClient v2.0.0** e um modulo addon para WHMCS em PHP 8+ e JavaScript puro para exibir avisos modais segmentados, priorizados e agendados na Area do Cliente do WHMCS. A versao 2.0.0 traz protecao estrita contra XSS, construcao segura de DOM, correcao da precedencia SQL em agendamento/segmentacao, bloqueio de path traversal no carregador de idiomas, cookie `SameSite=Lax` e acessibilidade com fechamento por ESC ou clique no fundo.

---

## Funcionalidades

- **Popups Segmentados e Agendados**: filtra por grupo de clientes WHMCS (`user_group`), agenda janelas `start_at` e `expires_at` com predicados SQL devidamente aninhados e ordena por `priority`
- **Modais de Texto e Multimidia**: suporta anuncios em texto com botao CTA ou banners de imagem
- **Hardening de Seguranca (v2.0.0)**:
  - Escape estrito com `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')` em todo o painel administrativo (`lib/ModuleView.php`)
  - Construcao segura via DOM (`textContent`, `JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT`) em `hooks.php`, eliminando vetores de XSS em `innerHTML`
  - Allowlist estrita de URLs `https?://` rejeitando esquemas `javascript:` e `data:`
  - Protecao contra path traversal em `ModuleController::getLang()`
  - Cookie de dispensa com `SameSite=Lax` (e `Secure` em HTTPS) valido por 24 horas
- **UX Acessivel**: `role="dialog"`, `aria-modal="true"`, fechamento via tecla `Escape` e clique no backdrop
- **Multilingue**: dicionarios em Ingles, Portugues (BR), Espanhol e Farsi inclusos em `resources/lang/`

---

## Requisitos

- WHMCS 8.x
- PHP 8.0 ou superior
- MySQL / MariaDB (via `Illuminate\Database\Capsule\Manager` do WHMCS)

---

## Instalacao

1. Copie este repositorio para o diretorio de addons do WHMCS:
   ```bash
   /caminho/do/whmcs/modules/addons/popupjsclient/
   ```
2. Acesse **WHMCS Admin** -> **System Settings** -> **Addon Modules**.
3. Localize **PopUpJSClient**, clique em **Activate** e conceda permissao aos grupos de administradores desejados.
4. Gerencie os anuncios em **Addons** -> **PopUpJSClient**.

---

## Exemplo de Saida Real

Validado em servidor AlmaLinux 8.10 com PHP 8.2.35 (`php -l` em todos os 11 arquivos PHP + harness funcional de seguranca):

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

# Saida do Harness Funcional e de Seguranca:
CONFIG: name=PopUpJSClient version=2.0.0 author=Percio Castelo
SANITIZE_BAD_URL: url='' start_at=NULL priority=3
SANITIZE_VALID_URL: url='https://perciocastelo.com.br/status' is_multimedia=1 priority=1
LANG_PT_BR: see_more='Veja mais'
LANG_TRAVERSAL_FALLBACK: see_more=''
XSS_CHECK: raw_script=BLOCKED escaped=YES
E2E_POPUP_PASS
```

---

## Licenca

Apache-2.0. Consulte [LICENSE](LICENSE) para detalhes.

## Autor

[Percio Castelo](https://perciocastelo.com.br)
