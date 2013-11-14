
/* 04/11/13 
ALTER TABLE `binluu`.`credit_transactions` CHANGE COLUMN `credit_transactionscol` `status` ENUM('A','C') NULL DEFAULT 'A'  ;
ALTER TABLE `binluu`.`credit_transactions` CHANGE COLUMN `date` `date` DATETIME NULL DEFAULT NULL  ;

/* 07/11/13 
CREATE TABLE `binluu`.`property_images` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `adviser_property_id` INT NULL,
  `image` VARCHAR(480) NULL,
  `type` ENUM('defaul','description') NULL DEFAULT 'description',
  PRIMARY KEY (`id`));

*/
