<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrClosing $model */

$this->title = $model->ncrs->ncr_number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Closing'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ncr-closing-view">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fa-solid fa-house-circle-exclamation"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa-regular fa-circle-check"></i> ' . Yii::t('app', 'Closing'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'NCR '), ['/ncr/ncr/index'], ['class' => 'btn btn-primary']) ?>
        </p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card border-info">
                <div class="card-header text-white bg-info">
                    <?= Yii::t('app', 'NCR') ?>
                </div>
                <div class="card-body table-responsive">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            [
                                'attribute' => 'ncrs.ncr_number',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->ncr_number ? $model->ncrs->ncr_number : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.created_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->created_date ? Yii::$app->formatter->asDate($model->ncrs->created_date) : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.department',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->department ? $model->ncrs->toDepartment->name . ' (' . $model->ncrs->toDepartment->code . ')' : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.process',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->process ? $model->ncrs->process : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.lot',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->lot ? $model->ncrs->lot : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.production_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->production_date ? Yii::$app->formatter->asDate($model->ncrs->production_date) : Yii::t('app', 'N/A');
                                },
                            ],
                            [
                                'attribute' => 'ncrs.product_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->product_name ? $model->ncrs->product_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.customer_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->customer_name ? $model->ncrs->customer_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.datail',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->ncrs->datail ? $model->ncrs->datail : Yii::t('app', 'N/A');
                                },
                            ],
                            [
                                'attribute' => 'ncrs.report_by',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->report_by ? $model->ncrs->reporter->thai_name : 'N/A';
                                },
                            ],
                            [
                                'attribute' => 'ncrs.department_issue',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->department_issue ? $model->ncrs->fromDepartment->name . ' (' . $model->ncrs->fromDepartment->code . ')' : 'N/A';
                                },
                            ],
                            [
                                'attribute' => 'ncrs.action',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->ncrs->action ? $model->ncrs->action : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.docs',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->docs ? $model->ncrs->listDownloadFiles('docs', 'auto') : Yii::t('app', 'N/A');
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
                    <?= Yii::t('app', 'Closing') ?>
                </div>
                <div class="card-body table-responsive">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            [
                                'attribute' => 'accept',
                                'format' => 'html',
                                'value' => function ($model) {
                                    if ($model->accept === 1) {
                                        $status = '<span style="color: #1A5D1A;">' . Yii::t('app', 'Accepted') . '</span>';
                                    } elseif ($model->accept === null) {
                                        $status = '<span style="color: #DC5F00;">' . Yii::t('app', 'Pending') . '</span>';
                                    } else {
                                        $status = '<span style="color: #D80032;">' . Yii::t('app', 'Not approved') . '</span>';
                                    }

                                    return $status;
                                },
                            ],

                            [
                                'attribute' => 'auditor',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $value = $model->auditor ? $model->auditApprove->thai_name : Yii::t('app', 'Pending');
                                    $color = $model->auditor ? '#000000' : '#DC5F00';
                                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                                },
                            ],
                            [
                                'attribute' => 'qmr',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $value = $model->qmr ? $model->qmrApprove->thai_name : Yii::t('app', 'Pending');
                                    $color = $model->qmr ? '#000000' : '#DC5F00';
                                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                                },
                            ],
                            [
                                'attribute' => 'accept_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $value = $model->accept_date ? Yii::$app->formatter->asDate($model->accept_date) : Yii::t('app', 'Pending');
                                    $color = $model->accept_date ? '#000000' : '#DC5F00';
                                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                                },
                            ],
                        ],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>