<?php


namespace backend\api\controllers;


use common\models\Consulta;
use common\models\MarcacaoConsulta;
use yii\rest\ActiveController;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class ConsultasController extends ActiveController
{
    public $modelClass = 'common\models\Consulta';

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
        $consultamodel = new $this->modelClass;
        $recs = $consultamodel::find()->all();
        return ['total' => count($recs)];
    }

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);

        return $actions;
    }

// Método que devolve as consultas do utente após a autenticação
    public function actionIndex(){

        $user = Yii::$app->user->identity;

        $consultas = Consulta::find()
            ->where(['id_utente' => $user->getId()])
            ->asArray()
            ->all();

        return $consultas;
    }

    // Método que devolve a Marcacao da Consulta
    public function actionMarcacaoConsulta($id){

        $consulta = Consulta::find()->where(['id' => $id])->one();

        $marcacaoConsulta = MarcacaoConsulta::find()
            ->where(['id_consulta' => $consulta->id])
            ->asArray()
            ->all();

        return $marcacaoConsulta;
    }

}