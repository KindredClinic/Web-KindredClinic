<?php

namespace backend\models;

use common\models\MarcacaoExame;
use common\models\Utente;
use Yii;
use yii\db\Query;

/**
 * This is the model class for table "exame".
 *
 * @property int $id
 * @property string $conteudo
 * @property string $date
 * @property int $id_medico
 * @property int $id_marcacao
 * @property int $id_utente
 *
 * @property MarcacaoExame $marcacao
 * @property Medicos $medico
 */
class Exame extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exame';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['conteudo', 'date', 'id_medico', 'id_marcacao'], 'required'],
            [['date'], 'safe'],
            [['id_medico', 'id_marcacao'], 'integer'],
            [['conteudo'], 'string', 'max' => 255],
            [['id_marcacao'], 'exist', 'skipOnError' => true, 'targetClass' => MarcacaoExame::className(), 'targetAttribute' => ['id_marcacao' => 'id']],
            [['id_medico'], 'exist', 'skipOnError' => true, 'targetClass' => Medicos::className(), 'targetAttribute' => ['id_medico' => 'id']],
            [['id_utente'], 'exist', 'skipOnError' => true, 'targetClass' => Utente::className(), 'targetAttribute' => ['id_utente' => 'id']],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'conteudo' => 'Conteudo',
            'date' => 'Data',
            'id_medico' => 'Medico',
            'id_marcacao' => 'Marcacao',
            'id_utente' => 'Utente',
        ];
    }

    /**
     * Gets query for [[Marcacao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacao()
    {
        return $this->hasOne(MarcacaoExame::className(), ['id' => 'id_marcacao']);
    }

    public function getUtente()
    {
        return $this->hasOne(Utente::className(), ['id' => 'id_utente'])->via('marcacao');
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

    public function criarExame($id,$data,$id_utente){

        $tempMedic = Medicos::dataByUser(Yii::$app->user->id);

        $model = new Exame();
        $model->conteudo = $this->conteudo;
        $model->date = $data;
        $model->id_medico = $tempMedic['id'];
        $model->id_marcacao = $id;
        $model->id_utente = $id_utente;

        $model->save();

    }

    /**
     * @return string
     */
    public function getConteudo()
    {
        return $this->conteudo;
    }

    /**
     * @param string $conteudo
     */
    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

}
