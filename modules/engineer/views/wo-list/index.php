<?php

use app\modules\engineer\models\WoList;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\WoListSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Wo Lists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wo-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Wo List'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'workorder_id',
            'working_date',
            'description:ntext',
            'problem:ntext',
            //'images:ntext',
            //'lock_out',
            //'tag_out',
            //'checker',
            //'recheck_electric',
            //'recheck_mechanics',
            //'rechecker',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, WoList $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
