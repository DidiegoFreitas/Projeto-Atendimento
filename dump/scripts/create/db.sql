DROP DATABASE IF EXISTS project_db;

CREATE DATABASE IF NOT EXISTS project_db;

USE project_db;

DROP TABLE IF EXISTS atendente;
CREATE TABLE IF NOT EXISTS atendente (
    id INT(11) AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS cliente;
CREATE TABLE IF NOT EXISTS cliente (
    id INT(11) AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    telefone VARCHAR(15),
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS canais;
CREATE TABLE IF NOT EXISTS canais (
    id INT(11) AUTO_INCREMENT,
    id_atendente INT(11) NOT NULL,
    id_cliente INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY fk_canais_atendente (id_atendente) REFERENCES atendente(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY fk_canais_cliente (id_cliente) REFERENCES cliente(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

DROP TABLE IF EXISTS mensagens;
CREATE TABLE IF NOT EXISTS mensagens (
    id INT(11) AUTO_INCREMENT,
    id_canal INT(11) NOT NULL,
    id_envia INT(11) NOT NULL,
    id_recebe INT(11) NOT NULL,
    date_mensagem TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    conteudo VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY fk_mensagens_canais (id_canal) REFERENCES canais(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

DROP TABLE IF EXISTS chamados;
CREATE TABLE IF NOT EXISTS chamados (
    id INT(11) AUTO_INCREMENT,
    id_atendente_open INT(11) NOT NULL,
    id_atendente_current INT(11) NOT NULL,
    id_cliente INT(11),
    email_cliente VARCHAR(50),
    id_canal INT(11),
    descricao VARCHAR(255) NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Criado',
    ativo BOOLEAN NOT NULL DEFAULT TRUE,
    date_inicio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_fim TIMESTAMP NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY fk_chamados_cliente (id_cliente) REFERENCES cliente(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY fk_chamados_canais (id_canal) REFERENCES canais(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY fk_chamados_atendente_open (id_atendente_open) REFERENCES atendente(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY fk_chamados_atendente_current (id_atendente_current) REFERENCES atendente(id) ON UPDATE CASCADE ON DELETE RESTRICT
);