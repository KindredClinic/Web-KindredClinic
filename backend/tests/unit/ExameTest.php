<?php namespace backend\tests;

use backend\models\Exame;
use yii\db\StaleObjectException;

class ExameTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testExame()
    {
        $exame = new Exame();

        /* ------------ Teste de Validação do Conteudo ------------ */
        $exame->setConteudo("conteudo de exame para teste");
        $this->assertTrue($exame->validate(['conteudo']));

        $exame->setConteudo(54321);
        $this->assertFalse($exame->validate(['conteudo']));

        $exame->setConteudo(null);
        $this->assertFalse($exame->validate(['conteudo']));

        /* ------------ Teste de Validação de Data ------------ */
        $exame->setDate(date('Y-m-d H:i:s'));
        $this->assertTrue($exame->validate(['date']));

        /*$exame->setDate('');
        $this->assertFalse($exame->validate(['date']));*/

        $exame->setDate(null);
        $this->assertFalse($exame->validate(['date']));


    }

    public function testCriaExame(){

        $exame = new Exame();

        $exame->conteudo = "Exame de Teste";
        $exame->date = date('Y-m-d H:i:s');
        $exame->id_marcacao = 3;
        $exame->id_medico = 14;
        $exame->id_utente = 4;

        $exame->save();

        $this->tester->seeInDatabase('exame',['conteudo' => "Exame de Teste", "id_marcacao" => 3, "id_medico" => 14, "id_utente" => 4]);

    }


    public function testAlterarExame(){

        $this->tester->updateInDatabase('exame', array('conteudo' => "Teste de Exane"), array('conteudo' => "Exame de Teste"));

        $this->tester->seeInDatabase('exame',['conteudo' => "Teste de Exane", "id_marcacao" => 3, "id_medico" => 14, "id_utente" => 4]);

    }


   public function testApagarExame(){

       $exame = Exame::find()
            ->where(['conteudo' => "Teste de Exane"])
            ->one();


       try {
           $exame->delete();
       } catch (StaleObjectException $e) {
       } catch (\Throwable $e) {
       }


       $this->tester->dontSeeInDatabase('exame',['conteudo' => "Teste de Exane", "id_marcacao" => 3, "id_medico" => 14, "id_utente" => 4]);
    }

}