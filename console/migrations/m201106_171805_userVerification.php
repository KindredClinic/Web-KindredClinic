<?php

use yii\db\Migration;

/**
 * Class m201106_171805_userVerification
 */
class m201106_171805_userVerification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201106_171805_userVerification cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
        $marcarConsulta = $auth->createPermission('marcacao_consulta');
        $marcarConsulta->description = 'Marcar uma consulta';
        $auth->add($marcarConsulta);

        // add "updatePost" permission
        $consulta = $auth->createPermission('consulta');
        $consulta->description = 'Consulta';
        $auth->add($consulta);

        $receitaMedica = $auth->createPermission('receitaMedica');
        $receitaMedica->description = 'Receita Medica';
        $auth->add($receitaMedica);

        $utente = $auth->createRole('utente');
        $auth->add($utente);
        $auth->addChild($utente, $marcarConsulta);
        $auth->addChild($utente, $consulta);
        $auth->addChild($utente, $receitaMedica);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

}

//Web-kindredClinic> php yii migrate/create nome - criar novo ficheiro rbac
// to run: php yii migrate