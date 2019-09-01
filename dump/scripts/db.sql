DROP DATABASE IF EXISTS project_db;
CREATE DATABASE IF NOT EXISTS project_db;

USE project_db;

DROP TABLE IF EXISTS permissao;
CREATE TABLE IF NOT EXISTS permissao (
    id INT(11) AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS usuario;
CREATE TABLE IF NOT EXISTS usuario (
    id INT(11) AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(32) NOT NULL,
    telefone VARCHAR(15),
    id_permissao INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY fk_usuario_permissao (id_permissao) REFERENCES permissao(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

DROP TABLE IF EXISTS relacionamentos;
CREATE TABLE IF NOT EXISTS relacionamentos (
    id INT(11) AUTO_INCREMENT,
    id_atendente INT(11) NOT NULL,
    id_cliente INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY fk_relacionamentos_atendente (id_atendente) REFERENCES usuario(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY fk_relacionamentos_cliente (id_cliente) REFERENCES usuario  (id) ON UPDATE CASCADE ON DELETE RESTRICT
);

DROP TABLE IF EXISTS mensagens;
CREATE TABLE IF NOT EXISTS mensagens (
    id INT(11) AUTO_INCREMENT,
    id_relacionamento INT(11) NOT NULL,
    id_envia INT(11) NOT NULL,
    id_recebe INT(11) NOT NULL,
    data_mensagem TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    conteudo VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY fk_mensagens_relacionamentos (id_relacionamento) REFERENCES relacionamentos(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

DROP TABLE IF EXISTS chamados;
CREATE TABLE IF NOT EXISTS chamados (
    id INT(11) AUTO_INCREMENT,
    id_user_open INT(11) NOT NULL,
    id_user_current INT(11) NOT NULL,
    id_cliente INT(11),
    email_cliente VARCHAR(50),
    id_relacionamento INT(11),
    descricao VARCHAR(255) NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Criado',
    ativo BOOLEAN NOT NULL DEFAULT TRUE,
    data_inicio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    data_fim TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY fk_chamados_cliente (id_cliente) REFERENCES usuario(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY fk_chamados_relacionamentos (id_relacionamento) REFERENCES relacionamentos(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY fk_chamados_user_open (id_user_open) REFERENCES usuario(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY fk_chamados_user_current (id_user_current) REFERENCES usuario(id) ON UPDATE CASCADE ON DELETE RESTRICT
);