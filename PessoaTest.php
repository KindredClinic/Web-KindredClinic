<?php namespace frontend\tests;

use app\models\Pessoa;

class PessoaTest extends \Codeception\Test\Unit
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
    public function testPessoa()
    {
/*        $pessoa = new Pessoa();
        $pessoa->setNome('Alex');
        $pessoa->setIdade(21);
        $pessoa->setMorada('Estrada estrada');
        $pessoa->setNif(123456789);
        $pessoa->setEmail('alex@alex.com');*/

        $pessoa = new Pessoa();

        $pessoa->nome = 'Alex';
        $pessoa->idade = 21;
        $pessoa->morada = 'Estrada estrada';
        $pessoa->nif = 123456789;
        $pessoa->email = 'alex@alex.com';
        $pessoa->save();

        $this->tester->seeRecord('app\models\pessoa', ['nome' => 'Alex']);
        $this->tester->seeInDatabase('pessoa', ['nome' => 'Alex']);

        //Ir buscar à DB e alterar o nome
        $pessoa = $this->tester->grabRecord('\app\models\pessoa', ['nome' => 'Alex']);
        $pessoa->setNome('Live');
        $pessoa->save();
        $this->tester->seeRecord('app\models\pessoa',['nome' => 'Live']);

        $pessoa2 = new Pessoa();
        $pessoa2->nome = 'Afonso';
        $pessoa2->idade = 21;
        $pessoa2->morada = 'Estrada estrada';
        $pessoa2->nif = 987654321;
        $pessoa2->email = 'afonso@afonso.com';
        $pessoa2->save();

        //Para Apagar só um registo
        $this->tester->grabRecord('app\models\pessoa', ['nome' => 'Live']) -> delete();
        //Se ainda existir um registo na DB irá dar erro
        $this->tester->dontSeeRecord('app\models\pessoa',['nome' => 'Live']);


    }
}


/*        */