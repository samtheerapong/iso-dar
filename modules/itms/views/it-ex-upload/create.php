<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\ItExUpload $model */

$this->title = Yii::t('app', 'Create It Ex Upload');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'It Ex Uploads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-ex-upload-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview'=>[],
        'initialPreviewConfig'=>[]
    ]) ?>

</div>
