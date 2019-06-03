<?php

use kuainiu\rbac\extension\assets\SearchAsset;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AccessLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var string $roleName */

$this->title                   = urldecode($roleName) . ' -> 用户列表';
$this->params['breadcrumbs'][] = $this->title;
SearchAsset::register($this);
?>
<div class="access-log-index">
    <section class="panel panel-default section-search">
        <header class="panel-heading search-options">搜索条件
            <i class="fa fa-arrow-circle-down text-danger"></i>
        </header>
        <div class="panel-body">
            <?= $this->render('_view_search', [
                'model'    => $searchModel,
                'roleName' => $roleName,
            ]); ?>
        </div>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider'   => $dataProvider,
                'columns'        => [
                    [
                        'attribute' => '账户',
                        'value'     => 'username',
                    ],
                    [
                        'attribute' => '姓名',
                        'value'     => 'fullname',
                    ],
                ],
                'layout'         => "{items}\n{summary}",
                'summaryOptions' => [
                    'class' => 'summary',
                    'style' => 'margin-left:10px;',
                ],
                'options'        => ['style' => 'overflow-x: scroll;',],
                'tableOptions'   => [
                    'class' => 'table table-hover table-bordered',
                    'style' => 'min-width:100%',
                ],
            ]); ?>
        </div>
        <div class="panel-footer">
            <?= LinkPager::widget([
                'pagination'     => $dataProvider->pagination,
                'nextPageLabel'  => '下一页',
                'prevPageLabel'  => '上一页',
                'firstPageLabel' => '首页',
                'lastPageLabel'  => '末页',
                'options'        => [
                    'class' => 'pagination pagination-sm m-t-none m-b-none',
                ],
            ]) ?>
        </div>
    </section>
</div>
