<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prefixos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prefixos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'operadora')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'rn1')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'ddd')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'prefixo')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'mdcu_inicial')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'mdcu_final')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'eot')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'uf')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'cnl')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
