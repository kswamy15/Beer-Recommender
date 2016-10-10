<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\BeerNames;

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

    public function actionBeer()
    {
            
        $beer_names = array();
        if (Yii::$app->request->isPost) {
            if ($_POST) {
                $json = json_decode($_POST['beer_names']);
            }
            
            $beer_names = $json->beers;  
            
            if (!empty($beer_names)) {
                $serialized = implode(',',$beer_names);
                $data = 'data=' . rawurlencode($serialized);
                //echo $data."data";
                // Get cURL resource
                $curl = curl_init();
                // Set some options - we are passing in a useragent too here
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'http://localhost:8081/beers/10?'.$data,
                    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
                ));
                // Send the request & save response to $resp
                $resp = curl_exec($curl);
                // Close request to clear up some resources
                curl_close($curl);
                //echo " ".$resp;       
                //print_r($resp);  
                return ($resp);
            }
             
            //return json_encode($beer_names);
              //return "success";
        } else {

            $model = new BeerNames();
            return $this->render('beer',['model' => $model]);
        }      
    }
}
