<?php

namespace kuainiu\rbac\extension;

/**
 * This is just an example.
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'kuainiu\rbac\extension\controllers';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
