<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Export Ncr');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-export">

    <p>
        <?= Html::a('<i class="fa-solid fa-home"></i> ' . Yii::t('app', 'Home'), ['/ncr/ncr/index'], ['class' => 'btn btn-primary']) ?>
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
                'label' => 'Export NCR',
            ],
           

            'exportConfig' => [
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_PDF => false,
                ExportMenu::FORMAT_EXCEL => false,
                ExportMenu::FORMAT_EXCEL_X => [
                    'label' => 'Excel'
                ],
            ],
            'clearBuffers' => true, //optional
            'columns' =>
            [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'ncr_number',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->ncr_number ? $model->ncr_number  : Yii::t('app', 'N/A');
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
                        return $model->month  ?  $model->month0->month : Yii::t('app', 'N/A');
                    },
                ],

                [
                    'attribute' => 'year',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->year  ?  $model->year0->year : Yii::t('app', 'N/A');
                    },
                ],

                [
                    'attribute' => 'department',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->department ? $model->toDepartment->name . ' (' . $model->toDepartment->code . ')' : Yii::t('app', 'N/A');
                    },
                ],

                [
                    'attribute' => 'process',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->process ? $model->process : Yii::t('app', 'N/A');
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
                        return $model->category_id ? $model->category->name : Yii::t('app', 'N/A');
                    },
                ],

                [
                    'attribute' => 'sub_category_id',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->sub_category_id ? $model->subCategory->name : Yii::t('app', 'N/A');
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
                    'attribute' => 'report_by',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->report_by ? $model->reporter->thai_name : Yii::t('app', 'N/A');
                    },
                ],
                [
                    'attribute' => 'department_issue',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->department_issue ? $model->fromDepartment->name . ' (' . $model->fromDepartment->code . ')' : Yii::t('app', 'N/A');
                    },
                ],
                [
                    'attribute' => 'action',
                    'format' => 'ntext',
                    'value' => function ($model) {
                        return $model->action ? $model->action : Yii::t('app', 'N/A');
                    },
                ],
                [
                    'attribute' => 'ncr_status_id',
                    'format' => 'html',
                    'value' => function ($model) {
                        return $model->ncr_status_id ? $model->ncrStatus->name : Yii::t('app', 'N/A');
                    },
                ],
            ],

        ]); ?>
    </div>
</div>