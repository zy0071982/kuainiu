<?php

use kuainiu\rbac\extension\assets\SearchAsset;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel kuainiu\rbac\extension\models\AuthItemExtension */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '权限列表';
$this->params['breadcrumbs'][] = $this->title;
SearchAsset::register($this);
?>
<section class="panel panel-default section-search">
    <header class="panel-heading search-options">搜索条件
        <i class="fa fa-arrow-circle-down text-danger"></i>
    </header>
    <div class="panel-body">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider'   => $dataProvider,
            'columns'        => [
                [
                    'attribute' => '名称',
                    'value'     => 'name',
                ],
                [
                    'attribute' => '类型',
                    'value'     => function ($item) use ($searchModel) {
                        if (key_exists($item->type, $searchModel->getType())) {
                            return $searchModel->getType()[$item->type];
                        }

                        return '未知';
                    },
                ],
                [
                    'class'          => 'yii\grid\ActionColumn',
                    'template'       => '{view}',
                    'header'         => '查看用户',
                    'headerOptions'  => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'buttons'        => [
                        'view' => function ($url, $model) {
                            return Html::a('', Url::toRoute(['permission/view', 'role_name' => $model->name]), [
                                'class'  => "glyphicon glyphicon-eye-open",
                                'target' => '_blank',
                            ]);
                        },
                    ],
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