# PHP_u375395381_starvote

Banco de Dados: u375395381_starvote

tb_categoria - Tabela responsável pelas categorias da equipe.
Exemplos: Professores, alunos, visitantes.

tb_equipe - Tabela responsável por categorizar usuários.
Exemplos: 1º ano (Sistemas), 2º ano (Eletrônica), Alunos Mário Esdras.

tb_usuario - Tabela de dados dos usuários.
Exemplo: Samuel do 3º ano (Sistemas).

tb_projeto - Tabela de projetos da equipe.
Exemplo: Vulcão do 3º ano (Sistemas)

tb_vinculo - Tabela responsável por vincular alunos a projetos.
Exemplo - Samuel do 3º ano (Sistemas) ao projeto Vulcão do 3º ano (Sistemas).

terceiro@industrialdigital.com.br
Server-123

-----------------------------------------------------------------------------------

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE TABLE IF NOT EXISTS `u375395381_starvote`.`tb_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(80) NOT NULL,
  `peso` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE IF NOT EXISTS `u375395381_starvote`.`tb_equipe` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `equipe` VARCHAR(80) NOT NULL,
  `id_categoria` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_categoria_equipe_idx` (`id_categoria`),
  CONSTRAINT `fk_categoria_equipe`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `u375395381_starvote`.`tb_categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE IF NOT EXISTS `u375395381_starvote`.`tb_projeto` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `projeto` VARCHAR(80) NOT NULL,
  `descricao` TEXT NOT NULL,
  `id_equipe` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_equipe_idx` (`id_equipe`),
  CONSTRAINT `fk_equipe_projeto`
    FOREIGN KEY (`id_equipe`)
    REFERENCES `u375395381_starvote`.`tb_equipe` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE IF NOT EXISTS `u375395381_starvote`.`tb_foto` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_projeto` INT(11) NOT NULL,
  `foto` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_projeto_idx` (`id_projeto`),
  CONSTRAINT `fk_projeto_foto`
    FOREIGN KEY (`id_projeto`)
    REFERENCES `u375395381_starvote`.`tb_projeto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `u375395381_starvote`.`tb_usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(80) NOT NULL,
  `email` VARCHAR(80) NOT NULL,
  `senha` VARCHAR(80) NOT NULL,
  `id_equipe` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_idx` (`id_equipe`),
  CONSTRAINT `fk_equipe_usuario`
    FOREIGN KEY (`id_equipe`)
    REFERENCES `u375395381_starvote`.`tb_equipe` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `u375395381_starvote`.`tb_vinculo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NOT NULL,
  `id_projeto` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usuario_idx` (`id_usuario`),
  INDEX `fk_projeto_idx` (`id_projeto`),
  CONSTRAINT `fk_usuario_vinculo`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `u375395381_starvote`.`tb_usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projeto_vinculo`
    FOREIGN KEY (`id_projeto`)
    REFERENCES `u375395381_starvote`.`tb_projeto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `u375395381_starvote`.`tb_voto` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` INT(11) NOT NULL,
  `id_projeto` INT(11) NOT NULL,
  `voto` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usuario_idx` (`id_usuario`),
  INDEX `fk_projeto_idx` (`id_projeto`),
  CONSTRAINT `fk_usuario_voto`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `u375395381_starvote`.`tb_usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projeto_voto`
    FOREIGN KEY (`id_projeto`)
    REFERENCES `u375395381_starvote`.`tb_projeto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

ALTER TABLE tb_vinculo
ADD CONSTRAINT unq_usuario_projeto UNIQUE (id_usuario);

ALTER TABLE tb_voto
ADD CONSTRAINT unq_usuario_projeto UNIQUE (id_usuario, id_projeto);