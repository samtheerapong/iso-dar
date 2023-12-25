<?php

use app\modules\nfc\models\Part;
use app\modules\nfc\models\PartDoc;
use app\modules\nfc\models\PartGroup;
use app\modules\nfc\models\PartType;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\modules\nfc\models\search\PartSearcn $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Parts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-index">
    <div class="part-doc-index">

        <div style="display: flex; justify-content: space-between;">
            <p>
                <?= Html::a('<i class="fa fa-circle-plus"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <p style="text-align: right;">
                <?= Html::a('<i class="fa fa-screwdriver-wrench"></i> ' . Yii::t('app', 'Configs'), ['/engineer/default/setings-menu'], ['class' => 'btn btn-warning']) ?>
            </p>
        </div>

        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

        <div class="card border-secondary">
            <div class="card-header text-white bg-secondary">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="card-body table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'pager' => [
                        'class' => LinkPager::class,
                        'options' => ['class' => 'pagination justify-content-center m-1'],
                        'maxButtonCount' => 5,
                        'firstPageLabel' => Yii::t('app', 'First'),
                        'lastPageLabel' => Yii::t('app', 'Last'),
                        'options' => ['class' => 'pagination justify-content-center'],
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'contentOptions' => ['style' => 'width:40px;'],
                        ],

                        [
                            'attribute' => 'code',
                            'format' => 'html',
                            'contentOptions' => ['class' => 'text-center', 'style' => 'width:200px;'],
                            'value' => function ($model) {
                                return Html::a($model->code, ['view', 'id' => $model->id]);
                            },
                        ],

                        [
                            'attribute' => 'name',
                            'format' => 'html',
                            'value' => function ($model) {
                                return $model->name;
                            },
                        ],
                        // 'name_en',
                        //'old_code',
                        //'description:ntext',
                        [
                            'attribute' => 'en_part_doc_id',
                            'format' => 'html',
                            'headerOptions' => ['style' => 'width:200px;'],
                            'value' => function ($model) {
                                return $model->partDoc->name;
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'en_part_doc_id',
                                'data' => ArrayHelper::map(PartDoc::find()->where(['active' => 1])->all(), 'id', 'name'),
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        // 'en_part_group_id',
                        [
                            'attribute' => 'en_part_group_id',
                            'format' => 'html',
                            'headerOptions' => ['style' => 'width:200px;'],
                            'value' => function ($model) {
                                return $model->partGroup->name;
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'en_part_group_id',
                                'data' => ArrayHelper::map(PartGroup::find()->where(['active' => 1])->all(), 'id', 'name'),
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        // 'en_part_type_id',
                        [
                            'attribute' => 'en_part_type_id',
                            'format' => 'html',
                            'headerOptions' => ['style' => 'width:200px;'],
                            'value' => function ($model) {
                                return $model->partType->name;
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'en_part_type_id',
                                'data' => ArrayHelper::map(PartType::find()->where(['active' => 1])->all(), 'id', 'name'),
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        //'unit_lg',
                        //'unit_sm',
                        //'serial_no',
                        // 'price',
                        [
                            'attribute' => 'price',
                            'format' => 'html',
                            'headerOptions' => ['style' => 'width:100px;'],
                            'value' => function ($model) {
                                return Yii::$app->formatter->asDecimal($model->price, 2);
                            },

                        ],
                        //'cost',
                        //'active',
                        //'last_date',
                        //'remask:ntext',
                        //'imported',
                        // 'status',
                        [
                            'attribute' => 'status',
                            'format' => 'html',
                            'contentOptions' => ['style' => 'width:130px;'],
                            'value' => function ($model) {
                                return $model->status === 1 ? '<span class="badge" style="background-color:#ff6600">CREATED</span>' :
                                 '<span class="badge" style="background-color:#1A5D1A">APPROVED</span>';
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'status',
                                'data' => [
                                    '1' => 'CREATED',
                                    '2' => 'APPROVED'
                                ],
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width:250px;'],
                            'contentOptions' => ['class' => 'text-center'],
                            'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                            'template' => '<div class="btn-group btn-group-xs" role="group">{view} {update} {delete}</div>',

                        ],
                    ],
                ]); ?>

            </div>
        </div>
    </div>