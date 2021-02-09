<?php


namespace backend\api\controllers;


use common\models\ReceitaMedica;
use common\models\Utente;
use yii\rest\ActiveController;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class ReceitaController extends ActiveController
{
    public $modelClass = 'common\models\ReceitaMedica';

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

    public function actionIndex(){

        $tempUtente = Utente::dataByUser(Yii::$app->user->id);

        $receitaMedica = ReceitaMedica::find()
            ->where(['id_utente' => $tempUtente['id']])
            ->all();

        return $receitaMedica;
    }

    public function  actionTotal(){
        $receitamodel = new $this->modelClass;
        $recs = $receitamodel::find()->all();
        return ['total' => count($recs)];
    }

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);

        return $actions;
    }
}