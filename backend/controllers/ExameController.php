<?php

namespace backend\controllers;

use backend\models\Medicos;
use Yii;
use backend\models\Exame;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExameController implements the CRUD actions for Exame model.
 */
class ExameController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['verExame'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['verExame'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['criarExame'],
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Exame models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->can('verExame')) {
            $tempMed = Medicos::dataByUser(Yii::$app->user->id);
            $dataProvider = new ActiveDataProvider([
                'query' => Exame::find()
                    ->where(['id_medico' => $tempMed['id']]),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Exame model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(\Yii::$app->user->can('verExame')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Exame model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id,$data,$id_utente)
    {
        if(\Yii::$app->user->can('criarExame')) {
            $model = new Exame();

            if ($model->load(Yii::$app->request->post())) {
                $model->criarExame($id, $data, $id_utente);
                return $this->redirect(['index']);
            }

            return $this->render('create', ['model' => $model,]);
        }
    }

    /**
     * Finds the Exame model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exame the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exame::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
