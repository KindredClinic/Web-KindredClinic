<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "exame".
 *
 * @property int $id
 * @property string $conteudo
 * @property string $date
 * @property int $id_medico
 * @property int $id_marcacao
 *
 * @property MacacaoExame $marcacao
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
            [['id_marcacao'], 'exist', 'skipOnError' => true, 'targetClass' => MacacaoExame::className(), 'targetAttribute' => ['id_marcacao' => 'id']],
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
            'conteudo' => 'Conteudo',
            'date' => 'Date',
            'id_medico' => 'Id Medico',
            'id_marcacao' => 'Id Marcacao',
        ];
    }

    /**
     * Gets query for [[Marcacao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacao()
    {
        return $this->hasOne(MacacaoExame::className(), ['id' => 'id_marcacao']);
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
