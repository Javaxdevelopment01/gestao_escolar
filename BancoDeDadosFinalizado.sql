create database if not exists gestao_escolar default charset utf8mb4 default collate utf8mb4_general_ci;
use gestao_escolar;
create table sala(
    id_sala int primary key auto_increment,
    numero_sala tinyint,
    localizacao varchar(255),
    capacidade_de_alunos int null,
    criado_em datetime default current_timestamp
)engine InnoDB;
create table classe(
    id_classe int primary key auto_increment,
    classe int
)engine InnoDB;
create table area_formacao(
    id_area_formacao int primary key auto_increment,
    area_formacao varchar(100),
       criado_em datetime default current_timestamp
)engine InnoDB;
create table curso (
    id_curso int primary key auto_increment,
    curso varchar(100),
    id_area_formacao int not null,
    duracao int,
    criado_em datetime default current_timestamp,
    foreign key(id_area_formacao) references area_formacao(id_area_formacao)
)engine InnoDB;
create table periodo(
    id_periodo int primary key auto_increment,
    periodo varchar(50)
)engine InnoDB;
create table turma(
    id_turma int primary key auto_increment,
    turma varchar(30) unique not null,
    id_sala int not null,
    id_curso int not null,
    id_classe int not null,
    id_periodo int not null,
    ano YEAR ,
    criado_em datetime default current_timestamp,
    foreign key(id_sala) references sala(id_sala),#--feito
    foreign key(id_classe) references classe(id_classe),#--feito
    foreign key(id_curso) references curso(id_curso),
    foreign key(id_periodo) references periodo(id_periodo)
)engine InnoDB;
create table aluno(
    id_aluno int primary key auto_increment,
    nome_aluno varchar(50),
    sobrenome_aluno varchar(50),
    email_aluno varchar(50),
    numero_matricula_aluno varchar(50),
    telefone varchar(20),
    provincia_regidencia varchar(50),
    municipio_regidencia varchar(50),
    bairro_regidencia varchar(50),
    senha_hash varchar(255) null,
    status_aluno varchar(100) default "Activo",
    id_turma int not null ,
    criado_em datetime default current_timestamp,
    foreign key(id_turma) references turma(id_turma)
)engine InnoDB;
create table departamento(
    id_departamento int primary key auto_increment,
    departamento varchar(100)
)engine InnoDB;

create table funcionario(
    id_funcionario int  primary key auto_increment,
    bilhete_funcionario varchar(14),
    nome_funcionario varchar(50),
    sobrenome_funcionario varchar(50),
    email_funcionario varchar(50),
    telefone varchar(20),
    provincia_regidencia varchar(50),
    municipio_regidencia varchar(50),
    bairro_regidencia varchar(50),
    senha_hash varchar(255) null,
    status_aluno varchar(100) default "Activo",
    descricao text,
    id_departamento int,
    foreign key(id_departamento) references departamento(id_departamento)
)engine InnoDB;

create table escola(
    numero_escola int primary key auto_increment,
    nome_escola varchar(200),
    categoria enum("Ensino Médio", "Ensino Superior") default "Ensino Médio",
    provincia_localizacao varchar(50),
    municipio_localizacao varchar(50),
    bairro_localizacao varchar(50),
    id_funcionario_derectorPedagogico int not null,#--director pedagogico
    id_funcionario_derector int not null,#--director Geral

    foreign key(id_funcionario_derectorPedagogico)  references funcionario(id_funcionario),
    foreign key(id_funcionario_derector)  references funcionario(id_funcionario)
)engine InnoDB;
create table boletim(
    id_boletim int primary key auto_increment,
    id_aluno int ,
    data_emissao datetime default current_timestamp,
    id_turma int,
    media_final_boletim decimal(2,1),
    numero_escola int,
    id_funcionario int ,#--directora de turma
    FOREIGN KEY (id_funcionario) REFERENCES funcionario(id_funcionario),
    FOREIGN KEY (numero_escola) REFERENCES escola(numero_escola),
    FOREIGN KEY (id_aluno) REFERENCES aluno(id_aluno),
    FOREIGN KEY (id_turma) REFERENCES turma(id_turma)
)engine InnoDB;
CREATE TABLE disciplina (
    id_disciplina INT PRIMARY KEY AUTO_INCREMENT,
    nome_disciplina VARCHAR(100) NOT NULL,
    id_curso INT NOT NULL,
    FOREIGN KEY (id_curso) REFERENCES curso(id_curso)
);
CREATE TABLE professor_disciplina (
    id_professor_disciplina INT PRIMARY KEY AUTO_INCREMENT,
    id_funcionario INT NOT NULL,
    id_disciplina INT NOT NULL,
    id_turma INT NOT NULL,
    FOREIGN KEY (id_funcionario) REFERENCES funcionario(id_funcionario),
    FOREIGN KEY (id_disciplina) REFERENCES disciplina(id_disciplina),
    FOREIGN KEY (id_turma) REFERENCES turma(id_turma)
);
CREATE TABLE nota (
    id_nota INT PRIMARY KEY AUTO_INCREMENT,
    id_aluno INT NOT NULL,
    id_disciplina INT NOT NULL,
    id_professor INT NOT NULL,
    id_turma INT NOT NULL,
    tipo_avaliacao ENUM('Prova', 'Trabalho', 'Teste', 'Oral') NOT NULL,
    valor_nota DECIMAL(5,2),
    data_lancamento DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_aluno) REFERENCES aluno(id_aluno),
    FOREIGN KEY (id_disciplina) REFERENCES disciplina(id_disciplina),
    FOREIGN KEY (id_professor) REFERENCES funcionario(id_funcionario),
    FOREIGN KEY (id_turma) REFERENCES turma(id_turma)
);
CREATE TABLE falta_aluno (
    id_falta INT PRIMARY KEY AUTO_INCREMENT,
    id_aluno INT NOT NULL,
    id_disciplina INT NOT NULL,
    id_turma INT NOT NULL,
    data_falta DATE NOT NULL,
    justificada BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_aluno) REFERENCES aluno(id_aluno),
    FOREIGN KEY (id_disciplina) REFERENCES disciplina(id_disciplina),
    FOREIGN KEY (id_turma) REFERENCES turma(id_turma)
);
CREATE TABLE falta_professor (
    id_falta_professor INT PRIMARY KEY AUTO_INCREMENT,
    id_funcionario INT NOT NULL,
    id_disciplina INT NOT NULL,
    id_turma INT NOT NULL,
    data_falta DATE NOT NULL,
    justificada BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_funcionario) REFERENCES funcionario(id_funcionario),
    FOREIGN KEY (id_disciplina) REFERENCES disciplina(id_disciplina),
    FOREIGN KEY (id_turma) REFERENCES turma(id_turma)
);
CREATE TABLE documento (
    id_documento INT PRIMARY KEY AUTO_INCREMENT,
    tipo_documento varchar(55),
    id_aluno INT,
    id_funcionario INT, -- quem gerou
    data_emissao DATETIME DEFAULT CURRENT_TIMESTAMP,
    caminho_arquivo VARCHAR(255), -- caminho para PDF gerado
    FOREIGN KEY (id_aluno) REFERENCES aluno(id_aluno),
    FOREIGN KEY (id_funcionario) REFERENCES funcionario(id_funcionario)
);
create table categoria(
    id_categoria int primary key auto_increment,
    categoria varchar(100)
);
create table livro(
    id_livro int primary key auto_increment,
    titulo varchar(100) not null,
    editora varchar(100) not null,
    id_funcionario int null,
    id_aluno int null,
    caminho_arquivo text,
    id_categoria int,
    data_upload datetime default current_timestamp,
    foreign key(id_funcionario) references funcionario(id_funcionario),
    foreign key(id_aluno) references aluno(id_aluno),
    foreign key(id_categoria) references categoria(id_categoria)

)engine InnoDB;

CREATE TABLE historico (
  id_historico int primary key AUTO_INCREMENT,
  id_funcionario int not null,
  tabela varchar(100) NOT NULL,
  id_dado int DEFAULT NULL,
  acao enum('Inserir','Actualizar','Deletar') DEFAULT NULL,
  dados_anteriore text,
  dados_novos text,
  data_hora datetime DEFAULT CURRENT_TIMESTAMP,
 foreign key(id_funcionario) references funcionario(id_funcionario)
) ENGINE=InnoDB ;

CREATE TABLE historico_login (
    id_historico_login int primary key AUTO_INCREMENT,
    id_funcionario int not null,
    hora_entrada datetime DEFAULT CURRENT_TIMESTAMP,
    hora_saida datetime DEFAULT NULL,
 foreign key(id_funcionario) references funcionario(id_funcionario)
) ENGINE= InnoDB;