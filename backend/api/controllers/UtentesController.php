<?php


namespace backend\api\controllers;

use common\models\ReceitaMedica;
use common\models\Utente;
use stdClass;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;


class UtentesController extends ActiveController
{

    public $modelClass = 'common\models\Utente';

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
        $utenteModel = new $this->modelClass;
        $recs = $utenteModel::find()->all();
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

        $object =  new stdClass();

        $user = Yii::$app->user->identity;

        $procurar = Utente::find()
            ->where(['id_user' =>  $user->getId()])
           // ->asArray()
            ->one();

        foreach ($procurar as $key => $value) {
            $object->{$key} = $value;
        }


        //$send = (object)$procurar;

        //$obj = json_decode (json_encode ($object), FALSE);

        return $object;
    }

}