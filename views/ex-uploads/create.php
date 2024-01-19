<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ExUploads $model */

$this->title = Yii::t('app', 'Create Ex Uploads');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ex Uploads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ex-uploads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview'=>[],
        'initialPreviewConfig'=>[]
    ]) ?>

</div>
