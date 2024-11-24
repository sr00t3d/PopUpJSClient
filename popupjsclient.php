<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use WHMCS\Module\Addon\PopupJSClient\ModuleController;

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
 * @throws Exception
 */
function popupjsclient_output($vars) {
    ModuleController::manage($vars);
}
