<?php
namespace frontend\models;

use common\models\Utente;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\rbac\DbManager;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $nome;
    public $nif;
    public $sexo;
    public $telemovel;
    public $morada;
    public $num_sns;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'nif', 'sexo', 'telemovel', 'morada', 'email', 'num_sns'], 'required'],
            [['nif', 'telemovel', 'num_sns'], 'integer'],
            [['sexo'], 'string'],
            [['nome', 'morada', 'email'], 'string', 'max' => 255],

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
    public function attributeLabels()
    {
        return [
            'num_sns' => 'Numero de Utente',
        ];
    }


    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if ($this->validate()) {

            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = 9;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->save(false);

            $utente = new Utente();
            $utente->nome = $this->nome;
            $utente->nif = $this->nif;
            $utente->telemovel = $this->telemovel;
            $utente->morada = $this->morada;
            $utente->email = $this->email;
            $utente->num_sns = $this->num_sns;
            $utente->id_user = $user->getId();
            $utente->save(false);

            //rbac
            $auth = new DbManager();
            $temp = $auth->getRole('utente');
            $auth->assign($temp, $user->getId());

            return $this->sendEmail($user);

        }else{
            return null;
        }

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
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
}
