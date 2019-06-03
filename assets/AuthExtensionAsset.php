<?php
namespace kuainiu\rbac\extension\assets;

use yii\web\AssetBundle;

class AuthExtensionAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@kuainiu/rbac/extension/assets/dist';
    /**
     * @inheritdoc
     */
    public $js = [
        'layer/layer.js',
        'jsonFormat.js',
        'auto-line-number.js',
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}