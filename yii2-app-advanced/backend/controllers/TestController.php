<?php
/**
 * Created by PhpStorm.
 * User: SAMSUNG
 * Date: 2017/11/4
 * Time: 10:54
 */

namespace backend\controllers;


use yii\web\Controller;

class TestController extends Controller
{

    public function actionIndex()
    {

        return $this->render('index');
    }
}