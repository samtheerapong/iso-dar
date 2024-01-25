<?php

use app\models\Department;
use app\modules\ncr\models\Ncr;
use app\modules\ncr\models\NcrMonth;
use app\modules\ncr\models\NcrProcess;
use app\modules\ncr\models\NcrReply;
use app\modules\ncr\models\NcrReplyType;
use app\modules\ncr\models\NcrStatus;
use kartik\widgets\Select2;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Ncrs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-index">

    <div class="ncr-index">
        <div style="display: flex; justify-content: space-between;">
            <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'NCR Home'), ['/ncr/ncr/index'], ['class' => 'btn btn-primary']) ?>
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
                    'filterModel' => [$searchModel, $searchNcr],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'contentOptions' => ['class' => 'text-center', 'style' => 'width:45px;'], //กำหนด ความกว้างของ #
                        ],
                        [
                            'attribute' => 'ncr_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return $model->ncr_id ? Html::a($model->ncrs->ncr_number, ['/ncr/ncr/view', 'id' => $model->ncrs->id]) : 'N/A';
                            },

                            'value' => function ($model) {
                                $rpValule = $model->ncr_id ?
                                    $model->ncrs->ncr_number . ' ' .
                                    '<span class="badge bg-danger">' . $model->ncrs->process . '</span>' . ' ' .
                                    '<span class="badge bg-warning text-dark">' . $model->ncrs->product_name . '</span>'  . ' ' .
                                    '<span class="badge bg-dark">' . $model->ncrs->lot . '</span>'   . ' ' .
                                    '<span class="badge bg-info text-dark">' .  Yii::$app->formatter->asDate($model->ncrs->production_date) . '</span>' :
                                    Yii::t('app', 'N/A');

                                return  Html::a($rpValule, ['/ncr/ncr/view', 'id' => $model->ncrs->id]);
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'ncr_id',
                                'data' => ArrayHelper::map(Ncr::find()->orderBy(['id' => SORT_DESC])->all(), 'id', function ($dataValue, $defaultValue) {
                                    return
                                        $dataValue->ncr_number.' | '.$dataValue->product_name . ' ('. Yii::$app->formatter->asDate($dataValue->production_date).')';
                                }),
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'language' => 'th',
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],

                        [
                            'attribute' => 'reply_type_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                $value = $model->reply_type_id ? $model->replyType->name : 'ยังไม่ได้ดำเนินการ';
                                $color = $model->reply_type_id ? 'black' : 'red'; 
                                return '<span style="color:' . $color . ';">' . $value . '</span>';
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'reply_type_id',
                                'data' => ArrayHelper::map(NcrReplyType::find()->all(), 'id', 'name'),
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],

                        [
                            'attribute' => 'quantity',
                            'format' => 'html',
                            'value' => function ($model) {
                                $value = $model->quantity ? $model->quantity . ' ' . $model->unit  : 'N/A';
                                $color = $model->quantity ? 'black' : 'red'; 
                                return '<span style="color:' . $color . ';">' . $value . '</span>';
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'quantity',
                                'data' => ArrayHelper::map(NcrReply::find()->all(), 'quantity', 'quantity'),
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        
                        [
                            'attribute' => 'operation_date',
                            'headerOptions' => ['style' => 'width:200px;'],
                            'format' => 'html',
                            'value' => function ($model) {
                                $value = $model->operation_date ? Yii::$app->formatter->asDate($model->operation_date) : 'ยังไม่ได้ดำเนินการ';
                                $color = $model->operation_date ? 'black' : 'red'; 
                                return '<span style="color:' . $color . ';">' . $value . '</span>';
                            },
                            'filter' => DatePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'operation_date',
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,
                                ]
                            ]),
                        ],
                        
                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width:250px;'],
                            'contentOptions' => ['class' => 'text-center'],
                            'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                            'template' => '<div class="btn-group btn-group-xs" role="group">{view} {action} {approve}</div>',
                            'buttons' => [
                                'action' => function ($url, $model, $key) {
                                    return Html::a('<i class="fas fa-location-arrow"></i>', ['/ncr/ncr-reply/update', 'id' => $model->id], [
                                        'title' => Yii::t('app', 'Action'),
                                        'class' => 'btn btn-outline-dark btn-sm',
                                    ]);
                                },
                                'approve' => function ($url, $model, $key) {
                                    return Html::a('<i class="fas fa-check-circle"></i>', ['/ncr/ncr-reply/approve', 'id' => $model->id], [
                                        'title' => Yii::t('app', 'Approve'),
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