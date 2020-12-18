<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "medicamentos".
 *
 * @property int $id
 * @property string $nome
 * @property float $miligramas
 * @property string $designacao
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
            [['nome', 'miligramas', 'designacao'], 'required'],
            [['miligramas'], 'number'],
            [['nome'], 'string', 'max' => 80],
            [['designacao'], 'string', 'max' => 250],
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
            'designacao' => 'Designacao',
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
}
