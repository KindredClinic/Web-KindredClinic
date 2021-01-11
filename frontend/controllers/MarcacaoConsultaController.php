<?php

namespace frontend\controllers;

use backend\models\Especialidade;
use common\models\Utente;
use Yii;
use common\models\MarcacaoConsulta;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;


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
        $tempUtente = Utente::dataByUser(Yii::$app->user->id);
        $times = MarcacaoConsulta::dataByUserFront($tempUtente);

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
        if(\Yii::$app->user->can('criarMarcacaoConsulta')) {
            $tempUtente = Utente::dataByUser(Yii::$app->user->id);
            $dataProvider = new ActiveDataProvider([
                'query' => MarcacaoConsulta::find()
                    ->where(['id_utente' => $tempUtente]),
            ]);

        }

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
        $model = new MarcacaoConsulta();

        if(\Yii::$app->user->can('criarMarcacaoConsulta')) {

            if ($model->load(Yii::$app->request->post())) {
                $model->criarMarcacaoConsultaFront();
                return $this->redirect(['index', 'id' => $model->id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
