<?php

namespace common\models;

use backend\models\Especialidade;
use backend\models\Exame;
use backend\models\Medicos;
use Yii;

/**
 * This is the model class for table "macacao_exame".
 *
 * @property int $id
 * @property string $date
 * @property int $id_medico
 * @property int $id_utente
 * @property int $id_especialidade
 *
 * @property Exame[] $exames
 * @property Medicos $medico
 * @property Utente $utente
 * @property Especialidade $especialidade
 */
class MarcacaoExame extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'macacao_exame';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'id_medico', 'id_utente', 'id_especialidade'], 'required'],
            [['date'], 'safe'],
            [['id_medico', 'id_utente', 'id_especialidade'], 'integer'],
            [['id_medico'], 'exist', 'skipOnError' => true, 'targetClass' => Medicos::className(), 'targetAttribute' => ['id_medico' => 'id']],
            [['id_utente'], 'exist', 'skipOnError' => true, 'targetClass' => Utente::className(), 'targetAttribute' => ['id_utente' => 'id']],
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
            'date' => 'Date',
            'id_medico' => 'Id Medico',
            'id_utente' => 'Id Utente',
            'id_especialidade' => 'Id Especialidade',
        ];
    }

    /**
     * Gets query for [[Exames]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExames()
    {
        return $this->hasMany(Exame::className(), ['id_marcacao' => 'id']);
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

    /**
     * Gets query for [[Utente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtente()
    {
        return $this->hasOne(Utente::className(), ['id' => 'id_utente']);
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

    public function criarMarcacaoExame(){

        $model = new MarcacaoExame();
        $model->date = $this->date;
        $model->id_especialidade = $this->id_especialidade;
        $model->id_medico = $this->id_medico;
        $model->id_utente = Yii::$app->user->id;

        $model->save();
    }

    public static function getSubDropDownList($especialidade){

        $procurar = Medicos::find()
            ->select(['id as id', 'nome as name'])
            ->where(['id_especialidade' => $especialidade])
            ->asArray()
            ->all();


        return $procurar;
    }

    public static function dataByUser($idUtente){

        $procurar = self::find()
            ->where(['id_utente' =>  $idUtente ])
            ->all();

        return $procurar;
    }

}
