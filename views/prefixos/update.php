<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prefixos */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Prefixos',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prefixos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="prefixos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
