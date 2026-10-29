-- Banco de dados novo para o Sistema Biblioteca.
-- Execute este arquivo uma única vez em um MySQL/MariaDB vazio.
CREATE DATABASE IF NOT EXISTS biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE biblioteca;

CREATE TABLE usuarios (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    perfil ENUM('admin', 'leitor') NOT NULL DEFAULT 'leitor',
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_usuarios_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE livros (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(160) NOT NULL,
    ano SMALLINT UNSIGNED NULL,
    categoria VARCHAR(120) NULL,
    quantidade INT UNSIGNED NOT NULL DEFAULT 0,
    status VARCHAR(30) NOT NULL DEFAULT 'disponivel',
    preco DECIMAL(10,2) UNSIGNED NULL DEFAULT NULL,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_livros_titulo (titulo),
    KEY idx_livros_categoria (categoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE emprestimos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_livro INT UNSIGNED NOT NULL,
    id_usuario INT UNSIGNED NOT NULL,
    data_emprestimo DATE NOT NULL,
    data_devolucao DATE NULL,
    status ENUM('emprestado', 'devolvido') NOT NULL DEFAULT 'emprestado',
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_emprestimos_livro_status (id_livro, status),
    KEY idx_emprestimos_usuario (id_usuario),
    CONSTRAINT fk_emprestimos_livro FOREIGN KEY (id_livro) REFERENCES livros (id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_emprestimos_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios (id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
