<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Operadoras */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="operadoras-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'operadora')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'spid')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'rn1')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
