<?php namespace frontend\tests;

use common\models\Utente;

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
    public function testUtente()
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
    }

    public function testCriarUtente(){

        $utente = new Utente();

        $utente->nome = "UnitTest";
        $utente->nif = 123456789;
        $utente->sexo = "Feminino";
        $utente->telemovel = 923112312;
        $utente->morada = "rua teste unitario";
        $utente->email = "unitTest@unitTest.com";
        $utente->num_sns = 675785854;
        $utente->id_user = 6;

        $utente->save();

        $this->tester->seeInDatabase('utente',['nome' => "UnitTest", 'nif' => 123456789, 'telemovel' => 923112312, 'morada' => "rua teste unitario", 'sexo' => "Feminino", "email" => "unitTest@unitTest.com",'num_sns' => 675785854, 'id_user' => 25]);

    }


    public function testAlterarUtente(){

        $this->tester->updateInDatabase('utente', array('nome' => "TestUnit", 'morada' => "rua teste unitario"), array('nome' => "UnitTest", 'nif' => 123456789));

        $this->tester->seeInDatabase('utente',['nome' => "TestUnit", 'nif' => 123456789, 'telemovel' => 923112312, 'morada' => "rua teste unitario", 'sexo' => "Feminino", "email" => "unitTest@unitTest.com",'num_sns' => 675785854, 'id_user' => 25]);

    }


    public function testApagarUtente(){

       $utente = Utente::find()
            ->where(['nome' => "TestUnit", 'morada' => "rua teste unitario"])
            ->one();

        $utente->delete();

        $this->tester->dontSeeInDatabase('utente',['nome' => "TestUnit", 'nif' => 123456789, 'telemovel' => 923112312, 'morada' => "rua teste unitario", 'sexo' => "Feminino", "email" => "unitTest@unitTest.com",'num_sns' => 675785854, 'id_user' => 25]);
    }


}