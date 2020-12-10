<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "medicamentos".
 *
 * @property int $id
 * @property string $nome
 * @property float $gramas
 * @property string $laboratorio
 * @property string $modoTomar
 * @property string $descricao
 *
 * @property ReceitaMedica[] $receitaMedicas
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
            [['nome', 'gramas', 'descricao'], 'required'],
            [['gramas'], 'number'],
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
            'gramas' => 'Gramas',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * Gets query for [[ReceitaMedicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceitaMedicas()
    {
        return $this->hasMany(ReceitaMedica::className(), ['id_medicamentos' => 'id']);
    }

    public static function formAddon(){
        $procurar = Medicamentos::find()
            ->all();

        return [$procurar, $procurar];
    }
}
