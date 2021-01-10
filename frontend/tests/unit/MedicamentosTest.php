<?php namespace frontend\tests;

use common\models\Medicamentos;
use yii\db\StaleObjectException;

class MedicamentosTest extends \Codeception\Test\Unit
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
    public function testMedicamento()
    {
        $medicamentos = new Medicamentos();

        /* ------------ Teste de Validação do Nome ------------ */
        $medicamentos->setNome("Valdispert");
        $this->assertTrue($medicamentos->validate(['nome']));

        $medicamentos->setNome('toooooooooooooloooooooooooooooongnaaaaaaaaaaaameeeeeeeeeeeeee');
        $this->assertFalse($medicamentos->validate(['nome']));

        $medicamentos->setNome(null);
        $this->assertFalse($medicamentos->validate(['nome']));

        /* ------------ Teste de Validação de Miligramas ------------ */
        $medicamentos->setMiligramas(50);
        $this->assertTrue($medicamentos->validate(['miligramas']));

        $medicamentos->setMiligramas('letters');
        $this->assertFalse($medicamentos->validate(['miligramas']));

        $medicamentos->setMiligramas(null);
        $this->assertFalse($medicamentos->validate(['miligramas']));

        /* ------------ Teste de Validação de Descrição ------------ */
        $medicamentos->setDescricao("descricao de teste para validacao");
        $this->assertTrue($medicamentos->validate(['descricao']));

        $medicamentos->setDescricao(500);
        $this->assertFalse($medicamentos->validate(['descricao']));

        $medicamentos->setDescricao(null);
        $this->assertFalse($medicamentos->validate(['descricao']));
    }

    public function testCriarMedicamento(){

        $medicamentos = new Medicamentos();

        $medicamentos->nome = "Medicamento de Teste";
        $medicamentos->miligramas = 15;
        $medicamentos->descricao = "Medicamento exclusivo para testes";

        $medicamentos->save();

        $this->tester->seeInDatabase('medicamentos',['nome' => "Medicamento de Teste", 'miligramas' => 15, 'descricao' => "Medicamento exclusivo para testes"]);

    }


    public function testAlterarMedicamento(){

        $this->tester->updateInDatabase('medicamentos', array('nome' => "Medicamento de Teste", 'miligramas' => 20), array('miligramas' => 15, 'descricao' => "Medicamento exclusivo para testes"));

        $this->tester->seeInDatabase('medicamentos',['nome' => "Medicamento de Teste", 'miligramas' => 20, 'descricao' => "Medicamento exclusivo para testes"]);

    }


    public function testApagarMedicamento(){

        $medicamentos = Medicamentos::find()
            ->where(['nome' => "Medicamento de Teste", 'miligramas' => 20])
            ->one();


        try {
            $medicamentos->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }


        $this->tester->dontSeeInDatabase('medicamentos',['nome' => "Medicamento de Teste", 'miligramas' => 20, 'descricao' => "Medicamento exclusivamente para testes"]);
    }

}