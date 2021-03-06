<?php


namespace backend\api\controllers;

use backend\models\Exame;
use common\models\Utente;
use yii\rest\ActiveController;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class ExameController extends ActiveController
{
    public $modelClass = 'backend\models\Exame';

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
        $examemodel = new $this->modelClass;
        $recs = $examemodel::find()->all();
        return ['total' => count($recs)];
    }

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index']);

        return $actions;
    }

    // Método que devolve as Receita do utente após a autenticação
    public function actionIndex(){

        $tempUtente = Utente::dataByUser(Yii::$app->user->id);

        $exames = Exame::find()
            ->where(['id_utente' => $tempUtente['id']])
          //  ->asArray()
            ->all();

        return $exames;
    }

    // Método que devolve um Exame
    public function actionExame($id){

        $exame = Exame::find()
            ->where(['id' => $id])
            ->one();

        return $exame;
    }


}