<?php

use app\models\AuthitemChild;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\AuthitemChildSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Authitem Children');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authitem-child-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Authitem Child'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'parent',
            'child',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AuthitemChild $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'parent' => $model->parent, 'child' => $model->child]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
