-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema desing
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema desing
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `desing` DEFAULT CHARACTER SET utf8 ;
USE `desing` ;

-- -----------------------------------------------------
-- Table `desing`.`personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desing`.`personas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `apellido` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `desing`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desing`.`permisos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `permiso` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `desing`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desing`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `correo` VARCHAR(45) NULL,
  `contrasena` VARCHAR(45) NULL,
  `id_personas` INT NULL,
  `id_permisos` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_persoasa_usuarios_idx` (`id_personas` ASC) ,
  INDEX `fk_permisos_usuarios_idx` (`id_permisos` ASC) ,
  CONSTRAINT `fk_persoasa_usuarios`
    FOREIGN KEY (`id_personas`)
    REFERENCES `desing`.`personas` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_permisos_usuarios`
    FOREIGN KEY (`id_permisos`)
    REFERENCES `desing`.`permisos` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `desing`.`tipos_archivos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desing`.`tipos_archivos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipos` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `desing`.`archivos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desing`.`archivos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `coiudad` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  `archivo` VARCHAR(100) NULL,
  `creacion` DATE NULL,
  `tipo` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_archivos_tipo_idx` (`tipo` ASC) ,
  CONSTRAINT `fk_archivos_tipo`
    FOREIGN KEY (`tipo`)
    REFERENCES `desing`.`tipos_archivos` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `desing`.`datos_casa_interes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desing`.`datos_casa_interes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` TEXT NULL,
  `precio` float NULL,
  `nRecamaras` INT NULL,
  `m2_construidos` FLOAT NULL,
  `ubicacion` TEXT NULL,
  `link` TEXT NULL,
  `imagen` TEXT NULL,
  `lat` FLOAT NULL,
  `lng` FLOAT NULL,
  `archivo` INT NULL,
  `pm2` float NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_archivo_casas_idx` (`archivo` ASC) ,
  CONSTRAINT `fk_archivo_casas`
    FOREIGN KEY (`archivo`)
    REFERENCES `desing`.`archivos` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `desing`.`cotizantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desing`.`cotizantes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `correo` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `desing`.`tipos_pdfs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desing`.`tipos_pdfs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `desing`.`proyectos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `desing`.`proyectos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_proyecto` INT NULL,
  `m2` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `lat` VARCHAR(45) NULL,
  `lng` VARCHAR(45) NULL,
  `id_cotizante` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cotizante_proyecto_idx` (`id_cotizante` ASC) ,
  INDEX `fk_tipos_proyectos_cot_idx` (`id_proyecto` ASC) ,
  CONSTRAINT `fk_cotizante_proyecto`
    FOREIGN KEY (`id_cotizante`)
    REFERENCES `desing`.`cotizantes` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tipos_proyectos_cot`
    FOREIGN KEY (`id_proyecto`)
    REFERENCES `desing`.`tipos_pdfs` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
