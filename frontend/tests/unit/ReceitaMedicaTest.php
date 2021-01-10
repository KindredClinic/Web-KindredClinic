<?php namespace frontend\tests;

use common\models\ReceitaMedica;
use yii\db\StaleObjectException;

class ReceitaMedicaTest extends \Codeception\Test\Unit
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
    public function testReceitaMedica()
    {
        $receitaMedica = new ReceitaMedica();

        /* ------------ Teste de Validação de Data ------------ */
        $receitaMedica->setDate(date('Y-m-d H:i:s'));
        $this->assertTrue($receitaMedica->validate(['date']));

        /*$receitaMedica->setDate('');
        $this->assertFalse($receitaMedica->validate(['date']));*/

        $receitaMedica->setDate(null);
        $this->assertFalse($receitaMedica->validate(['date']));

        /* ------------ Teste de Validação de Conteudo ------------ */
        $receitaMedica->setConteudo("conteudo de exame para teste");
        $this->assertTrue($receitaMedica->validate(['conteudo']));

        $receitaMedica->setConteudo(54321);
        $this->assertFalse($receitaMedica->validate(['conteudo']));

        $receitaMedica->setConteudo(null);
        $this->assertFalse($receitaMedica->validate(['conteudo']));
    }

    public function testCriaReceitaMedica(){

        $receitaMedica = new ReceitaMedica();

        $receitaMedica->conteudo = "Receita Medica de Teste";
        $receitaMedica->date = date('Y-m-d H:i:s');
        $receitaMedica->id_medicamentos = 3;
        $receitaMedica->id_medico = 14;
        $receitaMedica->id_utente = 4;

        $receitaMedica->save();

        $this->tester->seeInDatabase('receita_medica',['conteudo' => "Receita Medica de Teste", "id_medicamentos" => 3, "id_medico" => 14, "id_utente" => 4]);

    }


   public function testAlterarReceitaMedica(){

        $this->tester->updateInDatabase('receita_medica', array('conteudo' => "Teste de Receita Medica"), array('conteudo' => "Receita Medica de Teste"));

        $this->tester->seeInDatabase('receita_medica',['conteudo' => "Teste de Receita Medica", "id_medicamentos" => 3, "id_medico" => 14, "id_utente" => 4]);

    }


    public function testApagarExame(){

        $receitaMedica = ReceitaMedica::find()
            ->where(['conteudo' => "Teste de Receita Medica"])
            ->one();


        try {
            $receitaMedica->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }


        $this->tester->dontSeeInDatabase('receita_medica',['conteudo' => "Teste de Receita Medica", "id_medicamentos" => 3, "id_medico" => 14, "id_utente" => 4]);
    }
}