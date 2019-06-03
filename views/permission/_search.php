<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $model kuainiu\rbac\extension\models\AuthItemExtension */
?>

<div class="row wrap search-options-content">
    <?php $form = ActiveForm::begin([
        'action'  => ['index'],
        'method'  => 'get',
        'options' => ['class' => 'form-inline search-form'],
        'id'      => 'permission-search-form',
    ]); ?>
    <div class="col-xs-12">
        <?= $form->field($model, 'name', ['template' => '{input}'])
            ->textInput([
                'placeholder' => '名称',
                'class'       => 'input-sm input-s form-control',
            ])
            ->label(false) ?>
        <?= $form->field($model, 'type', ['template' => '{input}'])
            ->dropDownList($model->getType(), [
                'class'  => 'input-sm input-s form-control',
                'prompt' => '类型',
            ])
            ->label(false) ?>
    </div>

    <div class="col-xs-12">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-primary search-btn']) ?>
        <?= Html::a('重置', 'javascript:void(0);', ['class' => 'btn btn-sm btn-default reset-btn']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>