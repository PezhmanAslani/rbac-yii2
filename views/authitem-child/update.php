<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AuthitemChild $model */

$this->title = Yii::t('app', 'Update Authitem Child: {name}', [
    'name' => $model->parent,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authitem Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->parent, 'url' => ['view', 'parent' => $model->parent, 'child' => $model->child]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="authitem-child-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
