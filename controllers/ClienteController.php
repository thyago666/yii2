<?php

namespace app\controllers;

use yii\rest\ActiveController;
//use app\models\Cliente;
use app\resource\Cliente;
use yii\filters\auth\HttpBearerAuth;

class ClienteController extends ActiveController{

    public $modelClass = Cliente::class;

    public function behaviors()
    {
        $beraviors = parent::behaviors();
        $beraviors['authenticator']['only'] = ['index','create','update','delete'];
        $beraviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];
        return $beraviors;
    }

    public function actionCreate()
    {
        $model = new Cliente();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            // Os dados do cliente são válidos, você pode prosseguir com a gravação
            // do cliente no banco de dados
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            // Exibir o formulário com os erros de validação
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

}
