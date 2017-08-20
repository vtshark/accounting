<?php

namespace app\modules\backend\controllers;


use yii\web\Controller;

class AdminMenuController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}