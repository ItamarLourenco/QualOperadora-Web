<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Portabilidade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="portabilidade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'rn1')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'operations')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'cnl')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'eot')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
