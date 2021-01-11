<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkLogin(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('My Application');

        $I->seeLink('Login');
        $I->click('Login');
        $I->wait(2);

        $I->see('Login');

        $I->fillField('Username', 'RbacTest');
        $I->fillField('Password', '123456789');
        $I->click('login-button');
        $I->wait(2);

        $I->see('Logout (RbacTest)');
    }
}
//para instalar: fazer download de phantomjs por numa directoria no disco C.
//              Propriedades do Sistema - Varaiveis de ambiente - Variaveis de Sistema - Path - Editar - Novo - por a direção para o executavel
//              exemplo de direção: C:\PhantomJs\bin\phantomjs

//para começar o servidor: phantomjs --webdriver=8888 --ssl-protocol=any --ignore-ssl-errors=true
// ..\vendor\bin\codecept run acceptance SignInCest