<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;

/**
 * Class LoginCest
 */
class MedicamentosCest
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
    public function insertMedicamentos(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->see('Login', 'h1');

        $I->fillField('Username', 'admin');
        $I->fillField('Password', '123456789');
        $I->click('login-button');

        $I->see('Logout (admin)', 'form button[type=submit]');

        $I->click('Medicamentos');
        $I->click('Create Medicamentos');

        $I->fillField('Nome', 'Medicação Teste');
        $I->fillField('Miligramas', '123');
        $I->fillField('Descricao', 'Teste Teste');

        $I->click('save-button');

        $I->see('Medicação Teste', 'td');
        $I->see('Teste Teste', 'td');
    }
}
