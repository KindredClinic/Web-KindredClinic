<?php

namespace common\models;

use backend\models\MacacaoExame;
use Yii;

/**
 * This is the model class for table "utente".
 *
 * @property int $id
 * @property string $nome
 * @property int $nif
 * @property string $sexo
 * @property int $telemovel
 * @property string $morada
 * @property string $email
 * @property int $num_sns
 *
 * @property MacacaoExame $macacaoExame
 * @property MarcacaoConsulta $marcacaoConsulta
 * @property ReceitaMedica $receitaMedica
 */
class Utente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'nif', 'sexo', 'telemovel', 'morada', 'email', 'num_sns'], 'required'],
            [['nif', 'telemovel', 'num_sns'], 'integer'],
            [['sexo'], 'string'],
            [['nome', 'morada', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'nif' => 'Nif',
            'sexo' => 'Sexo',
            'telemovel' => 'Telemovel',
            'morada' => 'Morada',
            'email' => 'Email',
            'num_sns' => 'Num Sns',
        ];
    }

    /**
     * Gets query for [[MacacaoExame]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMacacaoExame()
    {
        return $this->hasOne(MacacaoExame::className(), ['id_utente' => 'id']);
    }

    /**
     * Gets query for [[MarcacaoConsulta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaoConsulta()
    {
        return $this->hasOne(MarcacaoConsulta::className(), ['id_utente' => 'id']);
    }

    /**
     * Gets query for [[ReceitaMedica]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceitaMedica()
    {
        return $this->hasOne(ReceitaMedica::className(), ['id_utente' => 'id']);
    }
}
