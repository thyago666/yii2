<?php

namespace app\controllers;

use yii\rest\ActiveController;
//use app\models\Produto;
use app\resource\Produto;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;

class ProdutoController extends ActiveController{

    
    public $modelClass = Produto::class;

    public function behaviors()
    {
        $beraviors = parent::behaviors();
        $beraviors['authenticator']['only'] = ['index','view','create','update','delete'];
        $beraviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];
        return $beraviors;
    }

    public function actions(){

        $actions = parent::actions();
       // unset($actions['index']);
        $actions['index']['prepareDataProvider']=[$this,'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider(){

        return new ActiveDataProvider([

            'query'=> $this->modelClass::find()->andWhere(['cliente_id'=> \Yii::$app->request->get('clienteId')])

        ]);
    }

}
