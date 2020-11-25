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
 * @property Medicamentos $medicamentos
 * @property Utente $utente
 * @property Medicos $medico
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
            [['id_medicamentos'], 'exist', 'skipOnError' => true, 'targetClass' => Medicamentos::className(), 'targetAttribute' => ['id_medicamentos' => 'id']],
            [['id_utente'], 'exist', 'skipOnError' => true, 'targetClass' => Utente::className(), 'targetAttribute' => ['id_utente' => 'id']],
            [['id_medico'], 'exist', 'skipOnError' => true, 'targetClass' => Medicos::className(), 'targetAttribute' => ['id_medico' => 'id']],
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
            'id_medico' => 'Id Medico',
            'id_utente' => 'Id Utente',
            'id_medicamentos' => 'Id Medicamentos',
        ];
    }

    /**
     * Gets query for [[Medicamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamentos()
    {
        return $this->hasOne(Medicamentos::className(), ['id' => 'id_medicamentos']);
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
}
