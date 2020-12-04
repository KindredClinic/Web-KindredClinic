<?php

namespace frontend\controllers;

use backend\models\Especialidade;
use Yii;
use common\models\MarcacaoConsulta;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii2fullcalendar\models\Event;
use yii2fullcalendar\tests\unit\FullcalendarTest;


/**
 * MarcacaoConsultaController implements the CRUD actions for MarcacaoConsulta model.
 */
class MarcacaoConsultaController extends Controller
{
    public $id;
    public $data;
    public $id_especialidade;
    public $id_medico;

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
        ];
    }

    /**
     * Lists all MarcacaoConsulta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $times = MarcacaoConsulta::dataByUser(Yii::$app->user->id);

        $events = [];
        foreach ($times AS $time){

            $temp = Especialidade::dataByEspecialidade($time['id_especialidade']);


            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $time['id'];
            $Event->backgroundColor = $this->chooseColor($time['status']);
            $Event->title = $temp['tipo'];
            $Event->start = date(($time['date']));
            $Event->url = 'index.php?r=marcacao-consulta/view&id='.$time['id'];
            $events[] = $Event;

        }

        return $this->render('index', [
            'events' => $events,
        ]);

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
        $dataProvider = new ActiveDataProvider([
            'query' => MarcacaoConsulta::find()
            ->where(['id_utente' => Yii::$app->user->id]),
        ]);

        return $this->render('grid', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single MarcacaoConsulta model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MarcacaoConsulta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MarcacaoConsulta();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->criarMarcacaoConsulta();
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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


// THE CONTROLLER
    public function actionSubcat() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $especialidade = $parents[0];
                $out = MarcacaoConsulta::getSubDropDownList($especialidade);

                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]

                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }


}
