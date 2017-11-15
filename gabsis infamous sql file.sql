-- MySQL Script generated by MySQL Workbench
-- 11/15/17 14:16:33
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema INFI
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema INFI
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `INFI` DEFAULT CHARACTER SET utf8 ;
USE `INFI` ;

-- -----------------------------------------------------
-- Table `INFI`.`subjects`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `INFI`.`subjects` ;

CREATE TABLE IF NOT EXISTS `INFI`.`subjects` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lvnr` CHAR(100) NOT NULL,
  `title` CHAR(100) NOT NULL,
  `groups_required` INT NOT NULL,
  `hours` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `INFI`.`teachers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `INFI`.`teachers` ;

CREATE TABLE IF NOT EXISTS `INFI`.`teachers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `f_name` CHAR(100) NOT NULL,
  `l_name` CHAR(100) NOT NULL,
  `short` CHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `INFI`.`lessons`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `INFI`.`lessons` ;

CREATE TABLE IF NOT EXISTS `INFI`.`lessons` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_teachers` INT NOT NULL,
  `hours` INT NOT NULL,
  `group` CHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_lessons_teachers1_idx` (`id_teachers` ASC),
  CONSTRAINT `fk_lessons_teachers1`
    FOREIGN KEY (`id_teachers`)
    REFERENCES `INFI`.`teachers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
