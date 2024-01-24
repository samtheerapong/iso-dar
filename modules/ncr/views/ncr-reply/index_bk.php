<?php

use app\modules\ncr\models\NcrProcess;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Ncr Replies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-reply-index">

    <div class="ncr-index">
        <div style="display: flex; justify-content: space-between;">
            <p>
                <?= Html::a('<i class="fa fa-circle-plus text-yellow"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-danger']) ?>
            </p>

            <p style="text-align: right;">
                <?= Html::a('<i class="fa fa-screwdriver-wrench"></i> ' . Yii::t('app', 'Settings'), ['/ncr/ncr/setings-menu'], ['class' => 'btn btn-warning']) ?>
            </p>
        </div>

        <div class="card border-secondary">
            <div class="card-header text-white bg-secondary">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="card-body table-responsive">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        // 'id',
                        // 'ncr_id',
                        [
                            'attribute' => 'ncr_id',
                            'format' => 'html',
                            'headerOptions' => ['style' => 'width:150px;'],
                            'value' => function ($model) {
                                return $model->ncr_id ? Html::a($model->ncr0->ncr_number, ['view', 'id' => $model->id]) : 'N/A';
                            },
                        ],
                        [
                            'attribute' => 'process',
                            'format' => 'html',
                            'headerOptions' => ['style' => 'width:350px;'],
                            'value' => function ($model) {
                                // return $model->process ? '<span class="text" style="color:' . $model->ncrProcess->color . ';">' . $model->ncrProcess->name . '</span>' : 'N/A';
                                return $model->ncr0->process ? $model->ncr0->process . ' (' . $model->ncr0->product_name . ')' : 'N/A';
                            },
                            // 'filter' => Select2::widget([
                            //     'model' => $searchModel,
                            //     'attribute' => 'process',
                            //     'data' => ArrayHelper::map(NcrProcess::find()->where(['active' => 1])->all(), 'name', 'name'),
                            //     'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            //     'pluginOptions' => [
                            //         'allowClear' => true
                            //     ],
                            // ])
                        ],

                        [
                            'attribute' => 'reply_type_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return $model->reply_type_id ? $model->replyType->name : 'ยังไม่ได้ดำเนินการ';
                            },
                        ],
                        [
                            'attribute' => 'quantity',
                            'format' => 'html',
                            'value' => function ($model) {
                                return $model->quantity ? $model->quantity . ' ' . $model->unit : 'ยังไม่ได้ดำเนินการ';
                            },
                        ],
                        'unit',
                        //'method:ntext',
                        //'operation_date',
                        //'operation_name',
                        //'approve_name',
                        //'approve_date',
                        //'docs:ntext',
                        //'ref',
                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width:250px;'],
                            'contentOptions' => ['class' => 'text-center'],
                            'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                            'template' => '<div class="btn-group btn-group-xs" role="group">{view} {update} {reply}</div>',
                            'buttons' => [
                                'reply' => function ($url, $model, $key) {
                                    return Html::a('<i class="fa-solid fa-right-left"></i>', ['/ncr/ncr-reply/update', 'id' => $model->id], [
                                        'title' => Yii::t('app', 'Reply'),
                                        'class' => 'btn btn-outline-dark btn-sm',
                                    ]);
                                },
                            ],
                        ],
                    ],
                ]); ?>

            </div>
        </div>
    </div>
</div>