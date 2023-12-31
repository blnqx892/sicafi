-- MySQL Script generated by MySQL Workbench
-- Thu Apr 13 16:07:18 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`tipoInventario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tipoInventario` (
  `idtipoInventario` INT NULL AUTO_INCREMENT,
  `nombreTipo` VARCHAR(45) NULL,
  PRIMARY KEY (`idtipoInventario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`bienes-entradas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`bienes-entradas` (
  `idbienes` INT NULL AUTO_INCREMENT,
  `fechaAdquisicion` DATE NULL,
  `numFactura` VARCHAR(45) NULL,
  `proveedor` VARCHAR(45) NULL,
  `costo` FLOAT NULL,
  `nombreBien` VARCHAR(100) NULL,
  `serie` VARCHAR(45) NULL,
  `marca` VARCHAR(45) NULL,
  `modelo` VARCHAR(45) NULL,
  `color` VARCHAR(45) NULL,
  `fk_tipoInventario` INT NOT NULL,
  `descripcion` VARCHAR(200) NULL,
  `transporte` TINYINT NULL,
  PRIMARY KEY (`idbienes`),
  INDEX `fk_bienes-entradas_tipoInventario_idx` (`fk_tipoInventario` ASC) VISIBLE,
  CONSTRAINT `fk_bienes-entradas_tipoInventario`
    FOREIGN KEY (`fk_tipoInventario`)
    REFERENCES `mydb`.`tipoInventario` (`idtipoInventario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`mobiliario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`mobiliario` (
  `idmobiliario` INT NULL AUTO_INCREMENT,
  `fechaIngreso` DATE NULL,
  `nombreMobiliario` VARCHAR(200) NULL,
  `marcaMobiliario` VARCHAR(200) NULL,
  `cantidadMobiliario` INT NULL,
  `precioMobiliario` FLOAT NULL,
  `descripcionMobiliario` VARCHAR(500) NULL,
  PRIMARY KEY (`idmobiliario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`equipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`equipo` (
  `idequipo` INT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idequipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`roles` (
  `idroles` INT NOT NULL AUTO_INCREMENT,
  `nombre_rol` VARCHAR(45) NULL,
  PRIMARY KEY (`idroles`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuarios` (
  `idusuarios` INT NULL AUTO_INCREMENT,
  `nombreUsuario` VARCHAR(100) NULL,
  `apellidoUsuario` VARCHAR(100) NULL,
  `usuario` VARCHAR(45) NULL,
  `email` VARCHAR(100) NULL,
  `contrasena` VARCHAR(500) NULL,
  `fk_rol_usuario` INT NOT NULL,
  PRIMARY KEY (`idusuarios`),
  INDEX `fk_usuarios_roles1_idx` (`fk_rol_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_usuarios_roles1`
    FOREIGN KEY (`fk_rol_usuario`)
    REFERENCES `mydb`.`roles` (`idroles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`unidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`unidad` (
  `idunidad` INT NULL AUTO_INCREMENT,
  `nombreUnidad` VARCHAR(45) NULL,
  `fk_usuario` INT NOT NULL,
  PRIMARY KEY (`idunidad`),
  INDEX `fk_unidad_usuarios1_idx` (`fk_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_unidad_usuarios1`
    FOREIGN KEY (`fk_usuario`)
    REFERENCES `mydb`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tipoCargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tipoCargo` (
  `idtipoCargo` INT NULL AUTO_INCREMENT,
  `nombreTipoCargo` VARCHAR(45) NULL,
  PRIMARY KEY (`idtipoCargo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`asignacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`asignacion` (
  `idasignacion` INT NULL AUTO_INCREMENT,
  `fechaAsignacion` DATE NULL,
  `fk_unidad` INT NOT NULL,
  `responsable` VARCHAR(100) NULL,
  `fk_bien` INT NOT NULL,
  `fk_cargo` INT NOT NULL,
  `codigo` VARCHAR(45) NULL,
  `encargado` VARCHAR(45) NULL,
  PRIMARY KEY (`idasignacion`),
  INDEX `fk_asignacion_unidad1_idx` (`fk_unidad` ASC) VISIBLE,
  INDEX `fk_asignacion_bienes-entradas1_idx` (`fk_bien` ASC) VISIBLE,
  INDEX `fk_asignacion_tipoCargo1_idx` (`fk_cargo` ASC) VISIBLE,
  CONSTRAINT `fk_asignacion_unidad1`
    FOREIGN KEY (`fk_unidad`)
    REFERENCES `mydb`.`unidad` (`idunidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignacion_bienes-entradas1`
    FOREIGN KEY (`fk_bien`)
    REFERENCES `mydb`.`bienes-entradas` (`idbienes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asignacion_tipoCargo1`
    FOREIGN KEY (`fk_cargo`)
    REFERENCES `mydb`.`tipoCargo` (`idtipoCargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tiposMovimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tiposMovimiento` (
  `idtipos` INT NULL AUTO_INCREMENT,
  `nombreTipoMovimiento` VARCHAR(45) NULL,
  PRIMARY KEY (`idtipos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`movientoBienes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`movientoBienes` (
  `idmovientoBienes` INT NOT NULL AUTO_INCREMENT,
  `fk_bien` INT NOT NULL,
  `fechaMoviento` DATE NULL,
  `fk_unidadDestino` INT NOT NULL,
  `observacionesMovimiento` VARCHAR(200) NULL,
  `fk_movimientos` INT NOT NULL,
  PRIMARY KEY (`idmovientoBienes`),
  INDEX `fk_movientoBienes_bienes-entradas1_idx` (`fk_bien` ASC) VISIBLE,
  INDEX `fk_movientoBienes_unidad1_idx` (`fk_unidadDestino` ASC) VISIBLE,
  INDEX `fk_movientoBienes_tiposMovimiento1_idx` (`fk_movimientos` ASC) VISIBLE,
  CONSTRAINT `fk_movientoBienes_bienes-entradas1`
    FOREIGN KEY (`fk_bien`)
    REFERENCES `mydb`.`bienes-entradas` (`idbienes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movientoBienes_unidad1`
    FOREIGN KEY (`fk_unidadDestino`)
    REFERENCES `mydb`.`unidad` (`idunidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movientoBienes_tiposMovimiento1`
    FOREIGN KEY (`fk_movimientos`)
    REFERENCES `mydb`.`tiposMovimiento` (`idtipos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tipoDescargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tipoDescargo` (
  `idtipoDescargo` INT NULL AUTO_INCREMENT,
  `nombreTipoDescargo` VARCHAR(45) NULL,
  PRIMARY KEY (`idtipoDescargo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`descargoBienes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`descargoBienes` (
  `iddescargoBienes` INT NULL AUTO_INCREMENT,
  `fk_bien` INT NOT NULL,
  `fechaDescargo` DATE NULL,
  `fk_unidadProcedencia` INT NOT NULL,
  `observacionesDescargo` VARCHAR(200) NULL,
  `fk_tipoDescargo` INT NOT NULL,
  PRIMARY KEY (`iddescargoBienes`),
  INDEX `fk_descargoBienes_bienes-entradas1_idx` (`fk_bien` ASC) VISIBLE,
  INDEX `fk_descargoBienes_unidad1_idx` (`fk_unidadProcedencia` ASC) VISIBLE,
  INDEX `fk_descargoBienes_tipoDescargo1_idx` (`fk_tipoDescargo` ASC) VISIBLE,
  CONSTRAINT `fk_descargoBienes_bienes-entradas1`
    FOREIGN KEY (`fk_bien`)
    REFERENCES `mydb`.`bienes-entradas` (`idbienes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_descargoBienes_unidad1`
    FOREIGN KEY (`fk_unidadProcedencia`)
    REFERENCES `mydb`.`unidad` (`idunidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_descargoBienes_tipoDescargo1`
    FOREIGN KEY (`fk_tipoDescargo`)
    REFERENCES `mydb`.`tipoDescargo` (`idtipoDescargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`suministros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`suministros` (
  `idsuministros` INT NULL AUTO_INCREMENT,
  `fechaSuministros` DATE NULL,
  `codigoSuministro` VARCHAR(45) NULL,
  `numTarjeta` VARCHAR(45) NULL,
  `nombreSuministro` VARCHAR(200) NULL,
  `marcaSuministro` VARCHAR(45) NULL,
  `cantidadSuministro` INT NULL,
  `precioSuministro` FLOAT NULL,
  `unidadMedida` VARCHAR(45) NULL,
  `fk_unidad_ubicacion` INT NOT NULL,
  `descripcionSuministro` VARCHAR(500) NULL,
  PRIMARY KEY (`idsuministros`),
  INDEX `fk_suministros_unidad1_idx` (`fk_unidad_ubicacion` ASC) VISIBLE,
  CONSTRAINT `fk_suministros_unidad1`
    FOREIGN KEY (`fk_unidad_ubicacion`)
    REFERENCES `mydb`.`unidad` (`idunidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`mobiliario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`mobiliario` (
  `idmobiliario` INT NULL AUTO_INCREMENT,
  `fechaIngreso` DATE NULL,
  `nombreMobiliario` VARCHAR(200) NULL,
  `marcaMobiliario` VARCHAR(200) NULL,
  `cantidadMobiliario` INT NULL,
  `precioMobiliario` FLOAT NULL,
  `descripcionMobiliario` VARCHAR(500) NULL,
  PRIMARY KEY (`idmobiliario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`bitacora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`bitacora` (
  `idbitacora` INT NULL AUTO_INCREMENT,
  `fk_usuarios` INT NOT NULL,
  `fechaBitacora` DATE NULL,
  `horaBitacora` TIME NULL,
  `descripcionBitacora` VARCHAR(500) NULL,
  PRIMARY KEY (`idbitacora`),
  INDEX `fk_bitacora_usuarios1_idx` (`fk_usuarios` ASC) VISIBLE,
  CONSTRAINT `fk_bitacora_usuarios1`
    FOREIGN KEY (`fk_usuarios`)
    REFERENCES `mydb`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
