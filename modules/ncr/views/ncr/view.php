<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\Ncr $model */

$this->title = $model->ncr_number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ncrs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ncr-view">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-chevron-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa-solid fa-location-arrow"></i> ' . Yii::t('app', 'Solvings'), ['solvings', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        </p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= Html::encode($this->title) ?>
                </div>
                <div class="card-body table-responsive">

                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 200px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            // 'id',
                            [
                                'attribute' => 'ncr_number',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr_number ? $model->ncr_number : Yii::t('app', 'N/A');
                                },
                            ],
                            
                            [
                                'attribute' => 'created_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->created_date ? Yii::$app->formatter->asDate($model->created_date) : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'month',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->month ? $model->month0->month : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'year',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->year ? $model->year0->year : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'department',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->department ? $model->toDepartment->department_name . ' (' . $model->toDepartment->department_code . ')' : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr_process_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr_process_id ? $model->ncrProcess->process_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'lot',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->lot ? $model->lot : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'production_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->production_date ? Yii::$app->formatter->asDate($model->production_date) : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'product_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->product_name ? $model->product_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'customer_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->customer_name ? $model->customer_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'category_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->category_id ? $model->category->category_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'sub_category_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->sub_category_id ? $model->subCategory->category_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'datail',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->datail ? $model->datail : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr_status_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr_status_id ? $model->ncrStatus->status_name : Yii::t('app', 'N/A');
                                },
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= Yii::t('app', 'Reporter') ?>
                </div>
                <div class="card-body table-responsive">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 200px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            [
                                'attribute' => 'report_by',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->report_by ? $model->reportBy->thai_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'department_issue',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->department_issue ? $model->departmentIssue->department_name . ' (' . $model->departmentIssue->department_code . ')' : 'N/A';
                                },
                            ],

                            'troubleshooting:ntext',

                            [
                                'attribute' => 'docs',
                                'format' => 'html',
                                'value' => $model->listDownloadFiles('docs')
                            ],
                        ],
                    ]) ?>
                </div>
            </div>

            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= Yii::t('app', 'System Log') ?>
                </div>
                <div class="card-body table-responsive">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 200px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            [
                                'attribute' => 'created_at',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->created_at ? Yii::$app->formatter->asDate($model->created_at) : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'created_by',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->created_by ? $model->createdBy->thai_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'updated_at',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->updated_at ? Yii::$app->formatter->asDate($model->updated_at) : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'updated_by',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->updated_by ? $model->updatedBy->thai_name : Yii::t('app', 'N/A');
                                },
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>