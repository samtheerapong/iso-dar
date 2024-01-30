<?php

namespace app\modules\ncr\controllers;

use app\modules\ncr\models\search\NcrClosingSearch;
use app\modules\ncr\models\search\NcrProtectionSearch;
use app\modules\ncr\models\search\NcrReplySearch;
use app\modules\ncr\models\search\NcrSearch;
use yii\web\Controller;

class ExportController extends Controller
{
    public function actionExportNcr()
    {
        $searchModel = new NcrSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('export-ncr', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportReply()
    {
        $searchModel = new NcrReplySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('export-reply', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportProtection()
    {
        $searchModel = new NcrProtectionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('export-protection', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExportClosing()
    {
        $searchModel = new NcrClosingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('export-closing', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
