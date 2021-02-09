<?php


namespace backend\api\controllers;

use common\models\MarcacaoExame;
use common\models\Utente;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class MarcacaoexamesController extends ActiveController
{
    public $modelClass = 'common\models\MarcacaoExame';

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
        $marcacaoexame = new $this->modelClass;
        $recs = $marcacaoexame::find()->all();
        return ['total' => count($recs)];
    }

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);

        return $actions;
    }

    // Método que devolve a Marcacao do Exame
    public function actionIndex(){

        $tempUtente = Utente::dataByUser(Yii::$app->user->id);

        $marcacaoexame = MarcacaoExame::find()
            ->where(['id_utente' => $tempUtente['id']])
            //   ->asArray()
            ->all();

        return $marcacaoexame;
    }

}