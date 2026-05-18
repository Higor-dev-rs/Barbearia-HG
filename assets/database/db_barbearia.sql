CREATE DATABASE IF NOT EXISTS barbearia_hg;
USE barbearia_hg;

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR (100) NOT NULL,
    email VARCHAR (100) NOT NULL,
    telefone VARCHAR (20) NOT NULL
);

CREATE TABLE servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR (100) NOT NULL,
    preco DECIMAL (10,2) NOT NULL,
    duracao INT NOT NULL
);

CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR (100) NOT NULL,
    email VARCHAR (100) NOT NULL,
    telefone VARCHAR (20) NOT NULL,
    servico VARCHAR (50) NOT NULL,
    data_agendamento DATETIME NOT NULL,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

INSERT INTO agendamentos (nome, email, telefone, servico, data_agendamento)
VALUES (
    'João Silva',
    'joao@email.com',
    '21999999999',
    'Corte a Maquina',
    '2026-05-13 16:00:00'
),
(
    'Murilo Souza',
    'murilo@email.com',
    '21940028922',
    'Corte a Tesoura',
    '2026-05-14 10:00:00'
);

