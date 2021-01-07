<?php namespace backend\tests;

use backend\models\Especialidade;

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
    public function testSomeFeature()
    {
        $especialidade = new Especialidade();

        $especialidade->setTipo("Psiquiatria");
        $this->assertTrue($especialidade->validate(['tipo']));

        $especialidade->setTipo('toooooooooooooloooooooooooooooongtiiiiipoooooooo');
        $this->assertFalse($especialidade->validate(['tipo']));

        $especialidade->setTipo(null);
        $this->assertFalse($especialidade->validate(['tipo']));


        $especialidade = new Especialidade();
        $especialidade->setTipo('Doenças Infecciosas');
        $especialidade->save();
        $this->assertEquals('Doenças Infecciosas', $especialidade->getTipo());
        $this->tester->seeInDatabase('especialidades', ['tipo' => 'Doenças Infecciosas']);

    }
}