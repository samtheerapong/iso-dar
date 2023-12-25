<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\RpList $model */

$this->title = $model->detail_list;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rp Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rp-list-view">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-chevron-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fas fa-edit"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>

            <?= Html::a('<i class="fas fa-trash"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>

        </p>
    </div>
    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body table-responsive">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-6">
                        <?php
                        $imageUrl = $model->getPhotoViewer(); // Assuming this method returns the image URL

                        echo Html::a(Html::img($imageUrl, [
                            'class' => 'img-fluid img-thumbnail mx-auto d-block',
                            'alt' => '...',
                        ]), $imageUrl, ['target' => '_blank']); // 'target' => '_blank' opens the link in a new tab
                        ?>

                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <?= DetailView::widget([
                                'model' => $model,
                                'template' => '<tr><th style="width: 200px;">{label}</th><td> {value}</td></tr>',
                                'attributes' => [
                                    [
                                        'attribute' => 'request0.repair_code',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->request0 ? $model->request0->repair_code : 'N/A';
                                        },
                                    ],

                                    [
                                        'attribute' => 'detail_list',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return  $model->detail_list;
                                        },
                                    ],
                                    [
                                        'attribute' => 'request_date',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->request_date ? Yii::$app->formatter->asDate($model->request_date) : 'N/A';
                                        },
                                    ],
                                    [
                                        'attribute' => 'broken_date',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->broken_date ? Yii::$app->formatter->asDate($model->broken_date) : 'N/A';
                                        },
                                    ],
                                    [
                                        'attribute' => 'amount',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->amount ? $model->amount : 'N/A';
                                        },
                                    ],
                                    [
                                        'attribute' => 'location',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->location ? $model->location0->name : 'N/A';
                                        },
                                    ],
                                    [
                                        'attribute' => 'remask',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->remask ? $model->remask : 'N/A';
                                        },
                                    ],
                                ],
                            ]) ?>

                        </div>