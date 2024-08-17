<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AuthitemChild $model */

$this->title = Yii::t('app', 'Create Authitem Child');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authitem Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authitem-child-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
