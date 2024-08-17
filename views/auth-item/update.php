<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Authitem $model */
/** @var array $ruleList */
$this->title = Yii::t('app', 'Update Authitem: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authitems'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'name' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="authitem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ruleList' => $ruleList,
    ]) ?>

</div>
