-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2020 at 04:51 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kindredclinic`
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
('utente', '2', 1606318091),
('utente', '3', 1606487175);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
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
('consulta', 2, 'Consulta', NULL, NULL, 1606318071, 1606318071),
('marcacao_consulta', 2, 'Marcar uma consulta', NULL, NULL, 1606318071, 1606318071),
('receitaMedica', 2, 'Receita Medica', NULL, NULL, 1606318071, 1606318071),
('utente', 1, NULL, NULL, NULL, 1606318071, 1606318071);

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
('utente', 'consulta'),
('utente', 'marcacao_consulta'),
('utente', 'receitaMedica');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  KEY `id_marcacao` (`id_marcacao`) USING BTREE,
  KEY `id_medico` (`id_medico`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`id`),
  KEY `id_medico` (`id_medico`) USING BTREE,
  KEY `id_marcacao` (`id_marcacao`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `macacao_exame`
--

INSERT INTO `macacao_exame` (`id`, `date`, `id_medico`, `id_utente`, `status`, `id_especialidade`) VALUES
(1, '2020-12-22 22:55:34', 16, 2, 'Aprovado', 8),
(2, '2020-12-21 14:50:53', 12, 2, 'Em Espera', 6);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marcacao_consulta`
--

INSERT INTO `marcacao_consulta` (`id`, `date`, `id_medico`, `id_especialidade`, `id_utente`, `status`) VALUES
(6, '2020-11-27 15:50:05', 12, 6, 2, 'Aprovado'),
(7, '2020-11-26 22:50:38', 8, 4, 2, 'Aprovado'),
(8, '2020-12-02 19:50:34', 14, 7, 2, 'Aprovado'),
(9, '2020-11-30 11:45:36', 5, 3, 2, 'Aprovado'),
(10, '2020-11-23 19:45:34', 14, 7, 2, 'Aprovado'),
(11, '2021-01-01 18:45:04', 10, 5, 2, 'Aprovado'),
(12, '2020-11-25 21:55:51', 16, 8, 3, 'Aprovado'),
(13, '2020-12-03 14:45:53', 14, 7, 2, 'Aprovado'),
(14, '2020-12-10 11:50:16', 9, 5, 2, 'Em Espera');

-- --------------------------------------------------------

--
-- Table structure for table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `gramas` decimal(7,2) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `nome`, `gramas`, `descricao`) VALUES
(2, 'Ácido acetilsalicílico (A-A-S)\r\n', '500.00', 'Medicamento não sujeito a receita médica|\r\nBlister - 1000 unidade(s)\r\nBlister - 20 unidade(s)\r\nBlister - 40 unidade(s)\r\n'),
(3, 'Valdispert', '45.00', 'Medicamento para dormir, 15 comprimidos'),
(4, 'IB-U-RON', '20.00', 'Tomar de 6/6h durante ou após refeições.'),
(5, 'Aspirina-C', '400.00', 'Dissolver em àgua, 1-2 comprimidos de 6/6h, 10 Comprimidos'),
(6, 'BISOLVON', '8.00', '20 comprimidos, 3 vezes ao dia'),
(7, 'BISOLTUSSIN', '2.00', 'Adultos e adolescentes com mais de 12 anos: -5 a 10 ml de Bisoltussin Tosse Seca com intervalos de 4 horas ou -15 ml de Bisoltussin Tosse Seca com intervalos de 6-8 horas.'),
(13, 'Gurosan', '500.00', '20 Comprimidos, Um comprimido de manhã e outro ao meio dia num copo de água'),
(14, 'Cegripe', '500.00', '20 Comprimidos, 1 a 2 comprimidos a cada 6 ou 8 horas (3 ou 4 vezes por dia).'),
(16, 'Halibut', '150.00', 'No Rabinho do Bebé, em cada muda da fralda, aplicar uma camada espessa de Halibut, de modo a criar uma barreira protectora, entre a pele do bebé, a urina e as fezes.'),
(17, 'Bepanthene', '50.00', 'Limpe a ferida ou a zona da pele infectada o melhor possível e aplique uma fina camada de Bepanthene Plus.');

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
  `email` varchar(255) NOT NULL,
  `num_ordem_medico` int(16) NOT NULL,
  `id_especialidade` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_especialidade`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicos`
--

INSERT INTO `medicos` (`id`, `nome`, `sexo`, `nif`, `telefone`, `email`, `num_ordem_medico`, `id_especialidade`) VALUES
(1, 'Dr. João Albatross', 'Masculino', 203036263, 915073025, 'João.Albatross@hotmail.com', 2147483647, 10),
(2, 'Dr. David M. Steed', 'Masculino', 249514630, 912666823, 'DavidMSteed@jourrapide.com', 1736264431, 1),
(3, 'Dr. Michelle D. Mason', 'Feminino', 220422826, 948099803, 'MichelleDMason@rhyta.com ', 1516372811, 2),
(4, 'Dr. Mark M. Tibbetts', 'Masculino', 281233420, 948099157, 'MarkMTibbetts@rhyta.com ', 1291263453, 2),
(5, 'Dr. Francis K. Kent', 'Masculino', 221435352, 948027997, 'FrancisKKent@jourrapide.com ', 1728125362, 3),
(6, 'Dr. Gabrielly Alves Dias', 'Feminino', 253992214, 910855412, 'GabriellyAlvesDias@rhyta.com ', 1901879791, 3),
(7, 'Dr. Guilherme Pinto Barbosa', 'Masculino', 202892824, 911602763, 'GuilhermePintoBarbosa@jourrapide.com', 1876582298, 4),
(8, 'Dr. Daniel Barros Correia', 'Masculino', 257630171, 948068512, 'DanielBarrosCorreia@teleworm.us ', 129994085, 4),
(9, 'Dr. Leonor Azevedo Barbosa', 'Feminino', 217534694, 924755838, 'LeonorAzevedoBarbosa@rhyta.com', 274140289, 5),
(10, 'Dr. José Silva Martins', 'Masculino', 297251066, 969393024, 'JoseSilvaMartins@rhyta.com', 371393612, 5),
(11, 'Dr. Joao Castro Goncalves', 'Masculino', 218941455, 969354846, 'JoaoCastroGoncalves@dayrep.com', 723133682, 6),
(12, 'Dr. Victor Ribeiro Cunha', 'Masculino', 245538798, 962204216, 'VictorRibeiroCunha@armyspy.com ', 519591293, 6),
(13, 'Dr. Renan Santos Martins', 'Feminino', 288880005, 939389418, 'RenanSantosMartins@teleworm.us', 857827916, 7),
(14, 'Dr. Sophia Martins Barbosa', 'Feminino', 254362125, 939348129, 'SophiaMartinsBarbosa@jourrapide.com', 879536243, 7),
(15, 'Dr. João Carvalho Silva', 'Masculino', 219207690, 639230316, 'JoaoCarvalhoSilva@rhyta.com', 557899400, 8),
(16, 'Dr. Julieta Pereira Araujo', 'Feminino', 288583841, 969230745, 'JulietaPereiraAraujo@jourrapide.com', 981120310, 8),
(17, 'Dr. Diogo Barbosa Ribeiro', 'Masculino', 283614250, 909389751, 'DiogoBarbosaRibeiro@armyspy.com', 881928717, 9),
(18, 'Dr. José Martins Caralho', 'Masculino', 254506682, 909317274, 'JoseMartinsCarvalho@rhyta.com ', 561910771, 9),
(19, 'Dr. Danilo Pereira Rocha', 'Masculino', 255723067, 969347517, 'DaniloPereiraRocha@armyspy.com ', 216748876, 10),
(20, 'Dr. Gabriela Ferreira Sousa', 'Feminino', 217491340, 969310170, 'GabrielaFerreiraSousa@armyspy.com ', 479505815, 1),
(21, 'Dr. Kauan Cardoso Cunha', 'Masculino', 260122564, 959230418, 'KauanCardosoCunha@armyspy.com', 654332562, 11),
(22, 'Dr. Paulo Araujo Ribeiro', 'Masculino', 260122564, 959230834, 'PauloAraujoRibeiro@dayrep.com', 654332562, 11),
(23, 'Dr. Karen Martins Dias', 'Feminino', 234178787, 959230853, 'NicoleMartinsDias@dayrep.com ', 962433288, 12),
(24, 'Dr. Renan Castro Cavalcanti', 'Feminino', 284784591, 959230643, 'RenanCastroCavalcanti@dayrep.com ', 398075423, 12);

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
('m201106_171805_userVerification', 1606318071);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(2, 'Alex', 's01hgJ_PUVSFKdNA_8wkT-alJ9h6txog', '$2y$13$9P/01WEJSEBTw0QVIQLxxegBWvWo17KAoE2YWaaDH85h513RC/azm', NULL, 'alexpereira90038@gmail.com', 10, 1606318089, 1606318130, 'xGg1vt9m0adP8_kPgqfVWQW4L20eyB_R_1606318089'),
(3, 'teste', 'Zqw2829aOQEJii73dbjkA3dYamvZ7Y1X', '$2y$13$CYuGcfRMkjaBuCYz363IB.317jYUa0NK4XKCGEtnDyovunD7AezYm', NULL, 'teste@teste.com', 10, 1606487174, 1606487174, 'YyBG3TpF011g4WDhs3GLssQ6RinYsKSH_1606487174');

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
  KEY `id_user` (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`id`, `nome`, `nif`, `sexo`, `telemovel`, `morada`, `email`, `num_sns`, `id_user`) VALUES
(2, 'Alex', 123456789, 'Masculino', 916073037, 'rua rua', 'alexpereira90038@gmail.com', 123456789, 2),
(3, 'teste', 987654321, 'Masculino', 923065035, 'rua rua', 'teste@teste.com', 987654321, 3);

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
  ADD CONSTRAINT `macacao_exame_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`),
  ADD CONSTRAINT `macacao_exame_ibfk_3` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidade` (`id`);

--
-- Constraints for table `marcacao_consulta`
--
ALTER TABLE `marcacao_consulta`
  ADD CONSTRAINT `marcacao_consulta_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`),
  ADD CONSTRAINT `marcacao_consulta_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id`),
  ADD CONSTRAINT `marcacao_consulta_ibfk_3` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidade` (`id`);

--
-- Constraints for table `medicos`
--
ALTER TABLE `medicos`
  ADD CONSTRAINT `medicos_ibfk_1` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidade` (`id`);

--
-- Constraints for table `receita_medica`
--
ALTER TABLE `receita_medica`
  ADD CONSTRAINT `receita_medica_ibfk_1` FOREIGN KEY (`id_medicamentos`) REFERENCES `medicamentos` (`id`),
  ADD CONSTRAINT `receita_medica_ibfk_2` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id`),
  ADD CONSTRAINT `receita_medica_ibfk_3` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
