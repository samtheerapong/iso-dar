<?php

use app\modules\engineer\models\Technician;
use kartik\widgets\Select2;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\TechnicianSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Technicians');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="technician-index">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fa fa-circle-plus"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <p style="text-align: right;">
        <?= Html::a('<i class="fa-solid fa-retweet"></i> ' . Yii::t('app', 'Index'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-screwdriver-wrench"></i> ' . Yii::t('app', 'Configs'), ['/engineer/default/setings-menu'], ['class' => 'btn btn-warning']) ?>
        </p>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Yii::t('app', 'Total : {count} User', ['count' => $dataProvider->totalCount]) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                foreach ($dataProvider->getModels() as $model) : ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="card mb-3 ">
                            <?= Html::a(
                                Html::img(
                                    $model->getPhotoViewer(),
                                    [
                                        'class' => 'file-preview-image',
                                        'alt' => $model->id,
                                        'style' => 'height: 300px;',
                                    ]
                                ),
                                ['view', 'id' => $model->id],
                            ) ?>
                            <div class="card-body">
                                <p class="card-text">
                                    <b><?= $model->getAttributeLabel('name') ?></b> :
                                    <?= $model->name ?>
                                </p>
                                <p class="card-text">
                                    <b><?= $model->getAttributeLabel('tel') ?></b> :
                                    <?= $model->tel ?>
                                </p>
                                <p class="card-text">
                                    <b><?= $model->getAttributeLabel('head') ?></b> :
                                    <?= $model->head ? $model->head0->thai_name : Yii::t('app', 'N/A'); ?>
                                </p>
                                <p class="card-text">
                                    <b><?= $model->getAttributeLabel('active') ?></b> :
                                    <span class="text" style="color: <?= $model->getActiveStatus()[0] ?>;">
                                        <?= $model->getActiveStatus()[1] ?>
                                    </span>
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                <div class="btn-group btn-group-xs" role="group">
                                    <?= Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-outline-dark btn-sm', 'title' => Yii::t('app', 'View'), 'aria-label' => Yii::t('app', 'View')]) ?>
                                    <?= Html::a('<i class="fas fa-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-dark btn-sm', 'title' => Yii::t('app', 'Update'), 'aria-label' => Yii::t('app', 'Update')]) ?>
                                    <?= Html::a('<i class="fas fa-trash-can"></i>', ['delete', 'id' => $model->id], [
                                        'class' => 'btn btn-outline-dark btn-sm', 'title' => Yii::t('app', 'Delete'), 'aria-label' => Yii::t('app', 'Delete'),
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
            <div class="col-md-12">
                <?php
                echo LinkPager::widget([
                    'pagination' => $dataProvider->pagination,
                    'maxButtonCount' => 5,
                    'firstPageLabel' => Yii::t('app', 'First'),
                    'lastPageLabel' => Yii::t('app', 'Last'),
                    'options' => ['class' => 'pagination justify-content-center'],
                    'linkContainerOptions' => ['class' => 'page-item'],
                    'linkOptions' => ['class' => 'page-link'],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>