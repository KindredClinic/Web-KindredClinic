<?php namespace backend\tests;

use backend\models\Especialidade;
use yii\db\StaleObjectException;

class EspecialidadeTest extends \Codeception\Test\Unit
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
    public function testEspecialidade()
    {
        $especialidade = new Especialidade();

        /* ------------ Teste de Validação de Tipo ------------ */
        $especialidade->setTipo("Psiquiatria");
        $this->assertTrue($especialidade->validate(['tipo']));

        $especialidade->setTipo('toooooooooooooloooooooooooooooongtiiiiipoooooooo');
        $this->assertFalse($especialidade->validate(['tipo']));

        $especialidade->setTipo(null);
        $this->assertFalse($especialidade->validate(['tipo']));


    }

    public function testCriaEspecialidade(){

        $especialidade = new Especialidade();

        $especialidade->tipo = "Especialidade de Teste";

        $especialidade->save();

        $this->tester->seeInDatabase('especialidade',['tipo' => "Especialidade de Teste"]);

    }


    public function testAlterarEspecialidade(){

        $this->tester->updateInDatabase('especialidade', array('tipo' => "Teste de Especialidade"), array('tipo' => "Especialidade de Teste"));

        $this->tester->seeInDatabase('especialidade',['tipo' => "Teste de Especialidade"]);

    }


    public function testApagarEspecialidade(){

        $especialidade = Especialidade::find()
            ->where(['tipo' => "Teste de Especialidade"])
            ->one();


        try {
            $especialidade->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }


        $this->tester->dontSeeInDatabase('especialidade',['tipo' => "Teste de Especialidade"]);
    }
}