<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prefixos */

$this->title = Yii::t('app', 'Create Prefixos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prefixos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prefixos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
