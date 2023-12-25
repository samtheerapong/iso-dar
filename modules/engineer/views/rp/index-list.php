<?php

use app\modules\engineer\models\RpList;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\RpListSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

// $this->title = Yii::t('app', 'Rp Lists');
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="rp-list-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:45px;'], //กำหนด ความกว้างของ #
            ],

            [
                'attribute' => 'detail_list',
                'format' => 'html',
                'value' => function ($model) {
                    $detail = $model->detail_list;
                    $remask = $model->remask;
                    $badge = ($remask !== null && $remask !== '') ? '<br><span class="badge badge-warning">' . $remask . '</span>' : '';
                    return $detail . '   ' . $badge;
                },
            ],
            // 'request_date',
            [
                'attribute' => 'request_date',
                'format' => 'html',
                'headerOptions' => ['style' => 'width:150px;'],
                'value' => function ($model) {
                    return $model->request_date ? Yii::$app->formatter->asDate($model->request_date) : 'N/A';
                },
            ],
            // 'broken_date',
            [
                'attribute' => 'broken_date',
                'format' => 'html',
                'headerOptions' => ['style' => 'width:150px;'],
                'value' => function ($model) {
                    return $model->broken_date ? Yii::$app->formatter->asDate($model->broken_date) : 'N/A';
                },
            ],
            // 'amount',
            [
                'attribute' => 'amount',
                'format' => 'html',
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:60px;'],
                'value' => function ($model) {
                    return $model->amount ? $model->amount : 'N/A';
                },
            ],
            // 'location',
            [
                'attribute' => 'location',
                'format' => 'html',
                'headerOptions' => ['style' => 'width:200px;'],
                'value' => function ($model) {
                    return $model->location ? $model->location0->name : 'N/A';
                },
            ],

            [
                'attribute' => 'photo',
                'format' => 'html',
                'headerOptions' => ['style' => 'width:150px;'],
                'value' => function ($model) {
                    $imageUrl = $model->getPhotoViewer();
                    return Html::a(
                        Html::img($imageUrl, [
                            'class' => 'img-fluid img-thumbnail mx-auto d-block',
                            'alt' => '...',
                        ]),
                        $imageUrl,
                        ['target' => '_blank']
                    );
                },
            ],
            // 'image:ntext',
            // 'remask:ntext',

        ],
    ]); ?>


</div>