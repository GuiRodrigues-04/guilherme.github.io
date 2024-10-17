CREATE TABLE tabela_registros (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30) NOT NULL,
    sobrenome VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    cidade VARCHAR(50),
    pais VARCHAR(50)
);