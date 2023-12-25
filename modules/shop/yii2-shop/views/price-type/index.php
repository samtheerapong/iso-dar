<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\export\ExportMenu;

$this->title = 'Типы цен';
$this->params['breadcrumbs'][] = ['label' => 'Магазин', 'url' => ['/shop/default/index']];
$this->params['breadcrumbs'][] = $this->title;

\pistol88\shop\assets\BackendAsset::register($this);
?>
<div class="price-type-index">

    <div class="row">
        <div class="col-md-1">
            <?= Html::tag('button', 'Удалить', [
                'class' => 'btn btn-success pistol88-mass-delete',
                'disabled' => 'disabled',
                'data' => [
                    'model' => $dataProvider->query->modelClass,
                ],
            ]) ?>
        </div>
        <div class="col-md-2">
            <?= Html::a('Добавить новый тип', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    
    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => '\kartik\grid\CheckboxColumn'],
            ['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 55px;']],
            
            'name',
            'sort',
            
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}']
        ],
    ]); ?>

</div>
