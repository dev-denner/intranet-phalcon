-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04-Jan-2016 às 15:59
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-3:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: nucleo
--
use nucleo;
-- --------------------------------------------------------

--
-- Estrutura da tabela actions
--

CREATE TABLE IF NOT EXISTS actions (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(45) NOT NULL,
  slug varchar(25) NOT NULL,
  controller int(11) NOT NULL,
  status varchar(1) NOT NULL,
  isPublic varchar(1) DEFAULT NULL,
  sdel varchar(1) DEFAULT NULL,
  createBy varchar(45) DEFAULT NULL,
  createIn datetime DEFAULT NULL,
  updateBy varchar(45) DEFAULT NULL,
  updateIn datetime DEFAULT NULL,
  PRIMARY KEY (id),
  KEY actions_controllers_idx (controller)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de funções do controlador (actions)';

--
-- Extraindo dados da tabela actions
--

INSERT INTO actions (id, title, slug, controller, status, isPublic, sdel, createBy, createIn, updateBy, updateIn) VALUES
(1, 'Listar', 'list', 1, 'A', NULL, NULL, 'system', now(), NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela controllers
--

CREATE TABLE IF NOT EXISTS controllers (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(45) NOT NULL,
  slug varchar(25) NOT NULL,
  module int(11) NOT NULL,
  status varchar(1) NOT NULL,
  isPublic varchar(1) DEFAULT NULL,
  sdel varchar(1) DEFAULT NULL,
  createBy varchar(45) DEFAULT NULL,
  createIn datetime DEFAULT NULL,
  updateBy varchar(45) DEFAULT NULL,
  updateIn datetime DEFAULT NULL,
  PRIMARY KEY (id),
  KEY controllers_modules_idx (module)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de controladores';

--
-- Extraindo dados da tabela controllers
--

INSERT INTO controllers (id, title, slug, module, status, isPublic, sdel, createBy, createIn, updateBy, updateIn) VALUES
(1, 'Usuarios', 'users', 1, 'A', NULL, NULL, 'system', now(), NULL, NULL),
(2, 'Grupos', 'groups', 1, 'A', NULL, NULL, 'system', now(), NULL, NULL),
(3, 'Empresas', 'empresas', 1, 'A', NULL, NULL, 'system', now(), NULL, NULL),
(4, 'Departamentos', 'departments', 1, 'A', NULL, NULL, 'system', now(), NULL, NULL),
(5, 'Modulos', 'modules', 1, 'A', NULL, NULL, 'system', now(), NULL, NULL),
(6, 'Controles', 'controllers', 1, 'A', NULL, NULL, 'system', now(), NULL, NULL),
(7, 'Perfis', 'perfils', 1, 'A', NULL, NULL, 'system', now(), NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela departments
--

CREATE TABLE IF NOT EXISTS departments (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(105) DEFAULT NULL,
  status varchar(1) NOT NULL,
  sdel varchar(1) DEFAULT NULL,
  createBy varchar(45) DEFAULT NULL,
  createIn datetime DEFAULT NULL,
  updateBy varchar(45) DEFAULT NULL,
  updateIn datetime DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de departamentos';

--
-- Extraindo dados da tabela departments
--

INSERT INTO departments (id, name, status, sdel, createBy, createIn, updateBy, updateIn) VALUES
(1, 'TI', 'A', NULL, 'system', now(), NULL, NULL),
(2, 'SUPRIMENTOS', 'A', NULL, 'system', now(), NULL, NULL),
(3, 'DP', 'A', NULL, 'system', now(), NULL, NULL),
(4, 'SGI', 'A', NULL, 'system', now(), NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela empresas
--

CREATE TABLE IF NOT EXISTS empresas (
  id int(11) NOT NULL AUTO_INCREMENT,
  codigo varchar(3) NOT NULL,
  cnpj varchar(20) DEFAULT NULL,
  razaoSocial varchar(105) DEFAULT NULL,
  nomeFantasia varchar(105) DEFAULT NULL,
  codProtheus varchar(20) DEFAULT NULL,
  lojaProtheus varchar(5) DEFAULT NULL,
  sdel varchar(1) DEFAULT NULL,
  createBy varchar(45) DEFAULT NULL,
  createIn datetime DEFAULT NULL,
  updateBy varchar(45) DEFAULT NULL,
  updateIn datetime DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de empresas';

--
-- Extraindo dados da tabela empresas
--

INSERT INTO empresas (id, codigo, cnpj, razaoSocial, nomeFantasia, codProtheus, lojaProtheus, sdel, createBy, createIn, updateBy, updateIn) VALUES
(1, '1', '31876709000189', 'MPE MONTAGENS E PROJETOS ESPECIAIS S/A', 'MPE', 'F00008', '01', NULL, 'system', now(), NULL, NULL),
(2, '2', '33247271000103', 'EMPRESA BRASILEIRA DE ENGENHARIA S/A', 'EBE', 'F00235', '01', NULL, 'system', now(), NULL, NULL),
(3, '3', '04743858000105', 'MPE ENGENHARIA E SERVICOS S.A.', 'MPE SERV', 'F09792', '01', NULL, 'system', now(), NULL, NULL),
(4, '4', '28579175000114', 'GEMON - GERAL DE ENGENHARIA E MONTAGENS S/A', 'GEMON', 'F00235', '01', NULL, 'system', now(), NULL, NULL),
(5, '5', '13600911000100', 'VALENCA DA BAHA MARICULTURA SA', 'VALENÇA', NULL, NULL, NULL, 'system', now(), NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela funcionarios
--

CREATE TABLE IF NOT EXISTS funcionarios (
  id int(11) NOT NULL AUTO_INCREMENT,
  chapa varchar(6) NOT NULL,
  nome varchar(105) DEFAULT NULL,
  cpf varchar(14) DEFAULT NULL,
  empresa int(11) DEFAULT NULL,
  situacao varchar(50) DEFAULT NULL,
  tipo varchar(50) DEFAULT NULL,
  dataAdmissao datetime DEFAULT NULL,
  cargo varchar(80) DEFAULT NULL,
  email varchar(120) DEFAULT NULL,
  centroCusto varchar(9) DEFAULT NULL,
  sdel varchar(1) DEFAULT NULL,
  createBy varchar(45) DEFAULT NULL,
  createIn datetime DEFAULT NULL,
  updateBy varchar(45) DEFAULT NULL,
  updateIn datetime DEFAULT NULL,
  PRIMARY KEY (id),
  KEY funcionarios_empresas_idx (empresa)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de funcionários';

-- --------------------------------------------------------

--
-- Estrutura da tabela groups
--

CREATE TABLE IF NOT EXISTS groups (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(45) DEFAULT NULL,
  status varchar(1) DEFAULT NULL,
  sdel varchar(1) DEFAULT NULL,
  createBy varchar(45) DEFAULT NULL,
  createIn datetime DEFAULT NULL,
  updateBy varchar(45) DEFAULT NULL,
  updateIn datetime DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de grupos';

--
-- Extraindo dados da tabela groups
--

INSERT INTO groups (id, name, status, sdel, createBy, createIn, updateBy, updateIn) VALUES
(1, 'Admin', 'A', NULL, 'system', now(), NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela logins
--

CREATE TABLE IF NOT EXISTS logins (
  id int(11) NOT NULL AUTO_INCREMENT,
  userId int(11) DEFAULT NULL,
  type varchar(1) NOT NULL COMMENT 'E - Confirmar Email \nF - Falha no login \nP - Mudança de senha\nR - Resetar Senha',
  ipAddress char(15) NOT NULL,
  attempted smallint(5) unsigned NOT NULL,
  userAgent varchar(120) NOT NULL,
  createIn datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY logins_users_idx (userId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de logins no sistema' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela menus
--

CREATE TABLE IF NOT EXISTS menus (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(45) NOT NULL,
  slug varchar(45) DEFAULT NULL,
  parents int(11) DEFAULT NULL,
  action int(11) NOT NULL,
  sdel varchar(1) DEFAULT NULL,
  createBy varchar(45) DEFAULT NULL,
  createIn datetime DEFAULT NULL,
  updateBy varchar(45) DEFAULT NULL,
  updateIn datetime DEFAULT NULL,
  PRIMARY KEY (id),
  KEY menus_actions_idx (action),
  KEY menus_menus_idx (parents)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de Menus' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela modules
--

CREATE TABLE IF NOT EXISTS modules (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(25) NOT NULL,
  department int(11) DEFAULT NULL,
  status varchar(1) NOT NULL,
  isPublic varchar(1) DEFAULT NULL,
  sdel varchar(1) DEFAULT NULL,
  createBy varchar(45) DEFAULT NULL,
  createIn datetime DEFAULT NULL,
  updateBy varchar(45) DEFAULT NULL,
  updateIn datetime DEFAULT NULL,
  PRIMARY KEY (id),
  KEY modules_departments_idx (department)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de modulos';

--
-- Extraindo dados da tabela modules
--

INSERT INTO modules (id, name, department, status, isPublic, sdel, createBy, createIn, updateBy, updateIn) VALUES
(1, 'NUCLEO', 1, 'A', '0', NULL, 'system', now(), NULL, NULL),
(2, 'CNAB', 3, 'A', '0', NULL, 'system', now(), NULL, NULL),
(3, 'IMPORTACOES', 1, 'A', '0', NULL, 'system', now(), NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela notifications
--

CREATE TABLE IF NOT EXISTS notifications (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  userId int(11) DEFAULT NULL,
  section varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  subsection varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  recipient int(11) DEFAULT NULL,
  message text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  redirect varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  seen tinyint(1) DEFAULT NULL,
  createIn datetime DEFAULT NULL,
  updateIn datetime DEFAULT NULL,
  PRIMARY KEY (id),
  KEY notifications_users_idx (userId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela perfils
--

CREATE TABLE IF NOT EXISTS perfils (
  id int(11) NOT NULL AUTO_INCREMENT,
  user int(11) DEFAULT NULL,
  group int(11) DEFAULT NULL,
  module int(11) DEFAULT NULL,
  controller int(11) DEFAULT NULL,
  action int(11) DEFAULT NULL,
  status varchar(1) DEFAULT NULL,
  sdel varchar(1) DEFAULT NULL,
  createBy varchar(45) DEFAULT NULL,
  createIn datetime DEFAULT NULL,
  updateBy varchar(45) DEFAULT NULL,
  updateIn datetime DEFAULT NULL,
  PRIMARY KEY (id),
  KEY profiles_users_idx (user),
  KEY profiles_groups_idx (group),
  KEY profiles_modules_idx (module),
  KEY profiles_controller_idx (controller),
  KEY profiles_actions_idx (action)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de perfis de usuários ou grupos';

--
-- Extraindo dados da tabela perfils
--

INSERT INTO perfils (id, user, group, module, controller, action, status, sdel, createBy, createIn, updateBy, updateIn) VALUES
(1, NULL, 1, 1, 1, 1, 'A', NULL, 'system', now(), NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela tokens
--

CREATE TABLE IF NOT EXISTS tokens (
  id int(11) NOT NULL AUTO_INCREMENT,
  usersId int(11) DEFAULT NULL,
  token char(32) NOT NULL,
  userAgent varchar(120) NOT NULL,
  createIn datetime NOT NULL,
  PRIMARY KEY (id),
  KEY remember_tokens_users_idx (usersId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de tokens no sistema' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela users
--

CREATE TABLE IF NOT EXISTS users (
  id int(11) NOT NULL AUTO_INCREMENT,
  cpf varchar(14) NOT NULL,
  senha varchar(105) DEFAULT NULL,
  mudarSenha varchar(1) DEFAULT NULL,
  email varchar(105) DEFAULT NULL,
  nome varchar(105) DEFAULT NULL,
  status varchar(1) NOT NULL,
  sdel varchar(1) DEFAULT NULL,
  createBy varchar(45) DEFAULT NULL,
  createIn datetime DEFAULT NULL,
  updateBy varchar(45) DEFAULT NULL,
  updateIn datetime DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY cpf_UNIQUE (cpf)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de usuários';

--
-- Extraindo dados da tabela users
--

INSERT INTO users (id, cpf, senha, mudarSenha, email, nome, status, sdel, createBy, createIn, updateBy, updateIn) VALUES
(1, '00000000000', '123456', '1', 'denners.fernandes@grupompe.com.br', 'Admin', 'A', NULL, 'system', now(), NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela users_groups
--

CREATE TABLE IF NOT EXISTS users_groups (
  id int(11) NOT NULL AUTO_INCREMENT,
  userId int(11) DEFAULT NULL,
  groupId int(11) DEFAULT NULL,
  sdel varchar(1) DEFAULT NULL,
  createBy varchar(45) DEFAULT NULL,
  createIn datetime DEFAULT NULL,
  updateBy varchar(45) DEFAULT NULL,
  updateIn datetime DEFAULT NULL,
  PRIMARY KEY (id),
  KEY users_groups_users_idx (userId),
  KEY users_groups_goups_idx (groupId)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela users_groups
--

INSERT INTO users_groups (id, userId, groupId, sdel, createBy, createIn, updateBy, updateIn) VALUES
(1, 1, 1, NULL, 'system', now(), NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela actions
--
ALTER TABLE actions
  ADD CONSTRAINT actions_controllers FOREIGN KEY (controller) REFERENCES controllers (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela controllers
--
ALTER TABLE controllers
  ADD CONSTRAINT controllers_modules FOREIGN KEY (module) REFERENCES modules (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela funcionarios
--
ALTER TABLE funcionarios
  ADD CONSTRAINT funcionarios_empresas FOREIGN KEY (empresa) REFERENCES empresas (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela logins
--
ALTER TABLE logins
  ADD CONSTRAINT logins_users FOREIGN KEY (userId) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela menus
--
ALTER TABLE menus
  ADD CONSTRAINT menus_actions FOREIGN KEY (action) REFERENCES actions (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT menus_menus FOREIGN KEY (parents) REFERENCES menus (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela modules
--
ALTER TABLE modules
  ADD CONSTRAINT modules_departments FOREIGN KEY (department) REFERENCES departments (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela notifications
--
ALTER TABLE notifications
  ADD CONSTRAINT notifications_users FOREIGN KEY (userId) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela perfils
--
ALTER TABLE perfils
  ADD CONSTRAINT profiles_actions FOREIGN KEY (action) REFERENCES actions (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT profiles_controllers FOREIGN KEY (controller) REFERENCES controllers (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT profiles_groups FOREIGN KEY (group) REFERENCES groups (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT profiles_modules FOREIGN KEY (module) REFERENCES modules (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT profiles_users FOREIGN KEY (user) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela tokens
--
ALTER TABLE tokens
  ADD CONSTRAINT tokens_users FOREIGN KEY (usersId) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela users_groups
--
ALTER TABLE users_groups
  ADD CONSTRAINT users_groups_goups FOREIGN KEY (groupId) REFERENCES groups (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT users_groups_users FOREIGN KEY (userId) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
