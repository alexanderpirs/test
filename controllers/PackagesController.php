<?php

namespace app\controllers;
use Yii;
use app\models\AgendaPeriodes;
use \app\models\WeddingTentativePeriodes;
use yii\data\ActiveDataProvider;
use app\models\WeddingEvent;
use yii\web\Response;
use \app\models\Items;
use \app\models\Suppliers;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;

class PackagesController extends \yii\web\Controller
{
    
    
        public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
//                
//                'only' => ['login', 'logout', 'signup'],
                'rules' => [

                    [
                        'allow' => true,
                        'actions' => ['index','add-comment','comment-by-id','new-comment-form' ],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','new-comment-form'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
    

        
       $dataPackages = new ActiveDataProvider([
            'query' => \app\models\PackagesGroups::find(),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
           if($dataPackages!=null){
               $dataPackages=$dataPackages->getModels();
           }     
           
           \Yii::$app->view->title = 'Packages';
           
           \Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => 'wedding packages',
]);
\Yii::$app->view->registerMetaTag([
    'name' => 'keywords',
    'content' => 'wedding packages',
]);
        return $this->render('index', [
                    
                    'dataPackages'=>$dataPackages,
//            'dataProvider1' => $dataProvider1,
        ]);
    }
public function actionAddComment(){
 Yii::error("Index Controller ");
    $CouplePartnerID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }  
        if($CouplePartnerID!=0){
            $CommentModel = new \app\models\PackageComments();
            $Comment = Yii::$app->request->post('Comment');
            $PackageID=Yii::$app->request->post('PackageID');
            $Sc=Yii::$app->request->post('Sc');
            
            $Time=time();
                Yii::error('Saving : 1 '.$Time);
                $date = date("Y-m-d H:i:s",$Time);
            $CommentModel->PACKAGE_COMMENT_VALUE=$Comment;
            $CommentModel->POST_DATE=$date;
            $CommentModel->RATING=$Sc;
            $CommentModel->COUPLE_PARTNER_ID=$CouplePartnerID;
            $CommentModel->PACKAGE_ID=$PackageID;
            if($CommentModel->save(false)){
             Yii::$app->response->format = Response::FORMAT_JSON;
                    return [
                        'success' => $CommentModel->getPrimaryKey(),
                    ];   
            }else{
                Yii::$app->response->format = Response::FORMAT_JSON;
                    return [
                        'error' => false,
                    ];
            }
            
             
        }
}
public function actionCommentById(){
    $CouplePartnerID = 0;

        if (Yii::$app->user->identity != null) {
            $CouplePartnerID = Yii::$app->user->identity->COUPLE_PARTNER_ID != NULL ? Yii::$app->user->identity->COUPLE_PARTNER_ID : 0;
        }  
        $CommentID=Yii::$app->request->get('CommentID');
        Yii::error('CommentIDDDDDDDDDDDDDD : '.$CommentID);
    $dataComment = new ActiveDataProvider([
            'query' => \app\models\PackageComments::find()->where(['PACKAGE_COMMENT_ID'=>$CommentID,'COUPLE_PARTNER_ID'=>$CouplePartnerID]),
//                ->innerJoin('agenda_periode_translation','agenda_periode_translation.AGENDA_PERIOD_ID = AGENDA_PERIODE_ID')->andFilterWhere(['=', 'agenda_periode_translation.LANGUAGE_ID', 2]),
        ]);
           if($dataComment!=null){
               $dataComment=$dataComment->getModels();
           }
           return $this->renderAjax('_comment', [
                    'Comment' => $dataComment,
                    
//            'dataProvider1' => $dataProvider1,
        ]);
}

public  function actionNewCommentForm(){
     $packageID=Yii::$app->request->get('PackageID');
    return $this->renderAjax('_newcomment', [
                    'packageID' => $packageID,
                    
//            'dataProvider1' => $dataProvider1,
        ]);
    
}
}
