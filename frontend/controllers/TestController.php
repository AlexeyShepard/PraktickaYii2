<?php

namespace frontend\controllers;

use yii\web\Controller;

class TestController extends Controller
{
	
    public function actionSay($message = 'Привет')
    {
        return $this->render('say', ['message' => $message]);
    }
}

?>