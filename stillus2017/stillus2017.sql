-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21-Dez-2016 às 14:37
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stillus2017`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `ordem` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `banners`
--

INSERT INTO `banners` (`id`, `titulo`, `descricao`, `foto`, `ordem`) VALUES
(10, 'Aplicativos Mobile', 'Fazemos Aplicativos', 'banner_20161027170128_aplicativos-mobile_slide-3.jpg', '0'),
(12, 'Marketing Digital', 'Seja visto pelo cliente <br /> Várias soluções', 'banner_20161027180955_marketing-digital_slide-1.jpg', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `campanha`
--

CREATE TABLE `campanha` (
  `id` int(11) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `campanha` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `data` varchar(100) NOT NULL,
  `foto` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `campanha`
--

INSERT INTO `campanha` (`id`, `cliente`, `campanha`, `descricao`, `data`, `foto`) VALUES
(1, 'PSB', 'Aplicativos', 'campanha', '2016-11-18', 'campanha_20161109211517_psbcampanha-testeuntitled-1.jpg'),
(2, 'Proença Supermercados', 'Sites', 'Promoção do Cartão de Crédito da rede Proença', '2016-06-01', 'campanha_20161129181837_proenca-supermercadoscartao-que-vale-carraoaaaaaaaaaaaaaaaaaaa.png'),
(3, 'Marisa Tonello', 'Fanpages', 'Toda a comunicação da Fanpage e planejamento', '2014-11-11', 'campanha_20161129182338_marisa-tonellofanpagemarisa.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `campanha_imagens`
--

CREATE TABLE `campanha_imagens` (
  `id` int(11) NOT NULL,
  `campanha` int(11) NOT NULL,
  `imagem` text NOT NULL,
  `legenda` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `ordem` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `descricao`, `texto`, `foto`, `ordem`) VALUES
(1, 'Monte Trípoli', 'Texto', 'Descrição', 'clientes20161129211310_monte-tripoli_clientes20161129211147-clientes-20161027202100-psb-logo1.png', '0'),
(2, 'Proença Supermercados', 'Descrição', 'Texto', 'clientes_20161129170243_proenca-supermercados_222.png', '1'),
(3, 'Marisa Tonello', 'Descrição', 'Texto', 'clientes_20161129182254_marisa-tonello_marisalogo.png', '3'),
(4, 'Transsen Aquecedor Solar', 'Descrição', 'Texto', 'clientes_20161129212212_transsen-aquecedor-solar_transsen.png', '0'),
(5, 'Bandeirante Supermercados', 'Descrição', 'Texto', 'clientes_20161129212301_bandeirante-supermercados_band.png', '0'),
(6, 'Supermercado Casa Aliança', 'Descrição', 'Texto', 'clientes_20161129212322_supermercado-casa-alianca_casa.png', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `depoimentos`
--

CREATE TABLE `depoimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `ordem` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `depoimentos`
--

INSERT INTO `depoimentos` (`id`, `nome`, `descricao`, `texto`, `foto`, `ordem`) VALUES
(12, 'Marisa', 'Coach empresarial', 'Bora lá todo mundo na Stillus #TOP', 'depoimentos_20161027194127__avatar-1.jpg', '0'),
(13, 'Abraham', 'Vítima', '%&*#@ meu !@#%', 'depoimentos_20161027194755_abraham_avatar-2.jpg', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipe`
--

CREATE TABLE `equipe` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `ordem` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `equipe`
--

INSERT INTO `equipe` (`id`, `nome`, `cargo`, `foto`, `ordem`) VALUES
(12, 'Guilherme Martins', 'Programador', 'equipe_20161129212712_guilherme-martinsgui.jpg', '4'),
(13, 'Luiz Eduardo Doná', 'Diretor', 'equipe_20161129213636_luiz-eduardo-donaluiz.jpg', '0'),
(11, 'Luiz Eduardo Doná Filho', 'Diretor de Criação', 'equipe_20161129213543_luiz-eduardo-dona-filhodu.jpg', '5'),
(14, 'Bruno Pereira', 'Atendimento', 'equipe_20161129213704_bruno-pereirabruno.jpg', '1'),
(15, 'Natalie Amabille Boregio', 'Atendimento', 'equipe_20161129213724_natalie-amabille-boregionat.jpg', '2'),
(16, 'Jair Canassa', 'Financeiro', 'equipe_20161129213749_jair-canassajair.jpg', '3'),
(17, 'Marcos Paulo Telles', 'Designer', 'equipe_20161129213842_marcos-paulo-tellesmp.jpg', '6'),
(18, 'Marcelo Gasparini', 'Designer', 'equipe_20161129213903_marcelo-gasparinimarcelo.jpg', '7'),
(19, 'Michelle A. Imamura', 'Designer', 'equipe_20161129213934_michelle-a.-imamuramichelle.jpg', '8'),
(20, 'Nelson Junior', 'Designer', 'equipe_20161129213944_nelson-juniornelson.jpg', '9'),
(21, 'Luara Adonis', 'Redação / Planejamento', 'equipe_20161129214009_luara-adonisluara.jpg', '10'),
(22, 'Tammy Arielle Costa', 'Redação / Planejamento', 'equipe_20161129214022_tammy-arielle-costatammy.jpg', '11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pecas`
--

CREATE TABLE `pecas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pecas`
--

INSERT INTO `pecas` (`id`, `titulo`) VALUES
(1, 'Sites'),
(2, 'Fanpages'),
(3, 'Aplicativos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `popups`
--

CREATE TABLE `popups` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `popup` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `popups`
--

INSERT INTO `popups` (`id`, `titulo`, `popup`) VALUES
(2, 'Bem Vindo', 'age_popup_20161021171434_popup.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `permissoes` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `status`, `nome`, `email`, `senha`, `permissoes`) VALUES
(3, 1, 'AGe', 'artefinal@stilluspropaganda.com', '202cb962ac59075b964b07152d234b70', '35,36,27,30,28,29'),
(2, 1, 'Guilherme', 'guilherme@stilluspropaganda.com', '202cb962ac59075b964b07152d234b70', '35,37,38,36,39,41,40,42,27,29,30,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,1,2,4,3'),
(4, 1, 'Henrique', 'henrique@hfsis.com', '343885bdf7321d5d792e5d60307cccd4', '35,37,38,36,39,41,40,42,27,29,30,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,1,2,4,3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_modulos`
--

CREATE TABLE `users_modulos` (
  `id` int(11) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `exibir` int(11) NOT NULL DEFAULT '0',
  `ordem` int(11) NOT NULL DEFAULT '0',
  `nome` varchar(250) NOT NULL,
  `modulo` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users_modulos`
--

INSERT INTO `users_modulos` (`id`, `parent`, `exibir`, `ordem`, `nome`, `modulo`) VALUES
(1, 0, 1, 96, 'Utilizadores', 'users'),
(2, 1, 1, 97, 'Novo Utilizador', 'cadastrar-users'),
(3, 1, 1, 99, 'Editar Utilizador', 'editar-users'),
(4, 1, 1, 98, 'Listar Utilizadores', 'listar-users'),
(27, 0, 1, 8, 'O Time', 'equipe'),
(28, 27, 1, 10, 'Ver Escalação', 'listar-equipe'),
(29, 27, 1, 9, 'Contratação', 'cadastrar-equipe'),
(30, 27, 1, 11, 'Escalação', 'editar-equipe'),
(35, 0, 1, 0, 'Popup', 'popups'),
(36, 35, 1, 3, 'Editar Popup', 'editar-popups'),
(37, 35, 1, 1, 'Cadastrar Popup', 'cadastrar-popups'),
(38, 35, 1, 2, 'Listar Popups', 'listar-popups'),
(39, 0, 1, 4, 'Banners', 'banners'),
(40, 39, 1, 6, 'Listar Banners', 'listar-banner'),
(41, 39, 1, 5, 'Cadastrar Banner', 'cadastrar-banner'),
(42, 39, 1, 7, 'Editar Banner', 'editar-banner'),
(43, 0, 1, 12, 'Depoimentos', 'depoimentos'),
(44, 43, 1, 13, 'Cadastrar Depoimento', 'cadastrar-depoimentos'),
(45, 43, 1, 14, 'Listar Depoimentos', 'listar-depoimentos'),
(46, 43, 1, 15, 'Editar Depoimento', 'editar-depoimentos'),
(47, 0, 1, 16, 'Clientes', 'clientes'),
(48, 47, 1, 17, 'Cadastrar Clientes', 'cadastrar-clientes'),
(49, 47, 1, 18, 'Listar Clientes', 'listar-clientes'),
(50, 47, 1, 19, 'Editar Clientes', 'editar-clientes'),
(51, 0, 1, 20, 'Campanha', 'campanha'),
(52, 51, 1, 21, 'Cadastrar Campanha', 'cadastrar-campanha'),
(53, 51, 1, 21, 'Listar Campanha', 'listar-campanha'),
(54, 51, 1, 21, 'Editar Campanha', 'editar-campanha'),
(55, 0, 1, 22, 'Peças', 'pecas'),
(56, 55, 1, 23, 'Cadastrar Peças', 'cadastrar-pecas'),
(57, 55, 1, 24, 'Listar Peças', 'listar-pecas'),
(58, 55, 1, 25, 'Editar Peças', 'editar-pecas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campanha`
--
ALTER TABLE `campanha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campanha_imagens`
--
ALTER TABLE `campanha_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depoimentos`
--
ALTER TABLE `depoimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipe`
--
ALTER TABLE `equipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pecas`
--
ALTER TABLE `pecas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popups`
--
ALTER TABLE `popups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_modulos`
--
ALTER TABLE `users_modulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modulo` (`modulo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `campanha`
--
ALTER TABLE `campanha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `campanha_imagens`
--
ALTER TABLE `campanha_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `depoimentos`
--
ALTER TABLE `depoimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `equipe`
--
ALTER TABLE `equipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `pecas`
--
ALTER TABLE `pecas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `popups`
--
ALTER TABLE `popups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_modulos`
--
ALTER TABLE `users_modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
