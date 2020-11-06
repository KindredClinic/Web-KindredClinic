<?php

namespace backend\models;

use common\models\MarcacaoConsulta;
use Yii;

/**
 * This is the model class for table "especialidade".
 *
 * @property int $id
 * @property string $tipo
 *
 * @property MacacaoExame $macacaoExame
 * @property MarcacaoConsulta $marcacaoConsulta
 * @property Medicos[] $medicos
 */
class Especialidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'especialidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * Gets query for [[MacacaoExame]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMacacaoExame()
    {
        return $this->hasOne(MacacaoExame::className(), ['id_especialidade' => 'id']);
    }

    /**
     * Gets query for [[MarcacaoConsulta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaoConsulta()
    {
        return $this->hasOne(MarcacaoConsulta::className(), ['id_especialidade' => 'id']);
    }

    /**
     * Gets query for [[Medicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicos()
    {
        return $this->hasMany(Medicos::className(), ['id_especialidade' => 'id']);
    }
}
