<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $model kuainiu\rbac\extension\models\AuthItemExtension */
?>

<div class="row wrap search-options-content">
    <?php $form = ActiveForm::begin([
        'action'  => "view?role_name=" . urlencode($roleName),
        'method'  => 'get',
        'options' => ['class' => 'form-inline search-form'],
        'id'      => 'permission-view-search-form',
    ]); ?>
    <div class="col-xs-12">
        <?= Html::textInput('username', Yii::$app->request->get('username', ''), [
            'id'          => 'username',
            'class'       => 'input-sm input-s form-control',
            'placeholder' => '账号或姓名',
        ]) ?>
    </div>

    <div class="col-xs-12">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-primary search-btn']) ?>
        <?= Html::a('重置', 'javascript:void(0);', ['class' => 'btn btn-sm btn-default reset-btn']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>