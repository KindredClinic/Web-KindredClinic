<?php

namespace backend\models;

use common\models\Consulta;
use common\models\MarcacaoConsulta;
use common\models\ReceitaMedica;
use Yii;

/**
 * This is the model class for table "medicos".
 *
 * @property int $id
 * @property string $nome
 * @property string $sexo
 * @property int $nif
 * @property int $telefone
 * @property string $email
 * @property int $num_ordem_medico
 * @property int $id_especialidade
 *
 * @property Consulta $consulta
 * @property Exame $exame
 * @property MacacaoExame $macacaoExame
 * @property MarcacaoConsulta $marcacaoConsulta
 * @property Especialidade $especialidade
 * @property ReceitaMedica $receitaMedica
 */
class Medicos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'sexo', 'nif', 'telefone', 'email', 'num_ordem_medico', 'id_especialidade'], 'required'],
            [['sexo'], 'string'],
            [['nif', 'telefone', 'num_ordem_medico', 'id_especialidade'], 'integer'],
            [['nome', 'email'], 'string', 'max' => 255],
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
            'nome' => 'Nome',
            'sexo' => 'Sexo',
            'nif' => 'Nif',
            'telefone' => 'Telefone',
            'email' => 'Email',
            'num_ordem_medico' => 'Num Ordem Medico',
            'id_especialidade' => 'Id Especialidade',
        ];
    }

    /**
     * Gets query for [[Consulta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsulta()
    {
        return $this->hasOne(Consulta::className(), ['id_medico' => 'id']);
    }

    /**
     * Gets query for [[Exame]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExame()
    {
        return $this->hasOne(Exame::className(), ['id_medico' => 'id']);
    }

    /**
     * Gets query for [[MacacaoExame]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMacacaoExame()
    {
        return $this->hasOne(MacacaoExame::className(), ['id_medico' => 'id']);
    }

    /**
     * Gets query for [[MarcacaoConsulta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaoConsulta()
    {
        return $this->hasOne(MarcacaoConsulta::className(), ['id_medico' => 'id']);
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

    /**
     * Gets query for [[ReceitaMedica]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceitaMedica()
    {
        return $this->hasOne(ReceitaMedica::className(), ['id_medico' => 'id']);
    }
}
