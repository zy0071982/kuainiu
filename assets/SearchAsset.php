<?php
namespace kuainiu\rbac\extension\assets;

use yii\web\AssetBundle;

class SearchAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@kuainiu/rbac/extension/assets/dist';

    /**
     * @inheritdoc
     */
    public $css = [
        'common-search.css',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'common-search.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'kuainiu\rbac\extension\assets\SelectAsset',
    ];
}