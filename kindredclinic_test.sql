-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 11, 2021 at 12:28 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kindredclinic_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '37', 1610305313),
('medico', '26', 1610305313),
('medico', '36', 1610313985),
('utente', '25', 1610305313),
('utente', '35', 1610306989);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1610305313, 1610305313),
('alterarMarcacaoConsulta', 2, 'Alterar uma consulta', NULL, NULL, 1606318089, 1610305313),
('alterarMarcacaoExame', 2, 'Alterar um exame', NULL, NULL, 1610305313, 1610305313),
('criarConsulta', 2, 'Criar Consulta', NULL, NULL, 1610305313, 1610305313),
('criarExame', 2, 'Criar Exame', NULL, NULL, 1610305313, 1610305313),
('criarMarcacaoConsulta', 2, 'Marcar uma consulta', NULL, NULL, 1610305313, 1610305313),
('criarMarcacaoExame', 2, 'Criar uma marcacao Exame', NULL, NULL, 1610305313, 1610305313),
('criarMedicamento', 2, 'Criar Medicamento', NULL, NULL, 1610305313, 1610305313),
('criarMedico', 2, 'Criar Medico', NULL, NULL, 1610305313, 1610305313),
('criarReceitaMedica', 2, 'Criar Receita Medica', NULL, NULL, 1610305313, 1610305313),
('criarUser', 2, 'Criar User', NULL, NULL, 1610305313, 1610305313),
('deleteMedicamento', 2, 'Apagar Medicamento', NULL, NULL, 1610305313, 1610305313),
('deleteMedico', 2, 'Apagar Medico', NULL, NULL, 1610305313, 1610305313),
('deleteReceitaMedica', 2, 'Apagar Receita Medica', NULL, NULL, 1610305313, 1610305313),
('deleteUser', 2, 'Apagar User', NULL, NULL, 1610305313, 1610305313),
('medico', 1, NULL, NULL, NULL, 1610305313, 1610305313),
('Perfil', 2, 'Perfil', NULL, NULL, 1610305313, 1610305313),
('updateMedicamento', 2, 'Atualizar Medicamento', NULL, NULL, 1610305313, 1610305313),
('updateMedico', 2, 'Atualizar Medico', NULL, NULL, 1610305313, 1610305313),
('updateUser', 2, 'Atualizar User', NULL, NULL, 1610305313, 1610305313),
('utente', 1, NULL, NULL, NULL, 1610305313, 1610305313),
('verConsulta', 2, 'Ver Consulta', NULL, NULL, 1610305313, 1610305313),
('verExame', 2, 'Ver Exame', NULL, NULL, 1610305313, 1610305313),
('verMarcacaoConsulta', 2, 'Ver Marcacao Consulta', NULL, NULL, 1610305313, 1610305313),
('verMarcacaoExame', 2, 'Ver Marcacao Exame', NULL, NULL, 1610305313, 1610305313),
('verMedicamentos', 2, 'Ver Medicamentos', NULL, NULL, 1610305313, 1610305313),
('verMedico', 2, 'Ver Medico', NULL, NULL, 1610305313, 1610305313),
('verReceitaMedica', 2, 'Ver Receita Medica', NULL, NULL, 1610305313, 1610305313),
('verUser', 2, 'Ver User', NULL, NULL, 1610305313, 1610305313);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('medico', 'alterarMarcacaoConsulta'),
('medico', 'alterarMarcacaoExame'),
('medico', 'criarConsulta'),
('medico', 'criarExame'),
('medico', 'criarMarcacaoConsulta'),
('utente', 'criarMarcacaoConsulta'),
('medico', 'criarMarcacaoExame'),
('admin', 'criarMedicamento'),
('admin', 'criarMedico'),
('medico', 'criarMedico'),
('medico', 'criarReceitaMedica'),
('admin', 'criarUser'),
('admin', 'deleteMedicamento'),
('admin', 'deleteMedico'),
('medico', 'deleteMedico'),
('medico', 'deleteReceitaMedica'),
('admin', 'deleteUser'),
('admin', 'medico'),
('utente', 'Perfil'),
('admin', 'updateMedicamento'),
('admin', 'updateMedico'),
('medico', 'updateMedico'),
('admin', 'updateUser'),
('admin', 'utente'),
('medico', 'verConsulta'),
('utente', 'verConsulta'),
('medico', 'verExame'),
('utente', 'verExame'),
('medico', 'verMarcacaoConsulta'),
('utente', 'verMarcacaoConsulta'),
('medico', 'verMarcacaoExame'),
('utente', 'verMarcacaoExame'),
('admin', 'verMedicamentos'),
('admin', 'verMedico'),
('medico', 'verReceitaMedica'),
('utente', 'verReceitaMedica'),
('admin', 'verUser');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consulta`
--

DROP TABLE IF EXISTS `consulta`;
CREATE TABLE IF NOT EXISTS `consulta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conteudo` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `id_marcacao` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_marcacao` (`id_marcacao`) USING BTREE,
  KEY `id_medico` (`id_medico`) USING BTREE,
  KEY `id_utente` (`id_utente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `consulta`
--

INSERT INTO `consulta` (`id`, `conteudo`, `date`, `id_marcacao`, `id_medico`, `id_utente`) VALUES
(2, '<p>Utente com tosse.</p><p>Possivel covid. Amostra já recolhida para fazer o teste.</p><p><br></p><p>Tomar medicação:</p><ul><li>Valdispert: 2 vezes ao dia;</li><li>Bisolvon: 1 vez depois de cada refeição.</li></ul>', '2021-01-21 14:50:55', 15, 14, 2),
(3, '<p>testes</p><p><br></p><p><br></p><p>teste</p><p>teste</p><p>test<br></p>', '2021-01-27 14:25:42', 18, 39, 6);

-- --------------------------------------------------------

--
-- Table structure for table `especialidade`
--

DROP TABLE IF EXISTS `especialidade`;
CREATE TABLE IF NOT EXISTS `especialidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `especialidade`
--

INSERT INTO `especialidade` (`id`, `tipo`) VALUES
(1, 'Cardiologia'),
(2, 'Cirurgia Geral'),
(3, 'Cirurgia Pediátrica'),
(4, 'Doenças Infecciosas'),
(5, 'Medicina do Trabalho'),
(6, 'Medicina Física e de Reabilitação'),
(7, 'Medicina Interna'),
(8, 'Oftalmologia'),
(9, 'Ortopedia'),
(10, 'Psiquiatria'),
(11, 'Psiquiatria da Infância e da Adolescência'),
(12, 'Saúde Pública');

-- --------------------------------------------------------

--
-- Table structure for table `exame`
--

DROP TABLE IF EXISTS `exame`;
CREATE TABLE IF NOT EXISTS `exame` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conteudo` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_marcacao` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_medico` (`id_medico`) USING BTREE,
  KEY `id_marcacao` (`id_marcacao`) USING BTREE,
  KEY `id_utente` (`id_utente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exame`
--

INSERT INTO `exame` (`id`, `conteudo`, `date`, `id_medico`, `id_marcacao`, `id_utente`) VALUES
(1, '<p>teste</p><p><br></p><p>teste</p><p><br></p><ol><li>teste</li><li>teste</li></ol>', '2021-01-21 19:50:54', 14, 3, 4),
(2, '<p>teste</p><p>teste</p><p>teste</p><p>ola<br></p>', '2021-02-02 13:50:25', 39, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `macacao_exame`
--

DROP TABLE IF EXISTS `macacao_exame`;
CREATE TABLE IF NOT EXISTS `macacao_exame` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `status` enum('Aprovado','Em Espera','Rejeitado','') NOT NULL DEFAULT 'Em Espera',
  `id_especialidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_medico` (`id_medico`) USING BTREE,
  KEY `id_especialidade` (`id_especialidade`) USING BTREE,
  KEY `id_utente` (`id_utente`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `macacao_exame`
--

INSERT INTO `macacao_exame` (`id`, `date`, `id_medico`, `id_utente`, `status`, `id_especialidade`) VALUES
(1, '2020-12-22 22:55:34', 16, 2, 'Aprovado', 8),
(2, '2020-12-21 14:50:53', 12, 2, 'Em Espera', 6),
(3, '2021-01-21 19:50:54', 14, 4, 'Aprovado', 7),
(4, '2021-01-29 15:50:26', 14, 5, 'Em Espera', 7),
(5, '2021-02-02 13:50:25', 39, 2, 'Aprovado', 4),
(6, '2021-02-22 15:45:56', 39, 3, 'Em Espera', 4),
(7, '2021-02-06 14:45:45', 39, 6, 'Em Espera', 4);

-- --------------------------------------------------------

--
-- Table structure for table `marcacao_consulta`
--

DROP TABLE IF EXISTS `marcacao_consulta`;
CREATE TABLE IF NOT EXISTS `marcacao_consulta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_especialidade` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `status` enum('Aprovado','Em Espera','Rejeitado','') NOT NULL DEFAULT 'Em Espera',
  PRIMARY KEY (`id`),
  KEY `id_especialidade` (`id_especialidade`) USING BTREE,
  KEY `id_utente` (`id_utente`) USING BTREE,
  KEY `id_medico` (`id_medico`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marcacao_consulta`
--

INSERT INTO `marcacao_consulta` (`id`, `date`, `id_medico`, `id_especialidade`, `id_utente`, `status`) VALUES
(6, '2020-11-27 15:50:05', 12, 6, 2, 'Aprovado'),
(8, '2020-12-02 19:50:34', 14, 7, 2, 'Aprovado'),
(10, '2020-11-23 19:45:34', 14, 7, 2, 'Aprovado'),
(12, '2020-11-25 21:55:51', 16, 8, 3, 'Aprovado'),
(13, '2020-12-03 14:45:53', 14, 7, 2, 'Em Espera'),
(15, '2021-01-21 14:50:55', 14, 7, 2, 'Aprovado'),
(16, '2021-01-26 18:45:48', 14, 7, 3, 'Em Espera'),
(17, '2021-01-28 13:55:46', 36, 6, 6, 'Em Espera'),
(18, '2021-01-27 14:25:42', 39, 4, 6, 'Aprovado'),
(19, '2021-02-24 15:45:44', 39, 4, 3, 'Em Espera');

-- --------------------------------------------------------

--
-- Table structure for table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `miligramas` decimal(7,2) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `nome`, `miligramas`, `descricao`) VALUES
(2, 'Ácido acetilsalicílico (A-A-S)\r\n', '500.00', 'Medicamento não sujeito a receita médica|\r\nBlister - 1000 unidade(s)\r\nBlister - 20 unidade(s)\r\nBlister - 40 unidade(s)\r\n'),
(3, 'Valdispert', '45.00', 'Medicamento para dormir, 15 comprimidos'),
(4, 'IB-U-RON', '20.00', 'Tomar de 6/6h durante ou após refeições.'),
(5, 'Aspirina-C', '400.00', 'Dissolver em àgua, 1-2 comprimidos de 6/6h, 10 Comprimidos'),
(6, 'BISOLVON', '8.00', '20 comprimidos, 3 vezes ao dia'),
(7, 'BISOLTUSSIN', '2.00', 'Adultos e adolescentes com mais de 12 anos: -5 a 10 ml de Bisoltussin Tosse Seca com intervalos de 4 horas ou -15 ml de Bisoltussin Tosse Seca com intervalos de 6-8 horas.'),
(13, 'Gurosan', '500.00', '20 Comprimidos, Um comprimido de manhã e outro ao meio dia num copo de água'),
(14, 'Cegripe', '500.00', '20 Comprimidos, 1 a 2 comprimidos a cada 6 ou 8 horas (3 ou 4 vezes por dia).'),
(16, 'Halibut', '150.00', 'No Rabinho do Bebé, em cada muda da fralda, aplicar uma camada espessa de Halibut, de modo a criar uma barreira protectora, entre a pele do bebé, a urina e as fezes.'),
(17, 'Bepanthene', '50.00', 'Limpe a ferida ou a zona da pele infectada o melhor possível e aplique uma fina camada de Bepanthene Plus.'),
(19, 'BRUFEN', '200.00', '20 comprimidos,  8 em 8h '),
(20, 'BUSCOPAN', '10.00', '20 Comprimidos, 1 a 2 comprimidos (10 a 20 mg), 3 a 5 vezes por dia.'),
(21, 'LIVETAN', '500.00', '40 Comprimidos, 1 comprimido revestido por película meia hora a 1 hora antes de se deitar'),
(22, 'NEO-SINEFRINA Infantil', '2.50', 'Aplicar o número de gotas necessárias dependendod da idade do paciente'),
(23, 'NEO-SINEFRINA Adulto', '5.00', '3 a 4 gotas em cada narina, em intervalos de 3 a 4 horas. '),
(24, 'IMODIUM RAPID', '2.00', '10 Comprimidos'),
(25, 'ZOVIRAX', '50.00', 'Deve aplicar cinco vezes ao dia durante quatro dias, de modo a cobrir a zona afectada.'),
(26, 'NICORETTE', '2.00', '105 pastilhas'),
(27, 'FENISTIL', '1.00', 'Aplicar 2 a 4 vezes por dia na área afectada.'),
(28, 'CANESTEN', '10.00', 'Deverá ser aplicado na zona a tratar, em camada fina, friccionando ligeiramente.'),
(29, 'OSCILLOCOCCINUM', '0.01', '3 doses com intervalo de 6 horas durante 2 dias.'),
(40, 'Medicação Teste', '123.00', 'Teste Teste');

-- --------------------------------------------------------

--
-- Table structure for table `medicos`
--

DROP TABLE IF EXISTS `medicos`;
CREATE TABLE IF NOT EXISTS `medicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `sexo` enum('Masculino','Feminino') NOT NULL,
  `nif` int(9) NOT NULL,
  `telefone` int(9) NOT NULL,
  `num_ordem_medico` int(16) NOT NULL,
  `id_especialidade` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_especialidade`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicos`
--

INSERT INTO `medicos` (`id`, `nome`, `sexo`, `nif`, `telefone`, `num_ordem_medico`, `id_especialidade`, `id_user`) VALUES
(12, 'Dr. Victor Ribeiro Cunha', 'Masculino', 245538798, 962204216, 519591293, 6, 20),
(14, 'Dr. Sophia Martins Barbosa', 'Feminino', 254362125, 939348129, 879536243, 7, 22),
(16, 'Dr. Julieta Pereira Araujo', 'Feminino', 288583841, 969230745, 981120310, 8, 24),
(25, 'Afonso Araújo', 'Masculino', 564738291, 91230450, 69420, 10, 8),
(26, 'João Albatross', 'Masculino', 203036263, 915073025, 2147483647, 10, 9),
(27, 'David M. Steed', 'Masculino', 249514630, 912666823, 1736264431, 1, 10),
(28, 'Michelle D. Mason', 'Feminino', 220422826, 948099803, 1516372811, 2, 11),
(29, 'Mark M. Tibbetts', 'Masculino', 281233420, 948099157, 1291263453, 2, 12),
(30, 'Francis K. Kent', 'Masculino', 221435352, 948027997, 1728125362, 3, 13),
(31, 'Gabrielly Alves Dias', 'Feminino', 253992214, 910855412, 1901879791, 3, 14),
(32, 'Guilherme Pinto Barbosa', 'Masculino', 202892824, 911602763, 1876582298, 4, 15),
(33, 'Daniel Barros Correia', 'Masculino', 257630171, 948068512, 129994085, 4, 16),
(34, 'Leonor Azevedo Barbosa', 'Feminino', 217534694, 924755838, 274140289, 5, 17),
(35, 'José Silva Martins', 'Masculino', 297251066, 969393024, 371393612, 5, 18),
(36, 'Joao Castro Goncalves', 'Masculino', 218941455, 969354846, 723133682, 6, 19),
(38, 'zzzz', 'Masculino', 222, 2222, 123123, 4, 34),
(39, 'RbacMed', 'Feminino', 654987321, 923651427, 654389, 4, 36);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1603461211),
('m130524_201442_init', 1603461218),
('m190124_110200_add_verification_token_column_to_user_table', 1603461220),
('m140506_102106_rbac_init', 1603461855),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1603461856),
('m180523_151638_rbac_updates_indexes_without_prefix', 1603461856),
('m200409_110543_rbac_update_mssql_trigger', 1603461856),
('m201106_171805_userVerification', 1606318071),
('m210110_183327_rbac', 1610305313);

-- --------------------------------------------------------

--
-- Table structure for table `receita_medica`
--

DROP TABLE IF EXISTS `receita_medica`;
CREATE TABLE IF NOT EXISTS `receita_medica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `conteudo` varchar(255) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_medicamentos` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_medico` (`id_medico`) USING BTREE,
  KEY `id_medicamentos` (`id_medicamentos`) USING BTREE,
  KEY `id_utente` (`id_utente`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receita_medica`
--

INSERT INTO `receita_medica` (`id`, `date`, `conteudo`, `id_medico`, `id_utente`, `id_medicamentos`) VALUES
(1, '2021-01-08 23:31:08', '<p>teste~</p><p><br></p><p><br></p><p>teste<br></p>', 22, 4, 7),
(2, '2021-01-10 23:04:53', '<p>Tomar 2 vez por dia<br></p>', 36, 3, 7),
(3, '2021-01-10 23:09:13', '<p>ola alex este é o certo</p>', 36, 2, 6),
(5, '2021-01-10 23:12:40', '<p>Tomar 1 apos a cada refeição</p>', 39, 6, 6),
(21, '2021-01-11 11:40:44', 'Teste Teste', 39, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(2, 'Alex', 's01hgJ_PUVSFKdNA_8wkT-alJ9h6txog', '$2y$13$9P/01WEJSEBTw0QVIQLxxegBWvWo17KAoE2YWaaDH85h513RC/azm', NULL, 'alexpereira90038@gmail.com', 10, 1606318089, 1606318130, 'xGg1vt9m0adP8_kPgqfVWQW4L20eyB_R_1606318089'),
(3, 'teste', 'Zqw2829aOQEJii73dbjkA3dYamvZ7Y1X', '$2y$13$CYuGcfRMkjaBuCYz363IB.317jYUa0NK4XKCGEtnDyovunD7AezYm', NULL, 'teste@teste.com', 10, 1606487174, 1606487174, 'YyBG3TpF011g4WDhs3GLssQ6RinYsKSH_1606487174'),
(5, 'gsfg', 'hLq2aAS0OBKzC5FSF9Mtnp-rlePDRJfT', '$2y$13$n//iHO62X/QfrHb2Gq538OLBDReSgq9jLhaubycNGRmOTDHIyYcDm', NULL, 'faf@faws.com', 9, 1607707351, 1607707351, 'tHb4XqHRLCo87zGX3aVphPG_ImDHlhpd_1607707351'),
(6, 'sdef', 'f5PrMuK2qdj0JbX1RF4nD3k35Gwdkm0B', '$2y$13$J7F1V0x3g3TrEzMFI/lIduSMnZLI6oZz2MXG1nGEEtPJRXQPSg0cu', NULL, 'jhgg@jhggf.com', 9, 1607707422, 1607707422, 'CGPlFe85OPlOxvmO1hFZs9tghAqh9C4M_1607707422'),
(8, 'Dr.Afonso', 'oJ_WL-KKTSG18k-KJvKMXPyKPzyLirkf', '$2y$13$lFIOVCTwpQGi4cHiPBarouklRu1NvLzxJXFtbFM88rVNhPMWWmI7.', NULL, 'afonso@afonso.com', 10, 1607708529, 1607708529, 'o4zapCLIX95ByZvcMrHMgSjL8rDsNsuw_1607708529'),
(9, 'Joao_Albatross', 'PiRPae8WtdbW01Q2fJQAPvZJ20bz0ul6', '$2y$13$hWy.6JEwFPK0BER9XdXf4OcF1iqQkwrCmeVbD8rcvgO6yJzvnxozy', NULL, 'JoaoAlbatross@myfake.com', 10, 1609810783, 1609810783, 'tWaS7i0lKQuvIbtNJSLXgF7K6O7bws7v_1609810783'),
(10, 'David_Steed', 'BHJmwtn2Og5OjAtIlWGYlW81dQ3gi80-', '$2y$13$tvZwDoB6TTlqbkkmt0Bpyu3fTJyR/6D7yMfRKDULmSgq95VZzEl8y', NULL, 'DavidM_Steed@myfake.com', 10, 1609810863, 1609810863, 'YNEZhcmITe1ALs3PgmGXtAMv5uDIEO5L_1609810863'),
(11, 'Michelle_Mason', 'D9vXNqUUOt4knbJ_sDzOmR0zaISlnaCX', '$2y$13$IfE8g3/4QOgRVNLjLSbBxuMUVz218HKYD74plkor7UymHLH1he82G', NULL, 'Michelle_Mason@myfake.com', 10, 1609810977, 1609810977, '7IZ_GgkLn-ZDFwaAEOLQ0P7C3mECoER5_1609810977'),
(12, 'Mark_Tibbetts', '-DiZr4D5ZqBqURUq1nQ5fn_wGxQoCxcA', '$2y$13$KJRDT1ZaeWGkXJq3W1SwXuUtmklwzNxpYIbGQ6hJ7Cc1KhPCl1KJy', NULL, 'Mark_Tibbetts@myfake.com', 10, 1609811037, 1609811037, 'ZP-oOM65MjMMdzNoKcBx30EfywDSNLt5_1609811037'),
(13, 'Francis_Kent', 'xAAL3rqRHUlDIq-dBY7HUW7hMjx7szmK', '$2y$13$mzJyPNPtA5UxIYByepk49uZEmr8c5/SQs.P8HBsjCFeg/wSFTTeui', NULL, 'Francis_Kent@myfake.com', 10, 1609811076, 1609811076, 'KbTuzEL3Sov8IjLWfPfndY4IT49t3G9p_1609811076'),
(14, 'Gabrielly_Dias', 'bGhXey5KYdHPa54KyaKurSjVGhCYh5fc', '$2y$13$44vx0bwhSqgmzid4kgm6Cu7e/Swv.wEvBQk6YEA.iexzTuEivxxB6', NULL, 'Gabrielly_Dias@myfake.com', 10, 1609811121, 1609811121, 'nD1lFVQHtNRkaT6v7MF2NPh50isn2qSv_1609811121'),
(15, 'Guilherme_Barbosa', 'C2GQ1Iyy5G5cf2l3LjyF64VfKaMAM_xG', '$2y$13$qPN0/4Y9bG1X9afa.W.R..CDQdM9fpQwqcXWcm4lmm1cFWD0NygTu', NULL, 'Guilherme_Barbosa@myfake.com', 10, 1609811228, 1609811228, 'wyDVIbZH5-nWGv4zjn3OfzXJ1JwWDgHz_1609811228'),
(16, 'Daniel_Correia', 'BHs-ZTlXa4Fb9Y3D6haPuv2cykjcQhJQ', '$2y$13$yJf.xaf2UqFuhuGqjTSkp.oIz77nX5ZNRLfZxlQjs/3/Vv/DAo8Xa', NULL, 'Daniel_Correia@myfake.com', 10, 1609811270, 1609811270, '7e0qmxV9-UITVNuT8n80FktKY6279SJq_1609811270'),
(17, 'Leonor_Barbosa', 'znxRsCB5g_kxgT7IPMk7RvcB6F_9J4WX', '$2y$13$ft37TFZiVXJp3rI.iCI2.eK877UwW.cFEx.yUDKQ0k.vSh68tIxEm', NULL, 'Leonor_Barbosa@myfake.com', 10, 1609811348, 1609811348, 'iy9lwT2fVnnC0YW-Y05fJVWlFsAtSgYC_1609811348'),
(18, 'Jose_Martins', '-pbhAlRQH9phJTadyV99QLNCm0-8oA9F', '$2y$13$fD2x7qVOzNPwjbZrrVj90ue.fJPLaUrxALtZs7mPsEdwFHPHz/Dx2', NULL, 'Jose_Martins@myfake.com', 10, 1609811390, 1609811390, 'BIThWzUi4Ma5TTQyvCjTO-jXngTok78w_1609811390'),
(19, 'Joao_Goncalves', 'He8RHuXEjkVAYfb0QNRDqar9mktQ_2ws', '$2y$13$NGPD8SY7AAMORnGQVwXAGOjtvMyTo/GMV0Awzbgbt2c/flIMUVq/6', NULL, 'Joao_Goncalves@myfake.com', 10, 1609811431, 1609811431, 'xmK4WazWcd25ExJXs3jqgbYnqaWRbdz2_1609811431'),
(20, 'Victor_Cunha', 'He8RHuXEjkVAYfb0QNRDqar9mktQ_2ws', '$2y$13$NGPD8SY7AAMORnGQVwXAGOjtvMyTo/GMV0Awzbgbt2c/flIMUVq/6', NULL, 'Victor_Cunha@myfake.com', 10, 1609811431, 1609811431, 'xmK4WazWcd25ExJXs3jqgbYnqaWRbdz2_1609811431'),
(21, 'Renan_Martins', 'He8RHuXEjkVAYfb0QNRDqar9mktQ_2ws', '$2y$13$NGPD8SY7AAMORnGQVwXAGOjtvMyTo/GMV0Awzbgbt2c/flIMUVq/6', NULL, 'Renan_Martins@myfake.com', 10, 1609811431, 1609811431, 'xmK4WazWcd25ExJXs3jqgbYnqaWRbdz2_1609811431'),
(22, 'Sophia_Barbosa', 'He8RHuXEjkVAYfb0QNRDqar9mktQ_2ws', '$2y$13$NGPD8SY7AAMORnGQVwXAGOjtvMyTo/GMV0Awzbgbt2c/flIMUVq/6', NULL, 'Sophia_Barbosa@myfake.com', 10, 1609811431, 1609811431, 'xmK4WazWcd25ExJXs3jqgbYnqaWRbdz2_1609811431'),
(23, 'Joao_Silva', 'He8RHuXEjkVAYfb0QNRDqar9mktQ_2ws', '$2y$13$NGPD8SY7AAMORnGQVwXAGOjtvMyTo/GMV0Awzbgbt2c/flIMUVq/6', NULL, 'Joao_Silva@myfake.com', 10, 1609811431, 1609811431, 'xmK4WazWcd25ExJXs3jqgbYnqaWRbdz2_1609811431'),
(24, 'Julieta_Araujo', 'He8RHuXEjkVAYfb0QNRDqar9mktQ_2ws', '$2y$13$NGPD8SY7AAMORnGQVwXAGOjtvMyTo/GMV0Awzbgbt2c/flIMUVq/6', NULL, 'Julieta_Araujo@myfake.com', 10, 1609811431, 1609811431, 'xmK4WazWcd25ExJXs3jqgbYnqaWRbdz2_1609811431'),
(25, 'Diogo_Ribeiro', 'He8RHuXEjkVAYfb0QNRDqar9mktQ_2ws', '$2y$13$NGPD8SY7AAMORnGQVwXAGOjtvMyTo/GMV0Awzbgbt2c/flIMUVq/6', NULL, 'Diogo_Ribeiro@myfake.com', 10, 1609811431, 1609811431, 'xmK4WazWcd25ExJXs3jqgbYnqaWRbdz2_1609811431'),
(35, 'RbacTest', 'SBBQM4khtW42-eo3S3OTtnu9exzywIZT', '$2y$13$T/uNzr8rI3T641DUzPNuBOFxN5.uv2CGOsBu0PaFPt79IyMuCknk.', NULL, 'RbacTest@gmail.com', 10, 1610306989, 1610306989, 'o6VjULFv9QC4h1_xcSn3MHF2YOnxTZhj_1610306989'),
(36, 'RbacMed', '2ZNiEbKntv943rDUu33g24o2GaYcB1ab', '$2y$13$gsIEdKxTL6qAuv13BAFNnuTh1odWqkPgfe1aJtWuq9oOVjGFRjL7.', NULL, 'RbacMed@gmail.com', 10, 1610313985, 1610313985, 'Z2NK9LXLfv6M5tXEn3BiNlp-ynml2yYk_1610313985'),
(37, 'admin', 's01hgJ_PUVSFKdNA_8wkT-alJ9h6txog', '$2y$13$9P/01WEJSEBTw0QVIQLxxegBWvWo17KAoE2YWaaDH85h513RC/azm', NULL, 'admin@admin.com', 10, 1606318089, 1606318089, 'xGg1vt9m0adP8_kPgqfVWQW4L20eyB_R_1606318089');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
CREATE TABLE IF NOT EXISTS `utente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `nif` int(9) NOT NULL,
  `sexo` enum('Masculino','Feminino') NOT NULL,
  `telemovel` int(9) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `num_sns` int(9) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`id`, `nome`, `nif`, `sexo`, `telemovel`, `morada`, `email`, `num_sns`, `id_user`) VALUES
(2, 'Alex', 123456789, 'Masculino', 916073037, 'rua rua', 'alexpereira90038@gmail.com', 123456789, 2),
(3, 'teste', 987654321, 'Masculino', 923065035, 'rua rua', 'teste@teste.com', 987654321, 3),
(4, 'jhkgfd', 987654345, 'Masculino', 345465345, 'tgsdgsd', 'faf@faws.com', 987321234, 5),
(5, 'gjasf', 654321789, 'Masculino', 943215678, 'trt', 'jhgg@jhggf.com', 123456780, 6),
(6, 'TestRbac', 321789654, 'Masculino', 945212325, 'rbac rbac', 'RbacTest@gmail.com', 19763248, 35);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`id_marcacao`) REFERENCES `marcacao_consulta` (`id`),
  ADD CONSTRAINT `consulta_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id`);

--
-- Constraints for table `exame`
--
ALTER TABLE `exame`
  ADD CONSTRAINT `exame_ibfk_1` FOREIGN KEY (`id_marcacao`) REFERENCES `macacao_exame` (`id`),
  ADD CONSTRAINT `exame_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id`);

--
-- Constraints for table `macacao_exame`
--
ALTER TABLE `macacao_exame`
  ADD CONSTRAINT `macacao_exame_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id`),
  ADD CONSTRAINT `macacao_exame_ibfk_3` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidade` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
