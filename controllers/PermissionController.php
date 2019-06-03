<?php
/**
 * Created by PhpStorm.
 * User: snow
 * Date: 2019/5/29
 * Time: 11:00
 */

namespace kuainiu\rbac\extension\controllers;

use kuainiu\rbac\extension\models\AuthItemExtension as AuthItemExtensionSearch;
use kuainiu\rbac\extension\models\UserSearch;
use Yii;
use yii\web\Controller;

class PermissionController extends Controller
{
    /**
     * Index Action
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel  = new AuthItemExtensionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    /**
     * @return string
     */
    public function actionView()
    {
        $roleName = Yii::$app->request->get('role_name');
        $roleName = urldecode($roleName);

        /* @var \kuainiu\rbac\extension\components\AuthManager $auth */
        $auth     = Yii::$app->getAuthManager();
        $permission = $auth->getItemByName($roleName);

        // validate the roleName
        if (empty($permission)) {
            throw new \Exception('The role or permission name does not exist!');
        }

        $userIds = $auth->getUserIdsByItem($roleName);
        $searchModel  = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $userIds);

        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
            'roleName'     => $roleName,
        ]);
    }
}