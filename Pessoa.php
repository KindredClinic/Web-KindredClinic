<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pessoa".
 *
 * @property int $id
 * @property string $nome
 * @property int $idade
 * @property string $morada
 * @property int $nif
 * @property string $email
 */
class Pessoa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'idade', 'morada', 'nif', 'email'], 'required'],
            [['idade', 'nif'], 'integer'],
            [['nome', 'morada'], 'string', 'max' => 80],
            [['email'], 'string', 'max' => 80],
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
            'idade' => 'Idade',
            'morada' => 'Morada',
            'nif' => 'Nif',
            'email' => 'Email',
        ];
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param int $idade
     */
    public function setIdade($idade)
    {
        $this->idade = $idade;
    }

    /**
     * @param string $morada
     */
    public function setMorada($morada)
    {
        $this->morada = $morada;
    }

    /**
     * @param int $nif
     */
    public function setNif($nif)
    {
        $this->nif = $nif;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }




}
