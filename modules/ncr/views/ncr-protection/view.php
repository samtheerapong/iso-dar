<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = Yii::t('app', 'Protection'). ' : ' . $model->ncrs->ncr_number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Protection'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ncr-protection-view">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fa-solid fa-house-circle-exclamation"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa-solid fa-shield"></i> ' . Yii::t('app', 'Protection'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'NCR Home'), ['/ncr/ncr/index'], ['class' => 'btn btn-primary']) ?>
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
                    <?= Yii::t('app', 'Protection') ?>
                </div>
                <div class="card-body table-responsive">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            // 'id',
                            [
                                'attribute' => 'ncr_cause_item',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $value = $model->ncr_cause_item ? $model->ncr_cause_item : Yii::t('app', 'N/A');
                                    $color = $model->ncr_cause_item ? '#000000' : '#DC5F00';
                                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                                },
                            ],
                            [
                                'attribute' => 'issue',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $value = $model->issue ? $model->issue : Yii::t('app', 'N/A');
                                    $color = $model->issue ? '#000000' : '#DC5F00';
                                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                                },
                            ],
                            [
                                'attribute' => 'action',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $value = $model->action ? $model->action : Yii::t('app', 'N/A');
                                    $color = $model->action ? '#000000' : '#DC5F00';
                                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                                },
                            ],
                            [
                                'attribute' => 'schedule_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $value = $model->schedule_date ? Yii::$app->formatter->asDate($model->schedule_date) : Yii::t('app', 'N/A');
                                    $color = $model->schedule_date ? '#000000' : '#DC5F00';
                                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                                },
                            ],
                            [
                                'attribute' => 'operator',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $value = $model->operator ? $model->operator0->thai_name : Yii::t('app', 'N/A');
                                    $color = $model->operator ? '#000000' : '#DC5F00';
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