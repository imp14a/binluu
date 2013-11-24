
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

INSERT INTO `binluu`.`interest_categories` (`name`) VALUES ('General');
INSERT INTO `binluu`.`interest_categories` (`name`) VALUES ('Medios de transporte');
INSERT INTO `binluu`.`interest_categories` (`name`) VALUES ('Ocupación');


INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Bebidas alcohólicas');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Películas de acción');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Deportes');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Música');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Danza');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Naturaleza');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Videojuegos');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Filosofía');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Psicología');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Fotografía');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Ciencia ficción');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Tecnología');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Historia ');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Animales ');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Arte');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Libros ');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Automóviles ');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Caricaturas');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Películas de comedia');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Computadoras ');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Diseño');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Finanzas');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Negocios ');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Deportes extremos');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Salud');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Gadgets');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Comida ');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Humor');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Internet');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Cine');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Religión');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Televisión');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Viajes');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Tatuajes');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('1', 'Futbol soccer');

INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES (2, 'Auto propio');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES (2, 'Motocicleta');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES (2, 'Bicicleta');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES (2, 'A pie');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES (2, 'Metro');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES (2, 'Transporte público');


#UPDATE `binluu`.`category_tags` SET `interest_category_id`='2' WHERE `id`='41';
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('3', 'Estudiante');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('3', 'Profesionista');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('3', 'Ventas ');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('3', 'Empleado general');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('3', 'Administrador');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('3', 'CEO,CTO');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('3', 'FreeLance');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('3', 'Gerente');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('3', 'Consultor');
INSERT INTO `binluu`.`category_tags` (`interest_category_id`, `name`) VALUES ('3', 'Medio tiempo');


ALTER TABLE `binluu`.`person_profiles` 
CHANGE COLUMN `budget` `max_budget` FLOAT NULL DEFAULT NULL ,
ADD COLUMN `transport` VARCHAR(180) NULL AFTER `sex`,
ADD COLUMN `min_budget` FLOAT NULL AFTER `transport`;


