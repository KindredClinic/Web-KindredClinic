<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "livro".
 *
 * @property int $id
 * @property int $isbm
 * @property string $titulo
 */
class Livro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'livro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isbm', 'titulo'], 'required'],
            [['isbm'], 'integer'],
            [['titulo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'isbm' => 'Isbm',
            'titulo' => 'Titulo',
        ];
    }

    /**
     * @param string $isbm
     */
    public function setIsbm($isbm)
    {
        $this->isbm = $isbm;
    }

    /**
     * @param string $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
}
