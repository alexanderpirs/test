<?php

namespace app\controllers;
use yii\web\Controller;
use app\models\genders;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
class GendersController extends Controller
{
    
    
    public function behaviors()
    {
        return [
            
            
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    } 
    
    
    
    public function actionGenders()
    {
        $model = new genders();
        return $this->render('genders',array('model'=>$model));
    }

}
