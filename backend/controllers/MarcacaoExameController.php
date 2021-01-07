<?php

namespace backend\controllers;

use backend\models\Especialidade;
use backend\models\Medicos;
use common\models\MarcacaoConsulta;
use Yii;
use common\models\MarcacaoExame;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * MarcacaoExameController implements the CRUD actions for MarcacaoExame model.
 */
class MarcacaoExameController extends Controller
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
        ];
    }

    /**
     * Lists all MarcacaoExame models.
     * @return mixed
     */
    public function actionIndex()
    {
        $tempVariable = Medicos::dataByUser(Yii::$app->user->id);
        $times = MarcacaoExame::dataByUser($tempVariable);

        $events = [];
        foreach ($times AS $time){

            $temp = Especialidade::dataByEspecialidade($time['id_especialidade']);


            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $time['id'];
            $Event->backgroundColor = $this->chooseColor($time['status']);
            $Event->title = $temp['tipo'];
            $Event->start = date(($time['date']));
            $Event->url = 'index.php?r=marcacao-exame/view&id='.$time['id'];
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
            'query' => MarcacaoExame::find()
                ->where(['id_medico' => Medicos::dataByUser(Yii::$app->user->id)]),
        ]);

        return $this->render('grid', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single MarcacaoExame model.
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
     * Creates a new MarcacaoExame model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MarcacaoExame();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->criarMarcacaoExame();
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MarcacaoExame model.
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
     * Deletes an existing MarcacaoExame model.
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
     * Finds the MarcacaoExame model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MarcacaoExame the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MarcacaoExame::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSubcat() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $especialidade = $parents[0];
                $out = MarcacaoExame::getSubDropDownList($especialidade);

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
