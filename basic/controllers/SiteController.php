<?php

namespace app\controllers;

use app\models\Airports;
use app\models\Flights;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\XmlHandler;
use app\models\Search_Flight;

class SiteController extends Controller
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

    public function actionIndex()
    {
        $xml = simplexml_load_file('xml/task_xml.xml') or die("Error: Cannot create object");

        $results = new XmlHandler($xml);

        $search_Flight = new Search_Flight();
        $search_Flight->Send_and_Save($results);

        if ( empty($search_Flight->errors) )
            print_r('Save Sucecc');
        else
            print_r($search_Flight->errors);

        die;
    }

}
