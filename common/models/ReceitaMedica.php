<?php

namespace common\models;

use backend\models\Medicos;
use Yii;

/**
 * This is the model class for table "receita_medica".
 *
 * @property int $id
 * @property string $date
 * @property string $conteudo
 * @property int $id_medico
 * @property int $id_utente
 * @property int $id_medicamentos
 *
 * @property  Medicamentos $medicamento
 * @property Medicos $medico
 * @property Utente $utente
 */
class ReceitaMedica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receita_medica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'conteudo', 'id_medico', 'id_utente', 'id_medicamentos'], 'required'],
            [['date'], 'safe'],
            [['id_medico', 'id_utente', 'id_medicamentos'], 'integer'],
            [['conteudo'], 'string', 'max' => 255],
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
            'conteudo' => 'Conteudo',
            'id_medico' => 'Medico',
            'id_utente' => 'Utente',
            'id_medicamentos' => 'Medicamento',
        ];
    }

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

    public function getMedicamento()
    {
        return $this->hasOne(Medicamentos::className(), ['id' => 'id_medicamentos']);
    }

    public function criarReceitaMedica(){
        $tempMedic = Medicos::dataByUser(Yii::$app->user->id);
        $receita = new ReceitaMedica();

        $receita->date = date('Y-m-d H:i:s');
        $receita->conteudo = $this->conteudo;
        $receita->id_medico = $tempMedic['id'];
        $receita->id_utente = $this->id_utente;
        $receita->id_medicamentos = $this->id_medicamentos;

        $receita->save();
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @param string $conteudo
     */
    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
    }
}
