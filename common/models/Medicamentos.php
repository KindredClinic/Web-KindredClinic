<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "medicamentos".
 *
 * @property int $id
 * @property string $nome
 * @property float $miligramas
 * @property string $descricao
 */
class Medicamentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medicamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'miligramas', 'descricao'], 'required'],
            [['miligramas'], 'number'],
            [['nome'], 'string', 'max' => 80],
            [['descricao'], 'string', 'max' => 250],
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
            'miligramas' => 'Miligramas',
            'descricao' => 'Descricao',
        ];
    }

    public static function dropdown(){

        static $dropdown;

        if($dropdown == null){
            $models = self::find()->all();
            foreach ($models as $model){
                $dropdown[$model->id] = $model->nome;
            }
        }

        return $dropdown;
    }

    public static function formAddon()
    {
        $procurar = Medicamentos::find()
            ->asArray()
            ->all();

        return $procurar;
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
}
