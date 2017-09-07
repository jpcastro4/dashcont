-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07-Set-2017 às 16:39
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dashcont`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm`
--

CREATE TABLE `adm` (
  `admID` int(11) NOT NULL,
  `admNome` varchar(100) CHARACTER SET utf8 NOT NULL,
  `admEmail` varchar(100) CHARACTER SET utf8 NOT NULL,
  `admSenha` varchar(50) CHARACTER SET utf8 NOT NULL,
  `admUltAcesso` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_doc_log`
--

CREATE TABLE `adm_doc_log` (
  `docLogID` int(11) NOT NULL,
  `docLogUser` int(11) NOT NULL,
  `docLogDocID` int(11) NOT NULL,
  `docLogAcao` varchar(100) NOT NULL,
  `docLogDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_notif`
--

CREATE TABLE `adm_notif` (
  `admNotifID` int(11) NOT NULL,
  `admNotifData` int(11) NOT NULL,
  `clienteID` int(11) NOT NULL,
  `admNotifArquivar` int(11) NOT NULL,
  `admNotifLink` varchar(100) DEFAULT NULL,
  `admNotifUsrClick` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bloqueios`
--

CREATE TABLE `bloqueios` (
  `bloqueioID` int(11) NOT NULL,
  `bloqueioIdt` varchar(100) CHARACTER SET utf8 NOT NULL,
  `bloqueioMsg` varchar(300) CHARACTER SET utf8 NOT NULL,
  `bloqueioAlertaEmail` int(11) NOT NULL DEFAULT '1',
  `bloqueioAlertaSms` int(11) NOT NULL DEFAULT '0',
  `bloqueioAlertaPush` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `clienteID` int(11) NOT NULL,
  `clienteStatus` int(11) NOT NULL DEFAULT '0',
  `clienteCpfCnpj` int(15) NOT NULL,
  `clienteNomeRazao` varchar(100) CHARACTER SET utf8 NOT NULL,
  `clienteCelular` varchar(12) CHARACTER SET utf8 NOT NULL,
  `clienteEmailPrinc` varchar(50) CHARACTER SET utf8 NOT NULL,
  `clienteEmailSec` text CHARACTER SET utf8,
  `clienteDataUltAlt` date NOT NULL,
  `clienteNotifSms` int(11) NOT NULL DEFAULT '1',
  `clienteNotifEmail` int(11) NOT NULL DEFAULT '1',
  `clienteNotifPush` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes_arquivo`
--

CREATE TABLE `clientes_arquivo` (
  `arquivoID` int(11) NOT NULL,
  `clienteID` int(11) NOT NULL,
  `arquivoNome` varchar(100) NOT NULL,
  `arquivoDataEnvio` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes_notif`
--

CREATE TABLE `clientes_notif` (
  `notifID` int(11) NOT NULL,
  `clienteID` int(11) NOT NULL,
  `notifData` date NOT NULL,
  `notifTexto` varchar(100) NOT NULL,
  `notifLink` varchar(200) NOT NULL,
  `notifClick` int(11) NOT NULL DEFAULT '0',
  `notifArquivar` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `docID` int(11) NOT NULL,
  `docCaminho` varchar(300) NOT NULL,
  `docNome` varchar(200) NOT NULL,
  `docStatus` int(11) NOT NULL DEFAULT '0',
  `docDataUltAlt` date NOT NULL,
  `docRec` int(11) NOT NULL DEFAULT '0',
  `docCompetencia` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos_tags`
--

CREATE TABLE `documentos_tags` (
  `docTagRel` int(11) NOT NULL,
  `docID` int(11) NOT NULL,
  `tagID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos_versao`
--

CREATE TABLE `documentos_versao` (
  `docVrsID` int(11) NOT NULL,
  `docID` int(11) NOT NULL,
  `docVrsDataEnvio` date NOT NULL,
  `docVrsOpens` int(11) NOT NULL DEFAULT '0',
  `docVrsPrints` int(11) NOT NULL DEFAULT '0',
  `docVrsVenc` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sys_notif_control`
--

CREATE TABLE `sys_notif_control` (
  `notifSendID` int(11) NOT NULL,
  `notifID` int(11) NOT NULL,
  `notifTipo` int(11) NOT NULL,
  `notifData` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tags`
--

CREATE TABLE `tags` (
  `tagID` int(11) NOT NULL,
  `tagNome` varchar(50) CHARACTER SET utf8 NOT NULL,
  `tagUrl` varchar(50) NOT NULL,
  `tagCor` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`admID`);

--
-- Indexes for table `adm_doc_log`
--
ALTER TABLE `adm_doc_log`
  ADD PRIMARY KEY (`docLogID`);

--
-- Indexes for table `adm_notif`
--
ALTER TABLE `adm_notif`
  ADD PRIMARY KEY (`admNotifID`);

--
-- Indexes for table `bloqueios`
--
ALTER TABLE `bloqueios`
  ADD PRIMARY KEY (`bloqueioID`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`clienteID`);

--
-- Indexes for table `clientes_arquivo`
--
ALTER TABLE `clientes_arquivo`
  ADD PRIMARY KEY (`arquivoID`);

--
-- Indexes for table `clientes_notif`
--
ALTER TABLE `clientes_notif`
  ADD PRIMARY KEY (`notifID`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`docID`);

--
-- Indexes for table `documentos_tags`
--
ALTER TABLE `documentos_tags`
  ADD PRIMARY KEY (`docTagRel`);

--
-- Indexes for table `documentos_versao`
--
ALTER TABLE `documentos_versao`
  ADD PRIMARY KEY (`docVrsID`);

--
-- Indexes for table `sys_notif_control`
--
ALTER TABLE `sys_notif_control`
  ADD PRIMARY KEY (`notifSendID`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adm`
--
ALTER TABLE `adm`
  MODIFY `admID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adm_doc_log`
--
ALTER TABLE `adm_doc_log`
  MODIFY `docLogID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adm_notif`
--
ALTER TABLE `adm_notif`
  MODIFY `admNotifID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bloqueios`
--
ALTER TABLE `bloqueios`
  MODIFY `bloqueioID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `clienteID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clientes_arquivo`
--
ALTER TABLE `clientes_arquivo`
  MODIFY `arquivoID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clientes_notif`
--
ALTER TABLE `clientes_notif`
  MODIFY `notifID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `docID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documentos_tags`
--
ALTER TABLE `documentos_tags`
  MODIFY `docTagRel` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documentos_versao`
--
ALTER TABLE `documentos_versao`
  MODIFY `docVrsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_notif_control`
--
ALTER TABLE `sys_notif_control`
  MODIFY `notifSendID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
