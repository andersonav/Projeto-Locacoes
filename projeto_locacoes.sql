-- MySQL Script generated by MySQL Workbench
-- Mon Oct  9 16:20:59 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema projeto_locacoes
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema projeto_locacoes
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projeto_locacoes` DEFAULT CHARACTER SET utf8 ;
USE `projeto_locacoes` ;

-- -----------------------------------------------------
-- Table `projeto_locacoes`.`evento_tipos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_locacoes`.`evento_tipos` (
  `eve_tip_id` INT NOT NULL AUTO_INCREMENT,
  `eve_tip_desc` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`eve_tip_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_locacoes`.`evento_tipo_repeticao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_locacoes`.`evento_tipo_repeticao` (
  `eve_tip_rep_id` INT NOT NULL AUTO_INCREMENT,
  `eve_tip_rep_desc` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`eve_tip_rep_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_locacoes`.`setor_evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_locacoes`.`setor_evento` (
  `set_eve_id` INT NOT NULL AUTO_INCREMENT,
  `set_eve_desc` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`set_eve_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_locacoes`.`bloco_evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_locacoes`.`bloco_evento` (
  `blo_eve_id` INT NOT NULL AUTO_INCREMENT,
  `blo_eve_desc` VARCHAR(45) NOT NULL,
  `blo_set_eve_id` INT NOT NULL,
  PRIMARY KEY (`blo_eve_id`),
  INDEX `fk_bloco_evento_setor_evento1_idx` (`blo_set_eve_id` ASC),
  CONSTRAINT `fk_bloco_evento_setor_evento1`
    FOREIGN KEY (`blo_set_eve_id`)
    REFERENCES `projeto_locacoes`.`setor_evento` (`set_eve_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projeto_locacoes`.`evento_ambiente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_locacoes`.`evento_ambiente` (
  `eve_amb_id` INT NOT NULL AUTO_INCREMENT,
  `eve_amb_desc` VARCHAR(45) NOT NULL,
  `blo_eve_id` INT NOT NULL,
  PRIMARY KEY (`eve_amb_id`),
  INDEX `fk_evento_ambiente_bloco_evento1_idx` (`blo_eve_id` ASC),
  CONSTRAINT `fk_evento_ambiente_bloco_evento1`
    FOREIGN KEY (`blo_eve_id`)
    REFERENCES `projeto_locacoes`.`bloco_evento` (`blo_eve_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = euckr;


-- -----------------------------------------------------
-- Table `projeto_locacoes`.`eventos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projeto_locacoes`.`eventos` (
  `eve_id` INT NOT NULL AUTO_INCREMENT,
  `eve_nome` VARCHAR(45) NULL,
  `eve_solicitante` VARCHAR(45) NULL,
  `eve_data_inicio` TIMESTAMP NULL,
  `eve_data_fim` TIMESTAMP NULL,
  `eve_tip_id` INT NOT NULL,
  `eve_tip_rep_id` INT NOT NULL,
  `eve_amb_id` INT NOT NULL,
  PRIMARY KEY (`eve_id`),
  INDEX `fk_eventos_evento_tipos_idx` (`eve_tip_id` ASC),
  INDEX `fk_eventos_evento_tipo_repeticao1_idx` (`eve_tip_rep_id` ASC),
  INDEX `fk_eventos_evento_ambiente1_idx` (`eve_amb_id` ASC),
  CONSTRAINT `fk_eventos_evento_tipos`
    FOREIGN KEY (`eve_tip_id`)
    REFERENCES `projeto_locacoes`.`evento_tipos` (`eve_tip_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_evento_tipo_repeticao1`
    FOREIGN KEY (`eve_tip_rep_id`)
    REFERENCES `projeto_locacoes`.`evento_tipo_repeticao` (`eve_tip_rep_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_eventos_evento_ambiente1`
    FOREIGN KEY (`eve_amb_id`)
    REFERENCES `projeto_locacoes`.`evento_ambiente` (`eve_amb_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
