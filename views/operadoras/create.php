<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Operadoras */

$this->title = Yii::t('app', 'Create Operadoras');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operadoras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operadoras-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
