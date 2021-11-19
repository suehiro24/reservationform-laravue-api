-- MySQL Script generated by MySQL Workbench
-- Sun Nov 14 00:20:09 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema reservationform_laravue
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema reservationform_laravue
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `reservationform_laravue` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `reservationform_laravue` ;

-- -----------------------------------------------------
-- Table `reservationform_laravue`.`courses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reservationform_laravue`.`courses` ;

CREATE TABLE IF NOT EXISTS `reservationform_laravue`.`courses` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'コースID',
  `name` VARCHAR(100) NOT NULL DEFAULT '' COMMENT 'コース名',
  `price` INT UNSIGNED NULL DEFAULT NULL,
  `capacity` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '定員',
  `location` VARCHAR(100) NULL DEFAULT NULL COMMENT '場所',
  `description` TEXT CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_0900_ai_ci' NULL DEFAULT NULL COMMENT '説明',
  `is_finished` TINYINT NOT NULL DEFAULT '0' COMMENT '開講フラグ',
  `is_deleted` TINYINT NOT NULL DEFAULT '0' COMMENT '削除フラグ',
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `reservationform_laravue`.`appointment_slots`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `reservationform_laravue`.`appointment_slots` ;

CREATE TABLE IF NOT EXISTS `reservationform_laravue`.`appointment_slots` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '予約枠ID',
  `course_id` BIGINT UNSIGNED NOT NULL COMMENT 'コースID',
  `e_name` VARCHAR(100) NULL DEFAULT NULL COMMENT '予約枠名',
  `e_price` INT UNSIGNED NULL DEFAULT NULL COMMENT '価格',
  `e_capacity` INT UNSIGNED NULL DEFAULT NULL COMMENT '予約枠定員',
  `e_location` VARCHAR(100) NULL DEFAULT NULL COMMENT '予約枠',
  `note` TEXT NULL DEFAULT NULL,
  `reservations` INT UNSIGNED NOT NULL DEFAULT '0',
  `start` DATETIME NOT NULL,
  `end` DATETIME NOT NULL,
  `is_full` TINYINT NOT NULL DEFAULT '0',
  `gc_event_id` VARCHAR(255) NULL DEFAULT NULL,
  `created_at` DATETIME NULL DEFAULT NULL,
  `updated_at` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_appointment_slots_courses_idx` (`course_id` ASC) VISIBLE,
  CONSTRAINT `fk_appointment_slots_courses`
    FOREIGN KEY (`course_id`)
    REFERENCES `reservationform_laravue`.`courses` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
