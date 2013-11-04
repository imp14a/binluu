
/* 04/11/13 */
ALTER TABLE `binluu`.`credit_transactions` CHANGE COLUMN `credit_transactionscol` `status` ENUM('A','C') NULL DEFAULT 'A'  ;
ALTER TABLE `binluu`.`credit_transactions` CHANGE COLUMN `date` `date` DATETIME NULL DEFAULT NULL  ;

