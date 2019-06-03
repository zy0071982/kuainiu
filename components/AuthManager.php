<?php

/**
 * Created by PhpStorm.
 * User: snow
 * Date: 2019/5/31
 * Time: 11:14
 */

namespace kuainiu\rbac\extension\components;

use yii\db\Query;
use yii\rbac\DbManager;

class AuthManager extends DbManager
{
    /**
     * Get all users included in permissions or roles
     *
     * @param $itemName
     *
     * @return array
     */
    public function getUserIdsByItem($itemName)
    {
        $userIds = [];

        $roleAndPermission = $this->getRoleAndPermission($itemName);

        if (empty($roleAndPermission)) return $userIds;

        foreach ($roleAndPermission as $name) {
            $userIds = array_merge($userIds, $this->getUserIdsByRole($name));
        }

        return array_unique($userIds);
    }

    /**
     * Get all parent permissions for the current permissions
     *
     * @param $itemName
     *
     * @return array
     */
    protected function getRoleAndPermission($itemName)
    {
        $childrenList = $this->getChildrenList();

        $result = [];
        $this->getParentRecursive($itemName, $childrenList, $result);

        array_push($result, $itemName);

        return $result;
    }

    /**
     * Recursive access to parent privileges or roles
     *
     * @param $itemName
     * @param $childrenList
     * @param $result
     */
    protected function getParentRecursive($itemName, $childrenList, &$result)
    {
        if (isset($childrenList[$itemName])) {
            foreach ($childrenList as $name => $v) {
                if (in_array($itemName, $v)) {
                    $result[] = $name;
                    $this->getParentRecursive($name, $childrenList, $result);
                    return;
                }
            }
        }
    }

    /**
     * @param null $type
     *
     * @return array
     */
    public function getItems($type = null)
    {
        $query = (new Query)
            ->from($this->itemTable)
            ->andFilterWhere(['type' => $type]);

        $items = [];
        foreach ($query->all($this->db) as $row) {
            $items[$row['name']] = $this->populateItem($row);
        }

        return $items;
    }

    /**
     * @param $name
     *
     * @return array|bool
     */
    public function getItemByName($name)
    {
        return (new Query)
            ->from($this->itemTable)
            ->andWhere(['name' => $name])
            ->one();
    }
}