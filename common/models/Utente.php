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
 * @property int $id_user
 *
 * @property MacacaoExame $macacaoExame
 * @property MarcacaoConsulta $marcacaoConsulta
 * @property ReceitaMedica $receitaMedica
 * @property User $user
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
            [['nome', 'nif', 'sexo', 'telemovel', 'morada', 'email', 'num_sns', 'id_user'], 'required'],
            [['nif', 'telemovel', 'num_sns', 'id_user'], 'integer'],
            [['sexo'], 'string'],
            [['nome', 'morada', 'email'], 'string', 'max' => 255],
            [['id_user'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
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
            'num_sns' => 'Numero de Utente',
            'id_user' => 'Id User',
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }


    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return int
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * @param int $nif
     */
    public function setNif($nif)
    {
        $this->nif = $nif;
    }

    /**
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param string $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return int
     */
    public function getTelemovel()
    {
        return $this->telemovel;
    }

    /**
     * @param int $telemovel
     */
    public function setTelemovel($telemovel)
    {
        $this->telemovel = $telemovel;
    }

    /**
     * @return string
     */
    public function getMorada()
    {
        return $this->morada;
    }

    /**
     * @param string $morada
     */
    public function setMorada($morada)
    {
        $this->morada = $morada;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getNumSns()
    {
        return $this->num_sns;
    }

    /**
     * @param int $num_sns
     */
    public function setNumSns($num_sns)
    {
        $this->num_sns = $num_sns;
    }



}
