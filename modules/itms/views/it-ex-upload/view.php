<?php

use dosamigos\gallery\Gallery;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\ItExUpload $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'It Ex Uploads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="it-ex-upload-view">
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
            <?= Html::encode($model->title) ?>
        </div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'id',
                    // 'ref',
                    'title',
                    // [
                    //     'attribute' => 'photo',
                    //     'format' => 'html',
                    //     'value' => function ($model) {
                    //         $thumbnails = $model->getThumbnails($model->ref, $model->title);
                    //         if (!empty($thumbnails)) {
                    //             return Html::img($thumbnails[0]['src'], ['width' => '200px']);
                    //         } else {
                    //             return ''; // or any fallback image if no thumbnails are available
                    //         }
                    //     },
                    // ],
                    // [
                    //     'attribute' => 'photo',
                    //     'format' => 'html',
                    //     'value' => function ($model) {
                    //         $thumbnails = $model->getThumbnails($model->ref, $model->title);
                    //         $html = '';
                    //         foreach ($thumbnails as $thumbnail) {
                    //             $html .= Html::img($thumbnail['src'], ['width' => '200px']) . '<br>';
                    //         }
                    //         return $html;
                    //     },
                    // ],
                    [
                        'attribute' => 'photo',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Gallery::widget([
                                'items' => $model->getImageThumbnails($model->img_ref),
                            ]);
                        },
                    ],

                ],
            ]) ?>

        </div>
    </div>

</div>