<?php namespace frontend\tests;

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
    public function testUtente()
    {
        $utente = new Utente();

        /* ------------ Teste de Validação do Nome ------------ */
        $utente->setNome("Afonso");
        $this->assertTrue($utente->validate(['nome']));

        $utente->setNome('toooooooooooooloooooooooooooooongnaaaaaaaaaaaameeeeeeeeeeeeee');
        $this->assertFalse($utente->validate(['nome']));

        $utente->setNome(null);
        $this->assertFalse($utente->validate(['nome']));

        /* ------------ Teste de Validação do Nif ------------ */
        $utente->setNif(687593134);
        $this->assertTrue($utente->validate(['nif']));

        $utente->setNif('letters');
        $this->assertFalse($utente->validate(['nif']));

        $utente->setNif(null);
        $this->assertFalse($utente->validate(['nif']));

        /* ------------ Teste de Validação do Sexo ------------ */
        $utente->setSexo("Feminino");
        $this->assertTrue($utente->validate(['sexo']));

        $utente->setSexo(1234);
        $this->assertFalse($utente->validate(['sexo']));

        $utente->setSexo(null);
        $this->assertFalse($utente->validate(['sexo']));

        /* ------------ Teste de Validação do Telemovel ------------ */
        $utente->setTelemovel(914021328);
        $this->assertTrue($utente->validate(['telemovel']));

        $utente->setTelemovel('letters');
        $this->assertFalse($utente->validate(['telemovel']));

        $utente->setTelemovel(null);
        $this->assertFalse($utente->validate(['telemovel']));

        /* ------------ Teste de Validação do Morada ------------ */
        $utente->setMorada("Rua UtenteTeste");
        $this->assertTrue($utente->validate(['morada']));

        $utente->setMorada(987654321);
        $this->assertFalse($utente->validate(['morada']));

        $utente->setMorada(null);
        $this->assertFalse($utente->validate(['morada']));

        /* ------------ Teste de Validação do Email ------------ */
        $utente->setEmail("utenteteste@utenteteste.com");
        $this->assertTrue($utente->validate(['email']));

        $utente->setEmail(987654321);
        $this->assertFalse($utente->validate(['email']));

        $utente->setEmail(null);
        $this->assertFalse($utente->validate(['email']));

        /* ------------ Teste de Validação do Numero SNS ------------ */
        $utente->setNumSns(785328925);
        $this->assertTrue($utente->validate(['num_sns']));

        $utente->setNumSns("letters");
        $this->assertFalse($utente->validate(['num_sns']));

        $utente->setNumSns(null);
        $this->assertFalse($utente->validate(['num_sns']));
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

        $this->tester->seeInDatabase('utente',['nome' => "UnitTest", 'nif' => 123456789, 'telemovel' => 923112312, 'morada' => "rua teste unitario", 'sexo' => "Feminino",
            "email" => "unitTest@unitTest.com",'num_sns' => 675785854, 'id_user' => 6]);

    }


    public function testAlterarUtente(){

        $this->tester->updateInDatabase('utente', array('nome' => "TestUnit", 'morada' => "rua teste unitario"), array('nome' => "UnitTest", 'nif' => 123456789));

        $this->tester->seeInDatabase('utente',['nome' => "TestUnit", 'nif' => 123456789, 'telemovel' => 923112312, 'morada' => "rua teste unitario", 'sexo' => "Feminino",
            "email" => "unitTest@unitTest.com",'num_sns' => 675785854, 'id_user' => 6]);

    }


    public function testApagarUtente(){

       $utente = Utente::find()
            ->where(['nome' => "TestUnit", 'morada' => "rua teste unitario"])
            ->one();


        try {
            $utente->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }


        $this->tester->dontSeeInDatabase('utente',['nome' => "TestUnit", 'nif' => 123456789, 'telemovel' => 923112312, 'morada' => "rua teste unitario", 'sexo' => "Feminino",
            "email" => "unitTest@unitTest.com",'num_sns' => 675785854, 'id_user' => 6]);
    }


}