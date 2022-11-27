-- CREATE SCHEMA/DATABASE
CREATE SCHEMA IF NOT EXISTS php_crud;

-- SET AS DEFAULT SCHEMA
USE php_crud;

-- CREATE TABLE
CREATE TABLE IF NOT EXISTS faculdade(
    id INT NOT NULL AUTO_INCREMENT,
    aluno VARCHAR(50)NOT NULL,
    matricula INT(5) NOT NULL AUTO_INCREMENT,
    curso VARCHAR(50) NOT NULL,
    ano INT(4) NOT NULL,
    semestre INT(1) NOT NULL, 
    curso VARCHAR(100) NOT NULL,
    carga_horaria INT(4) NOT NULL,
    atividade_complementar TEXT NULL
    PRIMARY KEY (matricula)
);

-- CREATE TRIGGER ON INSERT
CREATE TRIGGER tr_i_faculdade_matricula_ativa 
BEFORE INSERT ON faculdade
FOR EACH ROW
SET matricula_ativa = true;

-- CREATE TRIGGER ON UPDATE
CREATE TRIGGER tr_i_faculdade_matricula_ativa 
BEFORE INSERT ON faculdade
FOR EACH ROW
SET matricula_ativa = true;


##############################
########   OPTIONAL   ########
##############################

-- Exibe usuários do BD
SELECT User, HOST FROM mysql.user;

-- Exibe permissões do uruário
SHOW GRANTS FOR crud@localhost;

-- Cria usuário
CREATE USER 'crud'@'localhost' IDENTIFIED BY '654321';

-- Concede permissões CRUD
GRANT INSERT, UPDATE, DELETE, SELECT, EXECUTE 
ON *.* 
TO crud@localhost;

-- Cria usuário e concede permissões em comando único
GRANT INSERT, UPDATE, DELETE, SELECT, EXECUTE 
ON *.* 
TO crud@localhost IDENTIFIED BY '654321';