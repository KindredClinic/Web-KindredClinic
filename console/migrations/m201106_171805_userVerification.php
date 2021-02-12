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

        //<------------ Perfil -------------------->

        $perfil = $auth->createPermission('Perfil');
        $perfil->description = 'Perfil';
        $auth->add($perfil);

        //<------------ Medicos -------------------->

        $verMedico = $auth->createPermission('verMedico');
        $verMedico->description = 'Ver Medico';
        $auth->add($verMedico);

        $criarMedico = $auth->createPermission('criarMedico');
        $criarMedico->description = 'Criar Medico';
        $auth->add($criarMedico);

        $updateMedico = $auth->createPermission('updateMedico');
        $updateMedico->description = 'Atualizar Medico';
        $auth->add($updateMedico);

        $deleteMedico = $auth->createPermission('deleteMedico');
        $deleteMedico->description = 'Apagar Medico';
        $auth->add($deleteMedico);

        //<------------ User -------------------->

        $verUser = $auth->createPermission('verUser');
        $verUser->description = 'Ver User';
        $auth->add($verUser);

        $criarUser = $auth->createPermission('criarUser');
        $criarUser->description = 'Criar User';
        $auth->add($criarUser);

        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Atualizar User';
        $auth->add($updateUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Apagar User';
        $auth->add($deleteUser);

        //<------------ Medicamentos -------------------->

        $verMedicamentos = $auth->createPermission('verMedicamentos');
        $verMedicamentos->description = 'Ver Medicamentos';
        $auth->add($verMedicamentos);

        $criarMedicamento = $auth->createPermission('criarMedicamento');
        $criarMedicamento->description = 'Criar Medicamento';
        $auth->add($criarMedicamento);

        $updateMedicamento = $auth->createPermission('updateMedicamento');
        $updateMedicamento->description = 'Atualizar Medicamento';
        $auth->add($updateMedicamento);

        $deleteMedicamento = $auth->createPermission('deleteMedicamento');
        $deleteMedicamento->description = 'Apagar Medicamento';
        $auth->add($deleteMedicamento);

        //<------------ Receita Medica -------------------->

        $verReceitaMedica = $auth->createPermission('verReceitaMedica');
        $verReceitaMedica->description = 'Ver Receita Medica';
        $auth->add($verReceitaMedica);

        $criarReceitaMedica = $auth->createPermission('criarReceitaMedica');
        $criarReceitaMedica->description = 'Criar Receita Medica';
        $auth->add($criarReceitaMedica);

        $deleteReceitaMedica = $auth->createPermission('deleteReceitaMedica');
        $deleteReceitaMedica->description = 'Apagar Receita Medica';
        $auth->add($deleteReceitaMedica);

        //<------------Criar Marcacao Exame -------------------->

        $verMarcacaoExame = $auth->createPermission('verMarcacaoExame');
        $verMarcacaoExame->description = 'Ver Marcacao Exame';
        $auth->add($verMarcacaoExame);

        $criarMarcacaoExame = $auth->createPermission('criarMarcacaoExame');
        $criarMarcacaoExame->description = 'Criar uma marcacao Exame';
        $auth->add($criarMarcacaoExame);

        $alterarMarcacaoExame = $auth->createPermission('alterarMarcacaoExame');
        $alterarMarcacaoExame->description = 'Alterar um exame';
        $auth->add($alterarMarcacaoExame);

        //<------------Criar Exame -------------------->

        $verExame = $auth->createPermission('verExame');
        $verExame->description = 'Ver Exame';
        $auth->add($verExame);

        $criarExame = $auth->createPermission('criarExame');
        $criarExame->description = 'Criar Exame';
        $auth->add($criarExame);

        //<------------ Criar Marcacao Consulta -------------------->

        $verMarcacaoConsulta = $auth->createPermission('verMarcacaoConsulta');
        $verMarcacaoConsulta->description = 'Ver Marcacao Consulta';
        $auth->add($verMarcacaoConsulta);

        $criarMarcacaoConsulta = $auth->createPermission('criarMarcacaoConsulta');
        $criarMarcacaoConsulta->description = 'Marcar uma consulta';
        $auth->add($criarMarcacaoConsulta);

        $alterarMarcacaoConsulta = $auth->createPermission('alterarMarcacaoConsulta');
        $alterarMarcacaoConsulta->description = 'Alterar uma consulta';
        $auth->add($alterarMarcacaoConsulta);

        //<------------ Criar Consulta -------------------->

        $verConsulta = $auth->createPermission('verConsulta');
        $verConsulta->description = 'Ver Consulta';
        $auth->add($verConsulta);

        $criarConsulta = $auth->createPermission('criarConsulta');
        $criarConsulta->description = 'Criar Consulta';
        $auth->add($criarConsulta);

        // <---------------------------- ROLES ---------------------------->

        $utente = $auth->createRole('utente');
        $auth->add($utente);
        $auth->addChild($utente, $perfil);
        $auth->addChild($utente, $verReceitaMedica);
        $auth->addChild($utente, $verMarcacaoExame);
        $auth->addChild($utente, $verExame);
        $auth->addChild($utente, $verMarcacaoConsulta);
        $auth->addChild($utente, $criarMarcacaoConsulta);
        $auth->addChild($utente, $verConsulta);

        $medico = $auth->createRole('medico');
        $auth->add($medico);
        $auth->addChild($medico, $criarMedico);
        $auth->addChild($medico, $updateMedico);
        $auth->addChild($medico, $deleteMedico);

        $auth->addChild($medico, $verReceitaMedica);
        $auth->addChild($medico, $criarReceitaMedica);
        $auth->addChild($medico, $deleteReceitaMedica);

        $auth->addChild($medico, $verMarcacaoExame);
        $auth->addChild($medico, $criarMarcacaoExame);
        $auth->addChild($medico, $alterarMarcacaoExame);

        $auth->addChild($medico, $verExame);
        $auth->addChild($medico, $criarExame);

        $auth->addChild($medico, $verMarcacaoConsulta);
        $auth->addChild($medico, $criarMarcacaoConsulta);
        $auth->addChild($medico, $alterarMarcacaoConsulta);

        $auth->addChild($medico, $verConsulta);
        $auth->addChild($medico, $criarConsulta);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $verMedico);
        $auth->addChild($admin, $criarMedico);
        $auth->addChild($admin, $updateMedico);
        $auth->addChild($admin, $deleteMedico);
        $auth->addChild($admin, $verUser);
        $auth->addChild($admin, $criarUser);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $deleteUser);
        $auth->addChild($admin, $verMedicamentos);
        $auth->addChild($admin, $criarMedicamento);
        $auth->addChild($admin, $updateMedicamento);
        $auth->addChild($admin, $deleteMedicamento);
        $auth->addChild($admin, $utente);
        $auth->addChild($admin, $medico);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

}

//Web-kindredClinic> php yii migrate/create nome - criar novo ficheiro rbac
// to run: php yii migrate