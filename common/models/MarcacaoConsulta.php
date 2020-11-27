<?php

namespace common\models;

use backend\models\Especialidade;
use backend\models\Medicos;
use Yii;

/**
 * This is the model class for table "marcacao_consulta".
 *
 * @property int $id
 * @property string $date
 * @property int $id_medico
 * @property int $id_especialidade
 * @property int $id_utente
 *
 * @property Consulta $consulta
 * @property Utente $utente
 * @property Medicos $medico
 * @property Especialidade $especialidade
 */
class MarcacaoConsulta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marcacao_consulta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'id_medico', 'id_especialidade', 'id_utente'], 'required'],
            [['date'], 'safe'],
            [['id_medico', 'id_especialidade', 'id_utente'], 'integer'],
            [['id_utente'], 'exist', 'skipOnError' => true, 'targetClass' => Utente::className(), 'targetAttribute' => ['id_utente' => 'id']],
            [['id_medico'], 'exist', 'skipOnError' => true, 'targetClass' => Medicos::className(), 'targetAttribute' => ['id_medico' => 'id']],
            [['id_especialidade'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidade::className(), 'targetAttribute' => ['id_especialidade' => 'id']],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'id_medico' => 'Medico',
            'id_especialidade' => 'Especialidade',
            'id_utente' => 'Utente',
        ];
    }

    /**
     * Gets query for [[Consulta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consulta::className(), ['id_marcacao' => 'id']);
    }

    /**
     * Gets query for [[Utente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtente()
    {
        return $this->hasOne(Utente::className(), ['id' => 'id_utente']);
    }

    /**
     * Gets query for [[Medico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedico()
    {
        return $this->hasOne(Medicos::className(), ['id' => 'id_medico']);
    }

    /**
     * Gets query for [[Especialidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidade()
    {
        return $this->hasOne(Especialidade::className(), ['id' => 'id_especialidade']);
    }

    public function criarMarcacaoConsulta(){

        $model = new MarcacaoConsulta();
        $model->date = $this->date;
        $model->id_especialidade = $this->id_especialidade;
        $model->id_medico = $this->id_medico;
        $model->id_utente = Yii::$app->user->id;

        $model->save();
    }

    public static function getSubDropDownList($especialidade){

        $procurar = Medicos::find()
            ->select(['id as id', 'nome as name'])
            ->where(['id_especialidade' => $especialidade])
            ->asArray()
            ->all();


        return $procurar;
    }
}
