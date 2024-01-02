<?php

use app\modules\ncr\models\NcrSolving;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\search\NcrSolvingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Ncr Solvings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-solving-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ncr Solving'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ncr_id',
            'solving_type_id',
            'quantity',
            'unit',
            //'proceed:ntext',
            //'operation_date',
            //'operation_name',
            //'ncr_concession_id',
            //'customer_name',
            //'process',
            //'cause',
            //'approve_name',
            //'approve_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, NcrSolving $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
