<?php

namespace backend\models;

use common\models\Consulta;
use common\models\MarcacaoConsulta;
use common\models\MarcacaoExame;
use common\models\ReceitaMedica;
use common\models\User;
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
 * @property int $id_user
 *
 * @property Consulta $consulta
 * @property Exame $exame
 * @property MarcacaoExame $macacaoExame
 * @property MarcacaoConsulta $marcacaoConsulta
 * @property Especialidade $especialidade
 */
class Medicos extends \yii\db\ActiveRecord
{
    public $username;
    public $email;
    public $password;

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
            [['nome', 'sexo', 'nif', 'telefone', 'num_ordem_medico', 'id_especialidade', 'id_user'], 'required'],
            [['sexo'], 'string'],
            [['nif', 'telefone', 'num_ordem_medico', 'id_especialidade', 'id_user'], 'integer'],
            [['nome', 'email'], 'string', 'max' => 255],
            [['id_especialidade'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidade::className(), 'targetAttribute' => ['id_especialidade' => 'id']],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
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
            'id_especialidade' => 'Especialidade',
            'id_user' => 'User',
        ];
    }

    /**
     * Gets query for [[Consulta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consulta::className(), ['id_medico' => 'id']);
    }

    /**
     * Gets query for [[Exame]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExames()
    {
        return $this->hasMany(Exame::className(), ['id_medico' => 'id']);
    }

    /**
     * Gets query for [[MacacaoExame]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMacacaoExames()
    {
        return $this->hasMany(MarcacaoExame::className(), ['id_medico' => 'id']);
    }

    /**
     * Gets query for [[MarcacaoConsulta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaoConsultas()
    {
        return $this->hasMany(MarcacaoConsulta::className(), ['id_medico' => 'id']);
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

    public static function dataByUser($idUser){

        $procurar = self::find()
            ->where(['id_user' =>  $idUser ])
            ->one();

        return $procurar;
    }

    public function criarMedico(){

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = 9;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();

        $model = new Medicos();
        $model->nome = $this->nome;
        $model->sexo = $this->sexo;
        $model->nif = $this->nif;
        $model->telefone = $this->telefone;
        $model->num_ordem_medico = $this->num_ordem_medico;
        $model->id_especialidade = $this->id_especialidade;
        $model->email = $this->email;
        $model->id_user = $user->getId();
        $model->save(false);

        //rbac
        $auth = \Yii::$app->authManager;
        $temp = $auth->getRole('medico');
        $auth->assign($temp, $user->getId());

        return $this->sendEmail($user);

    }

    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Conta Registada em ' . Yii::$app->name)
            ->send();
    }

    public static function dropdown(){

        static $dropdown;

        if($dropdown == null){
            $models = Medicos::find()->all();
            foreach ($models as $model){
                $dropdown[$model->id] = $model->nome;
            }
        }

        return $dropdown;
    }
}
