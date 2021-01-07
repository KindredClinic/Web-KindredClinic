<?php

namespace common\models;

use backend\models\Medicos;
use Yii;

/**
 * This is the model class for table "consulta".
 *
 * @property int $id
 * @property string $conteudo
 * @property string $date
 * @property int $id_marcacao
 * @property int $id_medico
 * @property int $id_utente
 *
 * @property MarcacaoConsulta $marcacao
 * @property Medicos $medico
 */
class Consulta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'consulta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['conteudo', 'date', 'id_marcacao', 'id_medico'], 'required'],
            [['date'], 'safe'],
            [['id_marcacao', 'id_medico'], 'integer'],
            [['conteudo'], 'string', 'max' => 255],
            [['id_marcacao'], 'exist', 'skipOnError' => true, 'targetClass' => MarcacaoConsulta::className(), 'targetAttribute' => ['id_marcacao' => 'id']],
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
            'id_marcacao' => 'Marcacao',
            'id_medico' => 'Médico',
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
        return $this->hasOne(MarcacaoConsulta::className(), ['id' => 'id_marcacao']);
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
     * Gets query for [[Utente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtente()
    {
        return $this->hasOne(Utente::className(), ['id' => 'id_utente']);
    }

    public function criarConsulta($id,$data,$id_utente){

        $tempMedic = Medicos::dataByUser(Yii::$app->user->id);


        $model = new Consulta();
        $model->conteudo = $this->conteudo;
        $model->date = $data;
        $model->id_medico = $tempMedic['id'];
        $model->id_marcacao = $id;
        $model->id_utente = $id_utente;

        $model->save();

    }

}
