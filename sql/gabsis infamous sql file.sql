-- MySQL Script generated by MySQL Workbench
-- 11/20/17 12:15:04
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema INFI
-- -----------------------------------------------------
DROP TABLE IF EXISTS `INFI`.`lessons` ;
DROP TABLE IF EXISTS `INFI`.`subjects` ;
DROP TABLE IF EXISTS `INFI`.`teachers` ;

-- -----------------------------------------------------
-- Schema INFI
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `INFI` DEFAULT CHARACTER SET utf8 ;
USE `INFI` ;

-- -----------------------------------------------------
-- Table `INFI`.`subjects`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `INFI`.`subjects` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `lvnr` CHAR(100) NOT NULL, /*Lehrveranstaltungsnummer*/
  `title` CHAR(100) NOT NULL, /*Titel der Veranstaltungen*/
  `groups_required` INT NOT NULL, /*Anzahl der insgesamt benötigten Gruppen*/
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `INFI`.`teachers`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `INFI`.`teachers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `f_name` CHAR(100) NOT NULL, /*Vorname*/
  `l_name` CHAR(100) NOT NULL, /*Nachname*/
  `short` CHAR(100) NOT NULL, /*Kürzel*/
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `INFI`.`lessons`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `INFI`.`lessons` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_teachers` INT NOT NULL, /*Referenz auf Lehrer*/
  `hours` INT NOT NULL, /*Anzahl der Stunden*/
  `group` CHAR(100) NOT NULL, /*Name der Gruppe*/
  `id_subjects` INT NOT NULL, /*Referenzierte Veranstaltung*/
  PRIMARY KEY (`id`),
  INDEX `fk_lessons_teachers1_idx` (`id_teachers` ASC),
  INDEX `fk_lessons_subjects1_idx` (`id_subjects` ASC),
  CONSTRAINT `fk_lessons_teachers1`
    FOREIGN KEY (`id_teachers`)
    REFERENCES `INFI`.`teachers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lessons_subjects1`
    FOREIGN KEY (`id_subjects`)
    REFERENCES `INFI`.`subjects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- Testdaten

INSERT INTO `teachers` (`id`, `f_name`, `l_name`, `short`) VALUES (NULL, 'Katzengruber', 'Leo', 'leka'), (NULL, 'Blank', 'Michael', 'mibl'), (NULL, 'Gabsi', 'Lukas', 'luga');
INSERT INTO `subjects` (`id`, `lvnr`, `title`, `groups_required`) VALUES (NULL, '100-3342', 'Betriebstechnik', '2'), (NULL, '100-3378', 'Automatisierungstechnik', '3'), (NULL, '100-3367', 'Laboratorium - INFI', '1'), (NULL, '100-3365', 'Theorie - INFI', '1'), (NULL, '100-3387', 'Laboratorium - Robotik', '28');
INSERT INTO `lessons` (`id`, `id_teachers`, `hours`, `group`, `id_subjects`) VALUES (NULL, '1', '20', '30', '2'), (NULL, '1', '20', '30', '3'), (NULL, '2', '10', '100', '5'), (NULL, '3', '20', '150', '4'), (NULL, '3', '5', '1', '1');
INSERT INTO `lessons` (`id`, `id_teachers`, `hours`, `group`, `id_subjects`) VALUES (NULL, '1', '5', '6', '2'), (NULL, '2', '4', '8', '4'), (NULL, '2', '7', '1', '5'), (NULL, '2', '6', '12', '1'), (NULL, '1', '6', '21', '3'), (NULL, '1', '6', '23', '4'), (NULL, '3', '1', '23', '5'), (NULL, '3', '2', '12', '2'), (NULL, '3', '6', '84', '3'), (NULL, '3', '15', '212', '3');

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
