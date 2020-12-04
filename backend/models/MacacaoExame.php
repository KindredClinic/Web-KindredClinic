<?php

namespace backend\models;

use common\models\Utente;
use Yii;

/**
 * This is the model class for table "macacao_exame".
 *
 * @property int $id
 * @property string $date
 * @property int $id_medico
 * @property int $id_utente
 * @property string $status
 * @property int $id_especialidade
 *
 * @property Exame $exame
 * @property Medicos $medico
 * @property Utente $utente
 * @property Especialidade $especialidade
 */
class MacacaoExame extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'macacao_exame';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'id_medico', 'id_utente', 'id_especialidade'], 'required'],
            [['date'], 'safe'],
            [['id_medico', 'id_utente', 'id_especialidade'], 'integer'],
            [['status'], 'string'],
            [['id_medico'], 'exist', 'skipOnError' => true, 'targetClass' => Medicos::className(), 'targetAttribute' => ['id_medico' => 'id']],
            [['id_utente'], 'exist', 'skipOnError' => true, 'targetClass' => Utente::className(), 'targetAttribute' => ['id_utente' => 'id']],
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
            'id_medico' => 'Id Medico',
            'id_utente' => 'Id Utente',
            'status' => 'Status',
            'id_especialidade' => 'Id Especialidade',
        ];
    }

    /**
     * Gets query for [[Exame]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExames()
    {
        return $this->hasMany(Exame::className(), ['id_marcacao' => 'id']);
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

    /**
     * Gets query for [[Especialidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidade()
    {
        return $this->hasOne(Especialidade::className(), ['id' => 'id_especialidade']);
    }
}
