<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Export Reply');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reply-export">

    <p>
        <?= Html::a('<i class="fa-solid fa-home"></i> ' . Yii::t('app', 'Home'), ['/ncr/ncr-reply/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="card border-warning">
        <div class="card-header text-white bg-warning">
            <?= Html::encode($this->title) ?>
        </div>
    </div>

    <div class="row">
        <?= ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'dropdownOptions' => [
                'label' => 'Export Reply',
            ],
            'exportConfig' => [
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_PDF => false,
                ExportMenu::FORMAT_EXCEL => false,
            ],
            'columns' =>
            [
                [
                    'class' => 'yii\grid\SerialColumn',
                ],
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
                    'attribute' => 'ncrs.month',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->ncrs->month  ?  $model->ncrs->month0->month : Yii::t('app', 'N/A');
                    },
                ],

                [
                    'attribute' => 'ncrs.year',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->ncrs->year  ?  $model->ncrs->year0->year : Yii::t('app', 'N/A');
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
                    'attribute' => 'ncrs.category_id',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->ncrs->category_id ? $model->ncrs->category->name : Yii::t('app', 'N/A');
                    },
                ],

                [
                    'attribute' => 'ncrs.sub_category_id',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->ncrs->sub_category_id ? $model->ncrs->subCategory->name : Yii::t('app', 'N/A');
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
                    'attribute' => 'ncrs.ncr_status_id',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->ncrs->ncr_status_id ? $model->ncrs->ncrStatus->name : Yii::t('app', 'N/A');
                    },
                ],
                // [
                //     'attribute' => 'ncrs.docs',
                //     'format' => 'html',
                //     'value' => function ($model) {
                //         return $model->ncrs->docs ? $model->ncrs->listDownloadFiles('docs', 'auto') : Yii::t('app', 'N/A');
                //     },
                // ],
                [
                    'attribute' => 'reply_type_id',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->reply_type_id ? $model->replyType->name : Yii::t('app', 'N/A');
                    },
                ],
                [
                    'attribute' => 'concession',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->concession ? $model->concession0->concession_name : Yii::t('app', 'N/A');
                    },
                ],
                [
                    'attribute' => 'quantity',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->quantity ? $model->quantity . ' ' . $model->unit : Yii::t('app', 'N/A');
                    },
                ],
                [
                    'attribute' => 'method',
                    'format' => 'ntext',
                    'value' => function ($model) {
                        return $model->method ? $model->method : Yii::t('app', 'N/A');
                    },
                ],
                [
                    'attribute' => 'cause',
                    'format' => 'ntext',
                    'value' => function ($model) {
                        return $model->cause ? $model->cause : Yii::t('app', 'N/A');
                    },
                ],
                [
                    'attribute' => 'operation_name',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->operation_name ? $model->operator->thai_name : 'N/A';
                    },
                ],
                [
                    'attribute' => 'operation_date',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->operation_date ? Yii::$app->formatter->asDate($model->operation_date) : Yii::t('app', 'N/A');
                    },
                ],
                [
                    'attribute' => 'approve_name',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->approve_name ? $model->approver->thai_name : 'N/A';
                    },
                ],
                [
                    'attribute' => 'approve_date',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->approve_date ? Yii::$app->formatter->asDate($model->approve_date) : Yii::t('app', 'N/A');
                    },
                ],
                // [
                //     'attribute' => 'docs',
                //     'format' => 'html',
                //     'value' => function ($model) {
                //         return $model->docs ? $model->listDownloadFiles('docs', 'auto') : Yii::t('app', 'N/A');
                //     },
                // ],
            ],
        ]);
        ?>
    </div>
</div>