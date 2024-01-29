<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrReply $model */

$this->title = Yii::t('app', 'Reply'). ' : ' . $model->ncrs->ncr_number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reply'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ncrs->ncr_number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ncr-reply-update">

    <p>
        <?= Html::a('<i class="fas fa-circle-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>