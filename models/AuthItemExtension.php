<?php
/**
 * Created by PhpStorm.
 * User: snow
 * Date: 2019/5/31
 * Time: 14:32
 */

namespace kuainiu\rbac\extension\models;

use mdm\admin\models\searchs\AuthItem;
use Yii;
use yii\data\ArrayDataProvider;

class AuthItemExtension extends AuthItem
{
    const TYPE_ROLE       = 1;
    const TYPE_PERMISSION = 2;

    /**
     * Search authItem
     *
     * @param array $params
     *
     * @return \yii\data\ActiveDataProvider|\yii\data\ArrayDataProvider
     */
    public function search($params)
    {
        if (empty($params['type'])) {
            $this->type = null;
        }

        /* @var \kuainiu\rbac\extension\components\AuthManager $authManager */
        $authManager = Yii::$app->getAuthManager();
        $items       = array_filter($authManager->getItems($this->type), function ($item) {
            return strncmp($item->name, '/', 1) !== 0;
        });

        $this->load($params);
        if ($this->validate()) {
            $search   = strtolower(trim($this->name));
            $type     = strtolower(trim($this->type));
            $desc     = strtolower(trim($this->description));
            $ruleName = $this->ruleName;
            foreach ($items as $name => $item) {
                $f = (empty($search) || strpos(strtolower($item->name), $search) !== false) &&
                    (empty($type) || $item->type == $type) &&
                    (empty($desc) || strpos(strtolower($item->description), $desc) !== false) &&
                    (empty($ruleName) || $item->ruleName == $ruleName);
                if (!$f) {
                    unset($items[$name]);
                }
            }
        }

        return new ArrayDataProvider([
            'allModels' => $items,
        ]);
    }

    public function getType()
    {
        return [
            self::TYPE_ROLE       => '角色',
            self::TYPE_PERMISSION => '权限',
        ];
    }
}