<?php

namespace common\models;

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
 * @property MarcacaoExame $marcacaoExame
 * @property MarcacaoConsulta $marcacaoConsulta
 * @property ReceitaMedica $receitaMedica
 * @property User $user
 */
class Utente extends \yii\db\ActiveRecord
{
    public $username;
//    public $email;
    public $password;
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
            [['email'], 'string', 'max' => 255],
            [['morada'], 'string', 'max' => 255],
            [['nome'], 'string', 'max' => 25],

            ['username', 'trim'],
           // ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

           // ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    public function fields()
    {
        return ['Numero de Utente'=>'Num Sns'];
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

    public static function formAddon(){
        $procurar = Utente::find()
            ->asArray()
            ->all();

        return $procurar;
    }

    public static function dataByUser($idUser){

        $procurar = self::find()
            ->where(['id_user' =>  $idUser ])
            ->one();

        return $procurar;
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


    public function criarUtente()
    {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = 9;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->save();

            $utente = new Utente();
            $utente->nome = $this->nome;
            $utente->nif = $this->nif;
            $utente->sexo = $this->sexo;
            $utente->telemovel = $this->telemovel;
            $utente->morada = $this->morada;
            $utente->email = $user->email;
            $utente->num_sns = $this->num_sns;
            $utente->id_user = $user->getId();
            $utente->save(false);

            //rbac
            $auth = \Yii::$app->authManager;
            $temp = $auth->getRole('utente');
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

    /**
     * Gets query for [[MacacaoExame]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMacacaoExame()
    {
        return $this->hasOne(MarcacaoExame::className(), ['id_utente' => 'id']);
    }

    /**
     * Gets query for [[MarcacaoConsulta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarcacaoConsultas()
    {
        return $this->hasMany(MarcacaoConsulta::className(), ['id_utente' => 'id']);
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
