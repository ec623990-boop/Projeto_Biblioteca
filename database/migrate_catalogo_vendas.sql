-- Migração única para uma instalação existente do Projeto_Biblioteca.
-- Faça backup e confirme que usuarios.email não tem duplicatas antes de executar.
-- A consulta abaixo deve retornar zero linhas:
-- SELECT email, COUNT(*) AS total FROM usuarios GROUP BY email HAVING COUNT(*) > 1;
-- Contas existentes começam como leitores; conceda perfil admin apenas a equipe verificada.
ALTER TABLE usuarios
    ADD COLUMN perfil ENUM('admin', 'leitor') NOT NULL DEFAULT 'leitor' AFTER senha;

ALTER TABLE livros
    ADD COLUMN preco DECIMAL(10,2) UNSIGNED NULL DEFAULT NULL AFTER quantidade;

ALTER TABLE usuarios
    ADD UNIQUE KEY uq_usuarios_email (email);
