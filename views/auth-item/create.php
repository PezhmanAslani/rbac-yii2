<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Authitem $model */

$this->title = Yii::t('app', 'Create Authitem');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authitems'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authitem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
