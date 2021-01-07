<?php namespace frontend\tests;

use common\models\Medicamentos;

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
    public function testSomeFeature()
    {
        $utente = new Medicamentos();

        $utente->setNome("Valdispert");
        $this->assertTrue($utente->validate(['nome']));

        $utente->setNome('toooooooooooooloooooooooooooooongnaaaaaaaaaaaameeeeeeeeeeeeee');
        $this->assertFalse($utente->validate(['nome']));

        $utente->setNome(null);
        $this->assertFalse($utente->validate(['nome']));


        $utente = new Medicamentos();
        $utente->setNome('Valdispert');
        $utente->save();
        $this->assertEquals('Valdispert', $utente->getNome());
        $this->tester->seeInDatabase('medicamentos', ['nome' => 'Valdispert']);
    }
}