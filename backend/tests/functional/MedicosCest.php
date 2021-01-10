<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;

/**
 * Class LoginCest
 */
class MedicosCest
{

    public function _fixtures()
    {
        /*
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];*/
    }
    
    /**
     * @param FunctionalTester $I
     */
    public function insertMedicos(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->see('Login', 'h1');

        $I->fillField('Username', 'UnitTest');
        $I->fillField('Password', '123456789');
        $I->click('login-button');

        $I->see('Logout (UnitTest)', 'form button[type=submit]');

        $I->click('Medicos');
        $I->click('Inserir Medico');

        $I->fillField('Nome', 'Medico_Teste');

        $opcao = $I->grabTextFrom('select#medicos-sexo option:nth-child(2)');
        $I->selectOption("Sexo", $opcao);

        $I->fillField('Nif', 286431578);
        $I->fillField('Telefone', 965324288);
        $I->fillField('Num Ordem Medico', 654328);

        $opcao = $I->grabTextFrom('select#medicos-id_especialidade option:nth-child(2)');
        $I->selectOption("Especialidade", $opcao);

        $I->fillField('Username', 'Medico_Teste');
        $I->fillField('Email', 'MedicoTeste@gmail.com');
        $I->fillField('Password', '123456789');

        $I->click('save-button');

        $I->see('Medico_Teste', 'td');
        $I->see('286431578', 'td');
    }
}
