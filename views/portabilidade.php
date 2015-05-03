<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Portabilidade */
/* @var $form ActiveForm */
?>
<div class="portabilidade">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'date') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'rn1') ?>
        <?= $form->field($model, 'operations') ?>
        <?= $form->field($model, 'cnl') ?>
        <?= $form->field($model, 'eot') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- portabilidade -->
