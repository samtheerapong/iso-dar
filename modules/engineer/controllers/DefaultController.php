<?php

namespace app\modules\engineer\controllers;

use yii\web\Controller;

/**
 * Default controller for the `engineer` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSetingsMenu()
    {
        return $this->render('setings-menu');
    }
}
