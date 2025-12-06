-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/08/2025 às 16:00
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestao_escolar`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL,
  `nome_aluno` varchar(50) DEFAULT NULL,
  `sobrenome_aluno` varchar(50) DEFAULT NULL,
  `bi_aluno` varchar(14) DEFAULT NULL,
  `email_aluno` varchar(50) DEFAULT NULL,
  `numero_matricula_aluno` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `provincia_regidencia` varchar(50) DEFAULT NULL,
  `municipio_regidencia` varchar(50) DEFAULT NULL,
  `bairro_regidencia` varchar(50) DEFAULT NULL,
  `senha_hash` varchar(255) DEFAULT NULL,
  `status_aluno` varchar(100) DEFAULT 'Activo',
  `id_turma` int(11) NOT NULL,
  `criado_em` datetime DEFAULT current_timestamp(),
  `img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome_aluno`, `sobrenome_aluno`, `bi_aluno`, `email_aluno`, `numero_matricula_aluno`, `telefone`, `provincia_regidencia`, `municipio_regidencia`, `bairro_regidencia`, `senha_hash`, `status_aluno`, `id_turma`, `criado_em`, `img`) VALUES
(7, 'Gabriel', 'Pedro', '005544354BO032', 'gabrielpedroaurelio@gmail.com', '5500', '934519321', 'Icole e Bengo', 'Kifangondo', 'Anjos', NULL, 'Frequentando', 1, '2025-08-19 21:27:07', '../../assets/_uploads/fotosAlunos/Gabriel005544354BO032.jpg'),
(8, 'Erneto', 'Buka', '003243542354LA', 'erneto@gmail.com', '5503', '936355102', 'Icole e Bengo', 'Funda', 'Casas Novas', NULL, 'Frequentando', 1, '2025-08-19 21:44:44', '../../assets/_uploads/fotosAlunos/Erneto003243542354LA045.jpg'),
(9, 'Erneto', 'Buka', '033542354LA045', 'erneto@gmail.com', '5503', '936355102', 'Icole e Bengo', 'Funda', 'Casas Novas', NULL, 'Frequentando', 1, '2025-08-19 21:49:50', '../../assets/_uploads/fotosAlunos/Erneto033542354LA045.jpg'),
(10, 'Aguinaldo', 'Arnaldo', '123456789LA098', 'aguinaldo@gmail.com', '453578', '93243243', 'Luanda', 'Vidrul', ' Osso', NULL, 'Frequentando', 1, '2025-08-20 10:52:07', '../../assets/_uploads/fotosAlunos/Aguinaldo123456789LA098.jpg'),
(11, 'Aylton', 'Dinis', '123456789LA323', 'aylton@gmail.com', '4535783', '93243232', 'Bengo', 'Dande', 'Panguila', NULL, 'Finalista', 1, '2025-08-20 13:41:14', '../../assets/_uploads/fotosAlunos/Aylton123456789LA323.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `area_formacao`
--

CREATE TABLE `area_formacao` (
  `id_area_formacao` int(11) NOT NULL,
  `area_formacao` varchar(100) DEFAULT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `area_formacao`
--

INSERT INTO `area_formacao` (`id_area_formacao`, `area_formacao`, `criado_em`) VALUES
(1, 'Informática', '2025-08-19 20:33:24'),
(2, 'Administração ', '2025-08-19 20:33:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `boletim`
--

CREATE TABLE `boletim` (
  `id_boletim` int(11) NOT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `data_emissao` datetime DEFAULT current_timestamp(),
  `id_turma` int(11) DEFAULT NULL,
  `media_final_boletim` decimal(2,1) DEFAULT NULL,
  `numero_escola` int(11) DEFAULT NULL,
  `id_funcionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `classe`
--

CREATE TABLE `classe` (
  `id_classe` int(11) NOT NULL,
  `classe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `classe`
--

INSERT INTO `classe` (`id_classe`, `classe`) VALUES
(1, 10),
(2, 11),
(3, 12),
(4, 13);

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `curso` varchar(100) DEFAULT NULL,
  `id_area_formacao` int(11) NOT NULL,
  `duracao` int(11) DEFAULT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `curso`, `id_area_formacao`, `duracao`, `criado_em`) VALUES
(1, 'Informática ', 1, 4, '2025-08-19 20:34:49'),
(2, 'Informática de Gestão', 1, 4, '2025-08-19 20:34:49'),
(3, 'Contabilidade Empresarial', 2, 4, '2025-08-19 20:34:49'),
(4, 'Gestão Empresal', 2, 4, '2025-08-19 20:34:49');

-- --------------------------------------------------------

--
-- Estrutura para tabela `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(11) NOT NULL,
  `departamento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `departamento`) VALUES
(1, 'Administrativo'),
(2, 'Pedagogico'),
(3, 'Financeiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `id_disciplina` int(11) NOT NULL,
  `nome_disciplina` varchar(100) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `documento`
--

CREATE TABLE `documento` (
  `id_documento` int(11) NOT NULL,
  `tipo_documento` varchar(55) DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  `data_emissao` datetime DEFAULT current_timestamp(),
  `caminho_arquivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `escola`
--

CREATE TABLE `escola` (
  `numero_escola` int(11) NOT NULL,
  `nome_escola` varchar(200) DEFAULT NULL,
  `categoria` enum('Ensino Médio','Ensino Superior') DEFAULT 'Ensino Médio',
  `provincia_localizacao` varchar(50) DEFAULT NULL,
  `municipio_localizacao` varchar(50) DEFAULT NULL,
  `bairro_localizacao` varchar(50) DEFAULT NULL,
  `id_funcionario_derectorPedagogico` int(11) NOT NULL,
  `id_funcionario_derector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `falta_aluno`
--

CREATE TABLE `falta_aluno` (
  `id_falta` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `data_falta` date NOT NULL,
  `justificada` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `falta_professor`
--

CREATE TABLE `falta_professor` (
  `id_falta_professor` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `data_falta` date NOT NULL,
  `justificada` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id_funcionario` int(11) NOT NULL,
  `bilhete_funcionario` varchar(14) DEFAULT NULL,
  `nome_funcionario` varchar(50) DEFAULT NULL,
  `sobrenome_funcionario` varchar(50) DEFAULT NULL,
  `email_funcionario` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `provincia_regidencia` varchar(50) DEFAULT NULL,
  `municipio_regidencia` varchar(50) DEFAULT NULL,
  `bairro_regidencia` varchar(50) DEFAULT NULL,
  `senha_hash` varchar(255) DEFAULT NULL,
  `status_aluno` varchar(100) DEFAULT 'Activo',
  `descricao` text DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico`
--

CREATE TABLE `historico` (
  `id_historico` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `tabela` varchar(100) NOT NULL,
  `id_dado` int(11) DEFAULT NULL,
  `acao` enum('Inserir','Actualizar','Deletar') DEFAULT NULL,
  `dados_anteriore` text DEFAULT NULL,
  `dados_novos` text DEFAULT NULL,
  `data_hora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_login`
--

CREATE TABLE `historico_login` (
  `id_historico_login` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `hora_entrada` datetime DEFAULT current_timestamp(),
  `hora_saida` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro`
--

CREATE TABLE `livro` (
  `id_livro` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `editora` varchar(100) NOT NULL,
  `id_funcionario` int(11) DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `caminho_arquivo` text DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `data_upload` datetime DEFAULT current_timestamp(),
  `autor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livro`
--

INSERT INTO `livro` (`id_livro`, `titulo`, `editora`, `id_funcionario`, `id_aluno`, `caminho_arquivo`, `id_categoria`, `data_upload`, `autor`) VALUES
(1, 'Desconhecido', 'Desconhecido', NULL, NULL, '../../assets/_uploads/livros/68a5ae94696c6DC-82-s-Po-TPO.pdf', NULL, '2025-08-20 12:16:36', 'Desconhecido'),
(2, 'Desconhecido', 'Desconhecido', NULL, NULL, '../../assets/_uploads/livros/68a5b07f98a3aFicha de inscrição do Hélder.pdf', NULL, '2025-08-20 12:24:47', 'Desconhecido'),
(3, 'Desconhecido', 'Desconhecido', NULL, NULL, '../../assets/_uploads/livros/68a5b0846a3f3Ficha de inscrição do Hélder.pdf', NULL, '2025-08-20 12:24:52', 'Desconhecido'),
(4, 'Desconhecido', 'Desconhecido', NULL, NULL, '../../assets/_uploads/livros/68a5b969f0b0dCurriculum Vitae Aylton.pdf', NULL, '2025-08-20 13:02:49', 'Desconhecido'),
(5, 'Desconhecido', 'Desconhecido', NULL, NULL, '../../assets/_uploads/livros/68a5b9a1c941cPrograma de Reunião Maio e Junho PDF.pdf', NULL, '2025-08-20 13:03:45', 'Desconhecido');

-- --------------------------------------------------------

--
-- Estrutura para tabela `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `id_professor` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL,
  `tipo_avaliacao` enum('Prova','Trabalho','Teste','Oral') NOT NULL,
  `valor_nota` decimal(5,2) DEFAULT NULL,
  `data_lancamento` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL,
  `periodo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `periodo`) VALUES
(1, 'Manhã'),
(2, 'Tarde'),
(3, 'Noite');

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor_disciplina`
--

CREATE TABLE `professor_disciplina` (
  `id_professor_disciplina` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_disciplina` int(11) NOT NULL,
  `id_turma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sala`
--

CREATE TABLE `sala` (
  `id_sala` int(11) NOT NULL,
  `numero_sala` tinyint(4) DEFAULT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `capacidade_de_alunos` int(11) DEFAULT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sala`
--

INSERT INTO `sala` (`id_sala`, `numero_sala`, `localizacao`, `capacidade_de_alunos`, `criado_em`) VALUES
(1, 1, 'Primeiro Corredor', 60, '2025-08-19 20:37:44'),
(2, 2, 'Primeiro Corredor', 60, '2025-08-19 20:37:44'),
(3, 3, 'Primeiro Corredor', 60, '2025-08-19 20:37:44'),
(4, 4, 'Primeiro Corredor', 60, '2025-08-19 20:37:44'),
(5, 5, 'Primeiro Corredor', 60, '2025-08-19 20:37:44'),
(6, 6, 'Primeiro Corredor', 60, '2025-08-19 20:37:44'),
(7, 7, 'Primeiro Corredor', 60, '2025-08-19 20:37:44'),
(8, 8, 'Segundo Corredor', 60, '2025-08-19 20:37:44'),
(9, 9, 'Segundo Corredor', 60, '2025-08-19 20:37:44'),
(10, 10, 'Segundo Corredor', 60, '2025-08-19 20:37:44'),
(11, 11, 'Segundo Corredor', 60, '2025-08-19 20:37:44'),
(12, 12, 'Segundo Corredor', 60, '2025-08-19 20:37:44');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `id_turma` int(11) NOT NULL,
  `turma` varchar(30) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `ano` year(4) DEFAULT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`id_turma`, `turma`, `id_sala`, `id_curso`, `id_classe`, `id_periodo`, `ano`, `criado_em`) VALUES
(1, '03IG12T24', 3, 2, 3, 2, '2025', '2025-08-19 21:18:50');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD UNIQUE KEY `bi_aluno` (`bi_aluno`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `area_formacao`
--
ALTER TABLE `area_formacao`
  ADD PRIMARY KEY (`id_area_formacao`);

--
-- Índices de tabela `boletim`
--
ALTER TABLE `boletim`
  ADD PRIMARY KEY (`id_boletim`),
  ADD KEY `id_funcionario` (`id_funcionario`),
  ADD KEY `numero_escola` (`numero_escola`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices de tabela `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_classe`);

--
-- Índices de tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `id_area_formacao` (`id_area_formacao`);

--
-- Índices de tabela `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Índices de tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`id_disciplina`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices de tabela `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_funcionario` (`id_funcionario`);

--
-- Índices de tabela `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`numero_escola`),
  ADD KEY `id_funcionario_derectorPedagogico` (`id_funcionario_derectorPedagogico`),
  ADD KEY `id_funcionario_derector` (`id_funcionario_derector`);

--
-- Índices de tabela `falta_aluno`
--
ALTER TABLE `falta_aluno`
  ADD PRIMARY KEY (`id_falta`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `falta_professor`
--
ALTER TABLE `falta_professor`
  ADD PRIMARY KEY (`id_falta_professor`),
  ADD KEY `id_funcionario` (`id_funcionario`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id_funcionario`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Índices de tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id_historico`),
  ADD KEY `id_funcionario` (`id_funcionario`);

--
-- Índices de tabela `historico_login`
--
ALTER TABLE `historico_login`
  ADD PRIMARY KEY (`id_historico_login`),
  ADD KEY `id_funcionario` (`id_funcionario`);

--
-- Índices de tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`id_livro`),
  ADD KEY `id_funcionario` (`id_funcionario`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices de tabela `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `id_professor` (`id_professor`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Índices de tabela `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  ADD PRIMARY KEY (`id_professor_disciplina`),
  ADD KEY `id_funcionario` (`id_funcionario`),
  ADD KEY `id_disciplina` (`id_disciplina`),
  ADD KEY `id_turma` (`id_turma`);

--
-- Índices de tabela `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id_sala`);

--
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id_turma`),
  ADD UNIQUE KEY `turma` (`turma`),
  ADD KEY `id_sala` (`id_sala`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_periodo` (`id_periodo`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `area_formacao`
--
ALTER TABLE `area_formacao`
  MODIFY `id_area_formacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `boletim`
--
ALTER TABLE `boletim`
  MODIFY `id_boletim` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `classe`
--
ALTER TABLE `classe`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `id_disciplina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `documento`
--
ALTER TABLE `documento`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `escola`
--
ALTER TABLE `escola`
  MODIFY `numero_escola` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `falta_aluno`
--
ALTER TABLE `falta_aluno`
  MODIFY `id_falta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `falta_professor`
--
ALTER TABLE `falta_professor`
  MODIFY `id_falta_professor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id_historico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_login`
--
ALTER TABLE `historico_login`
  MODIFY `id_historico_login` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  MODIFY `id_professor_disciplina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sala`
--
ALTER TABLE `sala`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `id_turma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`);

--
-- Restrições para tabelas `boletim`
--
ALTER TABLE `boletim`
  ADD CONSTRAINT `boletim_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  ADD CONSTRAINT `boletim_ibfk_2` FOREIGN KEY (`numero_escola`) REFERENCES `escola` (`numero_escola`),
  ADD CONSTRAINT `boletim_ibfk_3` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  ADD CONSTRAINT `boletim_ibfk_4` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`);

--
-- Restrições para tabelas `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`id_area_formacao`) REFERENCES `area_formacao` (`id_area_formacao`);

--
-- Restrições para tabelas `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Restrições para tabelas `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  ADD CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`);

--
-- Restrições para tabelas `escola`
--
ALTER TABLE `escola`
  ADD CONSTRAINT `escola_ibfk_1` FOREIGN KEY (`id_funcionario_derectorPedagogico`) REFERENCES `funcionario` (`id_funcionario`),
  ADD CONSTRAINT `escola_ibfk_2` FOREIGN KEY (`id_funcionario_derector`) REFERENCES `funcionario` (`id_funcionario`);

--
-- Restrições para tabelas `falta_aluno`
--
ALTER TABLE `falta_aluno`
  ADD CONSTRAINT `falta_aluno_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  ADD CONSTRAINT `falta_aluno_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  ADD CONSTRAINT `falta_aluno_ibfk_3` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`);

--
-- Restrições para tabelas `falta_professor`
--
ALTER TABLE `falta_professor`
  ADD CONSTRAINT `falta_professor_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  ADD CONSTRAINT `falta_professor_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  ADD CONSTRAINT `falta_professor_ibfk_3` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`);

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`);

--
-- Restrições para tabelas `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`);

--
-- Restrições para tabelas `historico_login`
--
ALTER TABLE `historico_login`
  ADD CONSTRAINT `historico_login_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`);

--
-- Restrições para tabelas `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `livro_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  ADD CONSTRAINT `livro_ibfk_2` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  ADD CONSTRAINT `livro_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Restrições para tabelas `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  ADD CONSTRAINT `nota_ibfk_3` FOREIGN KEY (`id_professor`) REFERENCES `funcionario` (`id_funcionario`),
  ADD CONSTRAINT `nota_ibfk_4` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`);

--
-- Restrições para tabelas `professor_disciplina`
--
ALTER TABLE `professor_disciplina`
  ADD CONSTRAINT `professor_disciplina_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id_funcionario`),
  ADD CONSTRAINT `professor_disciplina_ibfk_2` FOREIGN KEY (`id_disciplina`) REFERENCES `disciplina` (`id_disciplina`),
  ADD CONSTRAINT `professor_disciplina_ibfk_3` FOREIGN KEY (`id_turma`) REFERENCES `turma` (`id_turma`);

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id_sala`),
  ADD CONSTRAINT `turma_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`),
  ADD CONSTRAINT `turma_ibfk_3` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `turma_ibfk_4` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
