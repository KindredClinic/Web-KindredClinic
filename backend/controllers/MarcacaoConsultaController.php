<?php

namespace backend\controllers;

use backend\models\Especialidade;
use backend\models\Medicos;
use Yii;
use common\models\MarcacaoConsulta;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii2fullcalendar\models\Event;

/**
 * MarcacaoConsultaController implements the CRUD actions for MarcacaoConsulta model.
 */
class MarcacaoConsultaController extends Controller
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
                        'roles' => ['verMarcacaoConsulta'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['verMarcacaoConsulta'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['criarMarcacaoConsulta'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['alterarMarcacaoConsulta'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['grid'],
                        'roles' => ['verMarcacaoConsulta'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['subcat'],
                        'roles' => ['criarMarcacaoConsulta'],
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all MarcacaoConsulta models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->can('verMarcacaoConsulta')) {
            $tempVariable = Medicos::dataByUser(Yii::$app->user->id);
            $times = MarcacaoConsulta::dataByUserBack($tempVariable['id']);

            $events = [];
            foreach ($times as $time) {

                $temp = Especialidade::dataByEspecialidade($time['id_especialidade']);


                $Event = new Event();
                $Event->id = $time['id'];
                $Event->backgroundColor = $this->chooseColor($time['status']);
                $Event->title = $temp['tipo'];
                $Event->start = date(($time['date']));
                $Event->url = 'index.php?r=marcacao-consulta/view&id=' . $time['id'];
                $events[] = $Event;

            }

            return $this->render('index', [
                'events' => $events,
            ]);
        }
    }

    public function chooseColor($tipo){
        if($tipo == 'Aprovado'){
            return 'green';
        }
        elseif ($tipo == 'Em Espera'){
            return 'orange';
        }
        elseif ($tipo == 'Rejeitado'){
            return 'red';
        }

        return 'white';
    }

    public function actionGrid(){
        if(\Yii::$app->user->can('verMarcacaoConsulta')) {
            $tempMed = Medicos::dataByUser(Yii::$app->user->id);
            $dataProvider = new ActiveDataProvider([
                'query' => MarcacaoConsulta::find()
                    ->where(['id_medico' => $tempMed['id']]),
            ]);

            return $this->render('grid', [
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single MarcacaoConsulta model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(\Yii::$app->user->can('verMarcacaoConsulta')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new MarcacaoConsulta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->can('criarMarcacaoConsulta')) {
            $model = new MarcacaoConsulta();

            if ($model->load(Yii::$app->request->post())) {
                $model->criarMarcacaoConsultaBack();
                return $this->redirect(['index', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MarcacaoConsulta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(\Yii::$app->user->can('alterarMarcacaoConsulta')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MarcacaoConsulta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MarcacaoConsulta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MarcacaoConsulta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MarcacaoConsulta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
