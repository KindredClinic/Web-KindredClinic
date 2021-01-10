<?php namespace frontend\tests;

use common\models\User;
use common\models\Utente;
use yii\db\StaleObjectException;

class UtenteTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
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
        /*$utente = new Utente();

        $utente->nome = 'UnitTest';
        $utente->nif = '123456789';
        $utente->sexo = 'Feminino';
        $utente->telemovel = '923112312';
        $utente->morada = 'rua teste unitario';
        $utente->email = 'unitTest@unitTest.com';
        $utente->num_sns = '675785854';
        $utente->save();

        $this->tester->seeInDatabase('utente', ['nome' => 'UnitTest']);

        $this->tester->grabFromDatabase('utente', 'nome', array('nome' => 'UnitTest'));
        $this->tester->updateInDatabase('utente', array('nome' => 'TestUnit'));

        $this->tester->seeInDatabase('utente', ['nome' => 'TestUnit']);*/


        /* $utente->setSexo("Masculino");
         $this->assertTrue($utente->validate(['sexo']));

         $utente->setSexo(null);
         $this->assertFalse($utente->validate(['sexo']));


         $utente = new Utente();
         $utente->setSexo('Masculino');
         $utente->save();
         $this->assertEquals('Masculino', $utente->getSexo());
         $this->tester->seeInDatabase('utentes', ['sexo' => 'Masculino']);*/

        $user = new User();

        $user->id = 9999;
        $user->username = "UnitTest";
        $user->auth_key = "s01hgJ_PUVSFKdNA_8wkT-alJ9h6txog"; //copiado do  User:Alex
        $user->password_hash = "$2y$13$9P/01WEJSEBTw0QVIQLxxegBWvWo17KAoE2YWaaDH85h513RC/azm";
        $user->password_reset_token = null;
        $user->email = "unitTest@unitTest.com";
        $user->status = 10;
        $user->created_at = 1606318089;
        $user->updated_at = 1606318089;
        $user->verification_token = "xGg1vt9m0adP8_kPgqfVWQW4L20eyB_R_1606318089";

        $user->save(true);

        $this->tester->seeRecord('common\models\user', ['username' => 'UnitTest']);
        $this->tester->seeInDatabase('user',['username' => "UnitTest"]);

    }

    public function testCriarUtente(){

        $utente = new Utente();

        $utente->id = 9999;
        $utente->nome = "UnitTest";
        $utente->nif = 123456789;
        $utente->sexo = "Feminino";
        $utente->telemovel = 923112312;
        $utente->morada = "rua teste unitario";
        $utente->email = "unitTest@unitTest.com";
        $utente->num_sns = 675785854;
        $utente->id_user = 9999;

        $utente->save(true);

        $this->tester->seeRecord('common\models\utente', ['nome' => 'UnitTest']);
        $this->tester->seeInDatabase('utente',['nome' => "UnitTest"]);

    }


    public function testAlterarUtente(){

        $this->tester->updateInDatabase('utente', array('nome' => "TestUnit", 'morada' => "rua teste unitario"), array('nome' => "UnitTest", 'nif' => 123456789));

        $this->tester->seeInDatabase('utente',['nome' => "TestUnit", 'nif' => 123456789, 'telemovel' => 923112312, 'morada' => "rua teste unitario", 'sexo' => "Feminino", "email" => "unitTest@unitTest.com",'num_sns' => 675785854, 'id_user' => 9999]);
    }


    public function testApagarUtente()
    {
        $utente = Utente::find()
            ->where(['nome' => "TestUnit", 'morada' => "rua teste unitario"])
            ->one();

        try {
            $utente->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }

        $this->tester->dontSeeInDatabase('utente',['nome' => "TestUnit", 'nif' => 123456789, 'telemovel' => 923112312, 'morada' => "rua teste unitario", 'sexo' => "Feminino", "email" => "unitTest@unitTest.com",'num_sns' => 675785854, 'id_user' => 25]);

    }

}