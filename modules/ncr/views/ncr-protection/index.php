<?php

use app\modules\ncr\models\NcrProtection;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\search\NcrProtectionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Ncr Protections');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-protection-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ncr Protection'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ncr_id',
            'ncr_cause_id',
            'issue:ntext',
            'action:ntext',
            //'schedule_date',
            //'operator',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, NcrProtection $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
