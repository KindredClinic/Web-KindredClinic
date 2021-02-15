<?php

namespace backend\api\controllers;


use backend\models\Medicos;
use common\models\MarcacaoConsulta;
use common\models\Utente;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class MarcacaoconsultasController extends ActiveController
{
    public $modelClass = 'fronend\models\MarcacaoConsulta';

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
        $marcacaoconsulta = new $this->modelClass;
        $recs = $marcacaoconsulta::find()->all();
        return ['total' => count($recs)];
    }

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);

        return $actions;
    }

    // Método que devolve a Marcacao da Consulta
    public function actionIndex(){

        $tempUtente = Utente::dataByUser(Yii::$app->user->id);

        $marcacaoConsulta = MarcacaoConsulta::find()
            ->where(['id_utente' => $tempUtente['id']])
         //   ->asArray()
            ->all();

        return $marcacaoConsulta;
    }

    // Método que devolve os quartos reservados da reserva
    public function actionMarcacaoconsulta($id){

        $reserva = MarcacaoConsulta::find()
            ->where(['id' => $id])
            ->one();

        return $reserva;
    }

    public function actionAdicionarconulta(){

        $model = new MarcacaoConsulta();

        //$model->criarMarcacaoConsultaFront();
        $params = Yii::$app->request->post();

        $model->id = $params['id'];
        $model->date = $params['date'];
        $model->id_especialidade = $params['id_especialidade'];
        $model->id_medico = $params['id_medico'];
        $model->id_utente = $params['id_utente'];
        $model->status = $params['status'];

        $model->save();
/*
        if($model->criarMarcacaoConsultaFront()){
            $response['isSuccess'] = 201;
            $response['message'] = "Marcacao registada com sucesso!";
            $response['user'] =\common\models\User::findByUsername($model->username);
            return $response;
        } else {
            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->getErrors();
            return $response;
        }
*/

        $response['isSuccess'] = 201;
        $response['message'] = "Marcacao registada com sucesso!";
        return $response;
    }

}
