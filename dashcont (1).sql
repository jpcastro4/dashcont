-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Set-2017 às 15:16
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

--
-- Extraindo dados da tabela `bloqueios`
--

INSERT INTO `bloqueios` (`bloqueioID`, `bloqueioIdt`, `bloqueioMsg`, `bloqueioAlertaEmail`, `bloqueioAlertaSms`, `bloqueioAlertaPush`) VALUES
(1, 'Inadinplencia', 'Favor entrar em contato com o escritório para esclarecimentos.', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `clienteID` int(11) NOT NULL,
  `clienteStatus` int(11) NOT NULL DEFAULT '0',
  `clienteCpfCnpj` varchar(15) CHARACTER SET utf8 NOT NULL,
  `clienteNomeRazao` varchar(100) CHARACTER SET utf8 NOT NULL,
  `clienteCelular` varchar(12) CHARACTER SET utf8 NOT NULL,
  `clienteEmailPrinc` varchar(50) CHARACTER SET utf8 NOT NULL,
  `clienteEmailSec` text CHARACTER SET utf8,
  `clienteDataUltAlt` date NOT NULL,
  `clienteNotifSms` int(11) NOT NULL DEFAULT '1',
  `clienteNotifEmail` int(11) NOT NULL DEFAULT '1',
  `clienteNotifPush` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`clienteID`, `clienteStatus`, `clienteCpfCnpj`, `clienteNomeRazao`, `clienteCelular`, `clienteEmailPrinc`, `clienteEmailSec`, `clienteDataUltAlt`, `clienteNotifSms`, `clienteNotifEmail`, `clienteNotifPush`) VALUES
(1, 0, '14926394000118', 'DIFFERENCE MARKETING E INFORMATICA LTDA - ME', '62982752049', 'jp@grupodifference.com', NULL, '2017-09-08', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes_arquivo`
--

CREATE TABLE `clientes_arquivo` (
  `arquivoID` int(11) NOT NULL,
  `clienteID` int(11) NOT NULL,
  `arquivoAwsKey` varchar(100) NOT NULL,
  `arquivoNome` varchar(100) NOT NULL,
  `arquivoCaminho` text NOT NULL,
  `arquivoDataEnvio` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes_arquivo`
--

INSERT INTO `clientes_arquivo` (`arquivoID`, `clienteID`, `arquivoAwsKey`, `arquivoNome`, `arquivoCaminho`, `arquivoDataEnvio`) VALUES
(1, 1, '729d3b5246cfb15059d6d780bb3e0c1c8', 'ServiceLogin.htm', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/729d3b5246cfb15059d6d780bb3e0c1c8', '2017-09-11 12:04:08'),
(2, 1, '56170012e5de59992ecb733c7fbea94912', 'ServiceLogin (1).htm', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/56170012e5de59992ecb733c7fbea94912', '2017-09-11 12:04:14'),
(3, 1, '729d3b5246cfb15059d6d780bb3e0c1c9', 'Contrato Social', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/729d3b5246cfb15059d6d780bb3e0c1c9', '2017-09-11 12:07:31'),
(4, 1, '729d3b5246cfb15059d6d780bb3e0c1c14', 'Teste 3', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/729d3b5246cfb15059d6d780bb3e0c1c14', '2017-09-11 12:20:58'),
(5, 1, '56170012e5de59992ecb733c7fbea94915', 'Test 4', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/56170012e5de59992ecb733c7fbea94915', '2017-09-11 12:27:09'),
(6, 1, '729d3b5246cfb15059d6d780bb3e0c1c5', 'Mais um', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/729d3b5246cfb15059d6d780bb3e0c1c5', '2017-09-11 12:28:21'),
(7, 1, '56170012e5de59992ecb733c7fbea9499', 'Outro', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/56170012e5de59992ecb733c7fbea9499', '2017-09-11 12:30:49'),
(8, 1, '729d3b5246cfb15059d6d780bb3e0c1c6', 'Credo', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/729d3b5246cfb15059d6d780bb3e0c1c6', '2017-09-11 12:32:30'),
(9, 1, '7131aeeb9a8afc2bca20f652d938efc112', 'FOLDER TRIOTICA copiar.pdf', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/7131aeeb9a8afc2bca20f652d938efc112', '2017-09-11 12:42:10'),
(10, 1, '729d3b5246cfb15059d6d780bb3e0c1c12', 'Teste loading', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/729d3b5246cfb15059d6d780bb3e0c1c12', '2017-09-11 13:29:04'),
(11, 1, '56170012e5de59992ecb733c7fbea94914', 'teste bill', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/56170012e5de59992ecb733c7fbea94914', '2017-09-11 13:32:46'),
(12, 1, '56170012e5de59992ecb733c7fbea94910', 'bill 2', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/56170012e5de59992ecb733c7fbea94910', '2017-09-11 13:33:42'),
(13, 1, '729d3b5246cfb15059d6d780bb3e0c1c6', 'bill 1', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/729d3b5246cfb15059d6d780bb3e0c1c6', '2017-09-11 13:33:46'),
(14, 1, '729d3b5246cfb15059d6d780bb3e0c1c11', 'bill 1', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/729d3b5246cfb15059d6d780bb3e0c1c11', '2017-09-11 13:38:40'),
(15, 1, '56170012e5de59992ecb733c7fbea9499', 'bill 2', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/56170012e5de59992ecb733c7fbea9499', '2017-09-11 13:38:49'),
(16, 1, '729d3b5246cfb15059d6d780bb3e0c1c13', 'ServiceLogin.htm', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/729d3b5246cfb15059d6d780bb3e0c1c13', '2017-09-11 13:38:54'),
(17, 1, '729d3b5246cfb15059d6d780bb3e0c1c13', 'ServiceLogin.htm', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/729d3b5246cfb15059d6d780bb3e0c1c13', '2017-09-11 13:48:10'),
(18, 1, '56170012e5de59992ecb733c7fbea94912', 'ServiceLogin (1).htm', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/56170012e5de59992ecb733c7fbea94912', '2017-09-11 13:48:16'),
(19, 1, '729d3b5246cfb15059d6d780bb3e0c1c12', 'ServiceLogin.htm', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/729d3b5246cfb15059d6d780bb3e0c1c12', '2017-09-11 17:10:12');

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
  `clienteID` int(11) NOT NULL,
  `docNome` varchar(200) NOT NULL,
  `docStatus` int(11) NOT NULL DEFAULT '0',
  `docDataUltAlt` datetime NOT NULL,
  `docRec` int(11) NOT NULL DEFAULT '0',
  `docCompetencia` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`docID`, `clienteID`, `docNome`, `docStatus`, `docDataUltAlt`, `docRec`, `docCompetencia`) VALUES
(1, 1, 'Contracheques', 0, '2017-09-12 22:33:09', 0, '2017-09'),
(2, 1, 'Honorarios', 0, '2017-09-12 22:33:10', 1, '2017-09'),
(3, 1, 'GPS', 0, '2017-09-12 22:35:14', 1, '2017-09'),
(4, 1, 'Simples Nacional', 0, '2017-09-12 22:37:04', 1, '2017-09'),
(5, 1, 'Documento teste', 0, '2017-09-13 14:35:40', 1, '2017-09'),
(6, 1, 'ROTINAS.txt', 0, '2017-09-13 14:41:21', 1, '2017-10'),
(7, 1, 'PREGAÇÃO DOMINGO.txt', 0, '2017-09-13 14:42:17', 1, '2017-09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos_tags`
--

CREATE TABLE `documentos_tags` (
  `docTagRel` int(11) NOT NULL,
  `docID` int(11) NOT NULL,
  `tagID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `documentos_tags`
--

INSERT INTO `documentos_tags` (`docTagRel`, `docID`, `tagID`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 2, 2),
(4, 3, 1),
(5, 3, 2),
(6, 4, 1),
(7, 5, 1),
(8, 5, 2),
(9, 6, 2),
(10, 7, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos_versao`
--

CREATE TABLE `documentos_versao` (
  `docVrsID` int(11) NOT NULL,
  `docID` int(11) NOT NULL,
  `docVrsAwsKey` varchar(200) NOT NULL,
  `docVrsCaminho` varchar(300) NOT NULL,
  `docVrsDataEnvio` datetime NOT NULL,
  `docVrsOpens` int(11) NOT NULL DEFAULT '0',
  `docVrsPrints` int(11) NOT NULL DEFAULT '0',
  `docVrsVenc` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `documentos_versao`
--

INSERT INTO `documentos_versao` (`docVrsID`, `docID`, `docVrsAwsKey`, `docVrsCaminho`, `docVrsDataEnvio`, `docVrsOpens`, `docVrsPrints`, `docVrsVenc`) VALUES
(1, 1, 'cd282947dda1e5ff11f414c5eca04c4113', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/cd282947dda1e5ff11f414c5eca04c4113', '2017-09-12 22:33:09', 0, 0, '2017-09-15 00:00:00'),
(2, 2, 'cd282947dda1e5ff11f414c5eca04c4110', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/cd282947dda1e5ff11f414c5eca04c4110', '2017-09-12 22:33:10', 0, 0, '2017-09-27 00:00:00'),
(3, 3, 'cd282947dda1e5ff11f414c5eca04c4115', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/cd282947dda1e5ff11f414c5eca04c4115', '2017-09-12 22:35:14', 0, 0, '2017-09-12 00:00:00'),
(4, 4, 'cd282947dda1e5ff11f414c5eca04c4111', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/cd282947dda1e5ff11f414c5eca04c4111', '2017-09-12 22:37:04', 0, 0, '2017-09-27 00:00:00'),
(5, 5, 'e42b2e5f3d3bb7c5580078f0c46de54d6', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/e42b2e5f3d3bb7c5580078f0c46de54d6', '2017-09-13 14:35:40', 0, 0, '2017-09-29 00:00:00'),
(6, 6, 'f03cfcd54227aa0e1af4d8c02e96509512', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/f03cfcd54227aa0e1af4d8c02e96509512', '2017-09-13 14:41:21', 0, 0, '2017-10-13 00:00:00'),
(7, 7, '9877ada13b777330fc414f5dd60db9da7', 'https://dashcont.s3-sa-east-1.amazonaws.com/14926394000118/9877ada13b777330fc414f5dd60db9da7', '2017-09-13 14:42:17', 0, 0, '2017-10-21 00:00:00');

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
-- Extraindo dados da tabela `tags`
--

INSERT INTO `tags` (`tagID`, `tagNome`, `tagUrl`, `tagCor`) VALUES
(1, 'Federal', 'federal', '#ff0000'),
(2, 'Estadual', 'estadual', '#008000');

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
  MODIFY `bloqueioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `clienteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `clientes_arquivo`
--
ALTER TABLE `clientes_arquivo`
  MODIFY `arquivoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `clientes_notif`
--
ALTER TABLE `clientes_notif`
  MODIFY `notifID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `docID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `documentos_tags`
--
ALTER TABLE `documentos_tags`
  MODIFY `docTagRel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `documentos_versao`
--
ALTER TABLE `documentos_versao`
  MODIFY `docVrsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sys_notif_control`
--
ALTER TABLE `sys_notif_control`
  MODIFY `notifSendID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
