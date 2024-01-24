<?php

use app\modules\ncr\models\NcrAccept;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\search\NcrAcceptSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Ncr Accepts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-accept-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ncr Accept'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ncr_id',
            'ncr_concession_id',
            'customer_name',
            'process',
            //'cause',
            //'approve_name',
            //'approve_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, NcrAccept $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
