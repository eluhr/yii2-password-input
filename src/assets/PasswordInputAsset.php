<?php

namespace eluhr\passwordInput\assets;

use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * --- PROPERTIES ---
 *
 * @author Elias Luhr
 */
class PasswordInputAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/web/password-input';

    public $js = [
        'password-input.js'
    ];

    public $css = [
        'password-input.less'
    ];

    public $depends = [
        BootstrapPluginAsset::class
    ];
}
