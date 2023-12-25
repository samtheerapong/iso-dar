<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\nfc\models\Part $model */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="part-view">
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
                    <div class="col-md-4">
                        <?= Html::img($model->getPhotoViewer(), ['class' => 'img-fluid img-thumbnail mx-auto d-block', 'alt' => '...']); ?>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">

                            <?= DetailView::widget([
                                'model' => $model,
                                'template' => '<tr><th style="width: 200px;">{label}</th><td> {value}</td></tr>',
                                'attributes' => [
                                    // 'id',
                                    // 'photo:ntext',
                                    [
                                        'attribute' => 'code',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->code ? $model->code : Yii::t('app', '');
                                        },
                                    ],

                                    [
                                        'attribute' => 'name',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->name ? $model->name : Yii::t('app', '');
                                        },
                                    ],
                                    [
                                        'attribute' => 'name_en',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->name_en ? $model->name_en : Yii::t('app', '');
                                        },
                                    ],

                                    [
                                        'attribute' => 'serial_no',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->serial_no ? $model->serial_no : Yii::t('app', '');
                                        },
                                    ],

                                    [
                                        'attribute' => 'old_code',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->old_code ? $model->old_code : Yii::t('app', '');
                                        },
                                    ],
                                    // 'description:ntext',
                                    [
                                        'attribute' => 'description',
                                        'format' => 'ntext',
                                        'value' => function ($model) {
                                            return $model->description ? $model->description : Yii::t('app', '');
                                        },
                                    ],
                                    // 'en_part_doc_id',
                                    [
                                        'attribute' => 'en_part_doc_id',
                                        'format' => 'ntext',
                                        'value' => function ($model) {
                                            return $model->en_part_doc_id ? $model->partDoc->code . ' - ' . $model->partDoc->name : Yii::t('app', '');
                                        },
                                    ],
                                    // 'en_part_group_id',
                                    [
                                        'attribute' => 'en_part_group_id',
                                        'format' => 'ntext',
                                        'value' => function ($model) {
                                            return $model->en_part_group_id ? $model->partGroup->code . ' - ' . $model->partGroup->name : Yii::t('app', '');
                                        },
                                    ],
                                    // 'en_part_type_id',
                                    [
                                        'attribute' => 'en_part_type_id',
                                        'format' => 'ntext',
                                        'value' => function ($model) {
                                            return $model->en_part_type_id ? $model->partType->code . ' - ' . $model->partType->name : Yii::t('app', '');
                                        },
                                    ],
                                    // 'unit_lg',
                                    [
                                        'attribute' => 'unit_lg',
                                        'format' => 'ntext',
                                        'value' => function ($model) {
                                            return $model->unit_lg ? $model->unitLg->name : Yii::t('app', '');
                                        },
                                    ],
                                    // 'unit_sm',
                                    [
                                        'attribute' => 'unit_sm',
                                        'format' => 'ntext',
                                        'value' => function ($model) {
                                            return $model->unit_sm ? $model->unitSm->name : Yii::t('app', '');
                                        },
                                    ],
                                    // 'price',
                                    [
                                        'attribute' => 'price',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->price ? Yii::$app->formatter->asDecimal($model->price, 2) . ' บาท' : Yii::t('app', '');
                                        },
                                    ],

                                    // 'cost',
                                    [
                                        'attribute' => 'cost',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->cost ? Yii::$app->formatter->asDecimal($model->cost, 2) . ' บาท' : Yii::t('app', '');
                                        },
                                    ],
                                    // 'last_date',
                                    [
                                        'attribute' => 'last_date',
                                        'format' => 'date',
                                        'value' => function ($model) {
                                            return $model->last_date ? $model->last_date : Yii::t('app', '');
                                        },
                                    ],
                                    // 'remask:ntext',
                                    [
                                        'attribute' => 'remask',
                                        'format' => 'ntext',
                                        'value' => function ($model) {
                                            return $model->remask ? $model->remask : Yii::t('app', '');
                                        },
                                    ],
                                    [
                                        'attribute' => 'imported',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->imported === 1 ?
                                                '<span class="badge" style="background-color:#009999">' . Yii::t('app', 'No') . '</span>' :
                                                '<span class="badge" style="background-color:#ff0066">' . Yii::t('app', 'Yes') . '</span>';
                                        },
                                    ],
                                    [
                                        'attribute' => 'status',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->status === 1 ?
                                                '<span class="badge" style="background-color:#0066ff">' . Yii::t('app', 'Created') . '</span>' :
                                                '<span class="badge" style="background-color:#1A5D1A">' . Yii::t('app', 'Approved') . '</span>';
                                        },
                                    ],

                                    [
                                        'attribute' => 'active',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return $model->active === 1 ?
                                                '<span class="badge" style="background-color:#1A5D1A">' . Yii::t('app', 'Yes') . '</span>' :
                                                '<span class="badge" style="background-color:#FE0000">' . Yii::t('app', 'No') . '</span>';
                                        },
                                    ],
                                ],
                            ]) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>