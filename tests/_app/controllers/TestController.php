<?php

namespace yiiacceptance\controllers;

use yii\web\Controller;
use yiiacceptance\models\TestModel;
use yiiacceptance\models\RequiredModel;
use yiiacceptance\models\DropDownModel;
use yiiacceptance\models\PreExistingValueModel;

/**
*
*/
class TestController extends Controller
{
    public function actionIndex()
    {
        $model = new TestModel;

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionRequired()
    {
        $model = new RequiredModel;

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionWithData()
    {
        $model = new PreExistingValueModel;

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionDropDown()
    {
        $model = new DropDownModel;

        return $this->render('index', [
            'model' => $model
        ]);
    }
}
