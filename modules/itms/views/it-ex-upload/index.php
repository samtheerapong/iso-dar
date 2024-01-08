<?php

use app\modules\itms\models\ItExUpload;
use dosamigos\gallery\Gallery;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\ItExUploadSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'It Ex Uploads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-ex-upload-index">

    <div style="display: flex; justify-content: space-between;">
        <div class="mb-3">
            <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-danger']) ?>
        </div>

        <div class="mb-3" style="text-align: right;">
            <?= Html::a('<span class="fa fa-refresh"></span> ', ['index'], ['class' => 'btn btn-warning']) ?>
        </div>
    </div>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width: 45px;'],],

                    // 'id',
                    // 'ref',
                    [
                        'attribute' => 'photo',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center','style' => 'width: 100px;'],
                        'value' => function (ItExUpload $model) {
                            return $model->getImageShow();
                        },
                    ],
                    
                    // [
                    //     'attribute' => 'photo',
                    //     'format' => 'raw',
                    //     'value' => function ($model) {
                    //         $thumbnails = $model->getThumbnails($model->ref, $model->title);
                    //         $html = '';
                    //         foreach ($thumbnails as $thumbnail) {
                    //             $html .= Html::img($thumbnail['src'], ['width' => '80px']) . ' ';
                    //         }

                    //         return $html;
                    //     },
                    // ],

                    // [
                    //     'attribute' => 'photo',
                    //     'format' => 'raw',
                    //     'value' => function ($model) {
                    //         $thumbnails = $model->getThumbnails($model->ref, $model->title);

                    //         foreach ($thumbnails as &$thumbnail) {
                    //             $thumbnail['options'] = ['width' => '80px'];
                    //         }
                    //         return \dosamigos\gallery\Gallery::widget([
                    //             'items' => $thumbnails,
                    //         ]);
                    //     },
                    // ],


                    'title',
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width: 150px;'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        'template' => '<div class="btn-group btn-group-xs" role="group"> {operate} {view} {update} {delete}</div>',
                        'urlCreator' => function ($action, $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>