<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class CriarMarcacaoConsultaCest
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
    public function criarMarcacaoConsulta(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->see('Login', 'h1');

        $I->fillField('Username', 'TestTester');
        $I->fillField('Password', '123456789');
        $I->click('login-button');

        $I->see('Logout (TestTester)', 'form button[type=submit]');

        $I->click('Consulta');
        $I->click('Criar Consulta');

        $I->fillField('input[id="marcacaoconsulta-date"]',"2020-01-21 15:50:25");

        $opcao = $I->grabTextFrom('select#marcacaoconsulta-id_utente option:nth-child(1)');
        $I->selectOption("Utente", $opcao);

        $I->click('save-button');

        $I->see('Marcação de Consultas', 'h1');
    }
}
