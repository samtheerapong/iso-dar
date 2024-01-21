<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrSolving $model */

$this->title = $model->ncr->ncr_number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ncr Solvings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ncr-solving-view">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-chevron-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?php //echo Html::a('<i class="fas fa-calendar"></i> ' . Yii::t('app', 'Moromi Record Card'), ['card'], ['class' => 'btn btn-secondary btn-lg']) 
            ?>
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
    <div class="row">
        <div class="col-md-6">
            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= Yii::t('app', 'NCR Details') ?>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            // 'id',
                            // 'ncr_id',
                            [
                                'attribute' => 'ncr.ncr_number',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->ncr_number ? $model->ncr->ncr_number : Yii::t('app', 'N/A');
                                },
                            ],
                            [
                                'attribute' => 'ncr.created_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->created_date ? Yii::$app->formatter->asDate($model->ncr->created_date) : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr.department',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->department ? $model->ncr->toDepartment->department_name . ' (' . $model->ncr->toDepartment->department_code . ')' : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr.ncr_process_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->ncr_process_id ? $model->ncr->ncrProcess->process_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr.lot',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->lot ? $model->ncr->lot : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr.production_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->production_date ? Yii::$app->formatter->asDate($model->ncr->production_date) : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr.product_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->product_name ? $model->ncr->product_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr.customer_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->customer_name ? $model->ncr->customer_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr.category_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->category_id ? $model->ncr->category->category_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr.sub_category_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->sub_category_id ? $model->ncr->subCategory->category_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr.datail',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->ncr->datail ? $model->ncr->datail : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr.ncr_status_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->ncr_status_id ? $model->ncr->ncrStatus->status_name : Yii::t('app', 'N/A');
                                },
                            ],


                        ],
                    ]) ?>
                </div>
            </div>

            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= Yii::t('app', 'NCR Reported') ?>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [

                            [
                                'attribute' => 'ncr.report_by',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->report_by ? $model->ncr->reportBy->thai_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncr.department_issue',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr->department_issue ? $model->ncr->departmentIssue->department_name . ' (' . $model->ncr->departmentIssue->department_code . ')' : 'N/A';
                                },
                            ],

                            'ncr.troubleshooting:ntext',

                            [
                                'attribute' => 'ncr.docs',
                                'format' => 'html',
                                'value' => $model->ncr->listDownloadFiles('docs')
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= Yii::t('app', 'NCR Response') ?>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [

                            [
                                'attribute' => 'solving_type_id',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->solvingType->type_name ? $model->solvingType->type_name : Yii::t('app', 'N/A');
                                },
                            ],
                            [
                                'attribute' => 'quantity',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->quantity ? $model->quantity . ' ' . $model->unit : Yii::t('app', 'N/A');
                                },
                            ],
                            'proceed:ntext',
                            'operation_date:date',
                            [
                                'attribute' => 'operation_name',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->operation_name ? $model->operationBy->thai_name : Yii::t('app', 'N/A');
                                },
                            ],
                        ],
                    ]) ?>
                </div>
            </div>

            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= Yii::t('app', 'NCR Concession') ?>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [

                            [
                                'attribute' => 'ncr_concession_id',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->ncr_concession_id ? $model->ncrConcession->concession_name . ' ' . $model->unit : Yii::t('app', 'N/A');
                                },
                            ],
                            'customer_name',
                            'process',
                            'cause',

                        ],
                    ]) ?>
                </div>
            </div>

            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= Yii::t('app', 'NCR Approved') ?>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [

                            [
                                'attribute' => 'approve_name',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->approve_name ? $model->approveBy->thai_name : Yii::t('app', 'N/A');
                                },
                            ],
                            'approve_date:date',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>