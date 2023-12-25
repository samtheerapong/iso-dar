<?php

use app\modules\dar\models\Request;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\dar\models\search\Request $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Request'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'document_code',
            'rev',
            'request_type_id',
            'request_category_id',
            //'department_id',
            //'request_name',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            //'title',
            //'detail:ntext',
            //'document_age',
            //'public_date',
            //'request_status_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Request $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
