<?php

namespace backend\api\controllers;


use backend\models\Medicos;
use common\models\Consulta;
use common\models\MarcacaoConsulta;
use common\models\Utente;
use yii\rest\ActiveController;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class MedicosController extends ActiveController
{
    public $modelClass = 'backend\models\Medicos';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' =>  [$this, 'auth'],
                ],
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    public function auth($username, $password)
    {
        $user = \common\models\User::findByUsername($username);
        if ($user && $user->validatePassword($password))
        {
            return $user;
        }
        return null;
    }

    public function  actionTotal(){
        $medicosmodel = new $this->modelClass;
        $recs = $medicosmodel::find()->all();
        return ['total' => count($recs)];
    }

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);

        return $actions;
    }

// Método que devolve todos os medicos
    public function actionIndex(){

        $medicos = Medicos::find()
            ->all();

        return $medicos;
    }

    // Método que devolve um Medico
    public function actionMedico($id){

        $medico = Medicos::find()
            ->where(['id' => $id])
            ->all();

        return $medico;
    }

}