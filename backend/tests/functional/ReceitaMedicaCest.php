<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class ReceitaMedicaCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
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
    public function criarReceita(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->see('Login', 'h1');

        $I->fillField('Username', 'TestTester');
        $I->fillField('Password', '123456789');
        $I->click('login-button');

        $I->see('Logout (TestTester)', 'form button[type=submit]');

        $I->click('Receita');
        $I->click('Criar Receita Medica');

        $opcao = $I->grabTextFrom('select#receitamedica-id_utente option:nth-child(2)');
        $I->selectOption("Utente", $opcao);

        $opcao2 = $I->grabTextFrom('select#receitamedica-id_medicamentos option:nth-child(2)');
        $I->selectOption("ReceitaMedica[id_medicamentos]", $opcao2);

        $I->fillField('Conteudo', 'Teste Teste');

        $I->click('save-button');

        $I->see('TestTester2', 'td');
    }
}
