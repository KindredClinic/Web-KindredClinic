<?php namespace common\tests;

use common\models\Medicamentos;
use common\models\User;
use common\models\Utente;
use yii\db\StaleObjectException;

class InsertAllTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testUser()
    {
        $user = new User();

        $user->username = "TestTester2";
        $user->auth_key = "s01hgJ_PUVSFKdNA_8wkT-alJ9h6txog"; //copiado do  User:Alex
        $user->password_hash = "$2y$13$9P/01WEJSEBTw0QVIQLxxegBWvWo17KAoE2YWaaDH85h513RC/azm";
        $user->password_reset_token = null;
        $user->email = "TestTester2@unitTest.com";
        $user->status = 10;
        $user->created_at = 1606318089;
        $user->updated_at = 1606318089;
        $user->verification_token = "xGg1vt9m0adP8_kPgqfVWQW4L20eyB_R_1606318089";

        $user->save(true);

        $this->tester->seeRecord('common\models\user', ['username' => 'TestTester2']);
        $this->tester->seeInDatabase('user', ['username' => "TestTester2"]);


    }

    public function testCriarUtente(){

        $utente = new Utente();

        $utente->nome = "TestTester2";
        $utente->nif = 123456789;
        $utente->sexo = "Feminino";
        $utente->telemovel = 923112312;
        $utente->morada = "rua teste unitario";
        $utente->email = "TestTester2@unitTest.com";
        $utente->num_sns = 675785854;
        $utente->id_user = 1;

        $utente->save(true);

        $this->tester->seeRecord('common\models\utente', ['nome' => 'TestTester2']);
        $this->tester->seeInDatabase('utente',['nome' => "TestTester2"]);

    }

}