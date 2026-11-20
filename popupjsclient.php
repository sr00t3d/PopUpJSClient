<?php
/**
 * +============================================================================+
 * | popupjsclient.php                                                          |
 * | PopUpJSClient WHMCS Addon Module v2.0.0                                    |
 * | Entry point for WHMCS addon configuration, lifecycle hooks, and admin UI.  |
 * |                                                                            |
 * | Author:  Percio Castelo                                                    |
 * | Contact: percio@evolya.com.br | contato@perciocastelo.com.br               |
 * | Web:     https://perciocastelo.com.br                                      |
 * | Repo:    https://github.com/sr00t3d/PopUpJSClient                          |
 * |                                                                            |
 * | Copyright 2024-2026 Percio Castelo                                         |
 * | SPDX-License-Identifier: Apache-2.0                                        |
 * +============================================================================+
 */

declare(strict_types=1);

if (!defined('WHMCS')) {
    die('This file cannot be accessed directly');
}

use WHMCS\Module\Addon\popupjsclient\ModuleController;

function popupjsclient_config(): array
{
    return ModuleController::config();
}

function popupjsclient_activate(): array
{
    return ModuleController::activate();
}

function popupjsclient_deactivate(): array
{
    return ModuleController::deactivate();
}

/**
 * @param array $vars
 * @throws Exception
 */
function popupjsclient_output(array $vars): void
{
    ModuleController::manage($vars);
}
