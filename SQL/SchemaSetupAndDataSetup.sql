DROP SCHEMA `TheBestGameEver`;

CREATE SCHEMA `TheBestGameEver` ;

CREATE TABLE `TheBestGameEver`.`LoginState` (
`tstart` DATETIME NOT NULL,
`tend` DATETIME NOT NULL,
`id` INT NOT NULL,
PRIMARY KEY (`tstart`, `tend`),
INDEX `id_idx` (`id` ASC));

CREATE TABLE `TheBestGameEver`.`Character` (
  `name` VARCHAR(50) NOT NULL,
  `health` INT(11) NULL DEFAULT NULL,
  `age` INT(11) NULL DEFAULT NULL,
  `characterTypeID` INT(11) NULL DEFAULT NULL,
  `PlayerId` INT(11) NOT NULL,
  PRIMARY KEY (`name`));

CREATE TABLE `TheBestGameEver`.`CreateObject` (
  `TimeStamp` DATETIME NOT NULL,
  `adminID` INT(11) NOT NULL,
  `objectID` INT(11) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `strength` INT(11) NOT NULL,
  `power` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`adminID`, `TimeStamp`)) ;
  CREATE INDEX `OID_idx` ON `TheBestGameEver`.`CreateObject`(`objectID` ASC);
  
CREATE TABLE `TheBestGameEver`.`hasObject` (
  `objectID` INT(11) NOT NULL,
  `characterName` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`objectID`));
  
CREATE TABLE `TheBestGameEver`.`CharacterType` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NULL DEFAULT NULL,
  `feature` VARCHAR(50) NULL DEFAULT NULL,
  `cost` INT(11) NULL DEFAULT NULL,
  `adminid` INT(11) NULL DEFAULT NULL,
  `timestamp` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC));
  
CREATE TABLE `TheBestGameEver`.`Players` (
  `idPlayers` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NULL DEFAULT NULL,
  `email` VARCHAR(75) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `coins` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idPlayers`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC));
  
CREATE TABLE `TheBestGameEver`.`Admin` (
  `idAdmin` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NULL DEFAULT NULL,
  `email` VARCHAR(75) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idAdmin`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC));
  
ALTER TABLE `TheBestGameEver`.`LoginState` 
ADD CONSTRAINT `id`
  FOREIGN KEY (`id`)
  REFERENCES `TheBestGameEver`.`Players` (`idPlayers`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
  
ALTER TABLE `TheBestGameEver`.`Character` 
ADD INDEX `PlayerId_idx` (`PlayerId` ASC),
ADD INDEX `characterTypeId_idx` (`characterTypeID` ASC);
ALTER TABLE `TheBestGameEver`.`Character` 
ADD CONSTRAINT `PlayerId`
  FOREIGN KEY (`PlayerId`)
  REFERENCES `TheBestGameEver`.`Players` (`idPlayers`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `characterTypeId`
  FOREIGN KEY (`characterTypeID`)
  REFERENCES `TheBestGameEver`.`CharacterType` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
  
ALTER TABLE `TheBestGameEver`.`hasObject` 
ADD INDEX `characterName_idx` (`characterName` ASC);
ALTER TABLE `TheBestGameEver`.`hasObject` 
ADD CONSTRAINT `objectID`
  FOREIGN KEY (`objectID`)
  REFERENCES `TheBestGameEver`.`CreateObject` (`adminID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `characterName`
  FOREIGN KEY (`characterName`)
  REFERENCES `TheBestGameEver`.`Character` (`name`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
  
ALTER TABLE `TheBestGameEver`.`CreateObject` 
ADD CONSTRAINT `adminID`
  FOREIGN KEY (`adminID`)
  REFERENCES `TheBestGameEver`.`Admin` (`idAdmin`)
  ON DELETE NO ACTION
  ON UPDATE CASCADE;
  
ALTER TABLE `TheBestGameEver`.`CharacterType` 
ADD CONSTRAINT `adID`
  FOREIGN KEY (`adminid`)
  REFERENCES `TheBestGameEver`.`Admin` (`idAdmin`)
  ON DELETE NO ACTION
  ON UPDATE CASCADE;
  
ALTER TABLE `TheBestGameEver`.`hasObject` 
DROP FOREIGN KEY `characterName`;
ALTER TABLE `TheBestGameEver`.`hasObject` 
CHANGE COLUMN `characterName` `characterName` VARCHAR(50) NOT NULL ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`objectID`, `characterName`);
ALTER TABLE `TheBestGameEver`.`hasObject` 
ADD CONSTRAINT `characterName`
  FOREIGN KEY (`characterName`)
  REFERENCES `TheBestGameEver`.`Character` (`name`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
  
ALTER TABLE `TheBestGameEver`.`hasObject` 
DROP FOREIGN KEY `objectID`;
ALTER TABLE `TheBestGameEver`.`CreateObject` 
CHANGE COLUMN `objectID` `objectID` INT(11) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `TheBestGameEver`.`hasObject` 
ADD CONSTRAINT `objectID`
FOREIGN KEY (`objectID`)
REFERENCES `TheBestGameEver`.`CreateObject` (`objectID`)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

INSERT INTO `TheBestGameEver`.`Admin` (`idAdmin`, `name`, `email`, `password`) VALUES ('1000001', 'Bob', 'bob@bob.com', 'funtimes');
INSERT INTO `TheBestGameEver`.`Admin` (`idAdmin`, `name`, `email`, `password`) VALUES ('1000002', 'Nancy', 'nancy@gmail.com', 'funtimes');
INSERT INTO `TheBestGameEver`.`Admin` (`idAdmin`, `name`, `email`, `password`) VALUES ('1000003', 'Chris', 'Chris@games.com', '34games');
INSERT INTO `TheBestGameEver`.`Admin` (`idAdmin`, `name`, `email`, `password`) VALUES ('1000004', 'Mike', 'mikl@gmail.com', '@gm333');
INSERT INTO `TheBestGameEver`.`Admin` (`idAdmin`, `name`, `email`, `password`) VALUES ('1000005', 'Karen', 'karkar@mail.com', 'password');

INSERT INTO `TheBestGameEver`.`Players` (`idPlayers`, `name`, `email`, `password`, `coins`) VALUES ('2000001', 'Alice', 'alice@fun.com', 'dog54', '500');
INSERT INTO `TheBestGameEver`.`Players` (`idPlayers`, `name`, `email`, `password`, `coins`) VALUES ('2000002', 'Hannah', 'hannah@gmail.com', 'cat34', '123');
INSERT INTO `TheBestGameEver`.`Players` (`idPlayers`, `name`, `email`, `password`, `coins`) VALUES ('2000003', 'Benny', 'benny@gmail.com', 'gym500', '12');
INSERT INTO `TheBestGameEver`.`Players` (`idPlayers`, `name`, `email`, `password`, `coins`) VALUES ('2000004', 'Hannah', 'skurnik@gmail.com', 'table!', '60');
INSERT INTO `TheBestGameEver`.`Players` (`idPlayers`, `name`, `email`, `password`, `coins`) VALUES ('2000005', 'Joanna', 'jojo@hotmail.com', 'ree123', '620');

INSERT INTO `TheBestGameEver`.`LoginState` (`tstart`, `tend`, `id`) VALUES ('2015-03-24 07:43:58', '2015-03-24 07:44:50', '2000001');
INSERT INTO `TheBestGameEver`.`LoginState` (`tstart`, `tend`, `id`) VALUES ('2015-03-25 10:23:13', '2015-03-25 11:43:02', '2000001');
INSERT INTO `TheBestGameEver`.`LoginState` (`tstart`, `tend`, `id`) VALUES ('2015-03-26 11:03:45', '2015-03-26 11:23:22', '2000005');
INSERT INTO `TheBestGameEver`.`LoginState` (`tstart`, `tend`, `id`) VALUES ('2015-03-26 02:13:32', '2015-03-26 02:33:58', '2000003');
INSERT INTO `TheBestGameEver`.`LoginState` (`tstart`, `tend`, `id`) VALUES ('2015-03-26 03:03:45', '2015-03-26 04:00:12', '2000004');

INSERT INTO `TheBestGameEver`.`CharacterType` (`id`, `name`, `feature`, `cost`, `adminId`, `timestamp`) VALUES ('10', 'Dwarf', 'Good fighters, extra strength', '200', '1000001', '2015-03-30 07:43:58');
INSERT INTO `TheBestGameEver`.`CharacterType` (`id`, `name`, `feature`, `cost`, `adminId`, `timestamp`) VALUES ('11', 'Elf', 'Smart, quiet', '350', '1000002', '2015-03-30 08:24:09');
INSERT INTO `TheBestGameEver`.`CharacterType` (`id`, `name`, `feature`, `cost`, `adminId`, `timestamp`) VALUES ('12', 'Hobbit', 'Brave, quick', '180', '1000001', '2015-03-30 03:34:57');
INSERT INTO `TheBestGameEver`.`CharacterType` (`id`, `name`, `feature`, `cost`, `adminId`, `timestamp`) VALUES ('13', 'Wizard', 'Powerful, smart', '400', '1000003', '2015-03-30 05:13:32');
INSERT INTO `TheBestGameEver`.`CharacterType` (`id`, `name`, `feature`, `cost`, `adminId`, `timestamp`) VALUES ('14', 'Man', 'Smart, quick', '180', '1000005', '2015-03-30 07:25:34');

INSERT INTO `TheBestGameEver`.`Character` (`name`, `health`, `age`, `characterTypeID`, `playerId`) VALUES ('Frodo', '2', '1', '12', '2000001');
INSERT INTO `TheBestGameEver`.`Character` (`name`, `health`, `age`, `characterTypeID`, `playerId`) VALUES ('Gandalf', '10', '2', '13', '2000002');
INSERT INTO `TheBestGameEver`.`Character` (`name`, `health`, `age`, `characterTypeID`, `playerId`) VALUES ('Sauron', '9', '1', '13', '2000003');
INSERT INTO `TheBestGameEver`.`Character` (`name`, `health`, `age`, `characterTypeID`, `playerId`) VALUES ('Legalus', '8', '3', '11', '2000004');
INSERT INTO `TheBestGameEver`.`Character` (`name`, `health`, `age`, `characterTypeID`, `playerId`) VALUES ('Gimli', '7', '2', '10', '2000005');

INSERT INTO `TheBestGameEver`.`CreateObject` (`TimeStamp`, `adminID`, `objectID`, `name`, `strength`, `power`) VALUES ('2015-03-20 07:25:34', '1000002', '4000001', 'Ring', '200', 'damage');
INSERT INTO `TheBestGameEver`.`CreateObject` (`TimeStamp`, `adminID`, `objectID`, `name`, `strength`, `power`) VALUES ('2015-03-21 16:33:25', '1000003', '4000002', 'Wand', '100', 'spell');
INSERT INTO `TheBestGameEver`.`CreateObject` (`TimeStamp`, `adminID`, `objectID`, `name`, `strength`, `power`) VALUES ('2015-03-21 09:20:14', '1000003', '4000003', 'Armor', '50', 'protection');
INSERT INTO `TheBestGameEver`.`CreateObject` (`TimeStamp`, `adminID`, `objectID`, `name`, `strength`, `power`) VALUES ('2015-03-22 03:26:35', '1000004', '4000004', 'Sword', '80', 'damage');
INSERT INTO `TheBestGameEver`.`CreateObject` (`TimeStamp`, `adminID`, `objectID`, `name`, `strength`, `power`) VALUES ('2015-03-22 08:24:23', '1000005', '4000005', 'Ring', '180', 'damage');
INSERT INTO `TheBestGameEver`.`CreateObject` (`TimeStamp`, `adminID`, `objectID`, `name`, `strength`, `power`) VALUES ('2015-03-22 07:10:34', '1000001', '4000006', 'Sword', '100', 'damage');
INSERT INTO `TheBestGameEver`.`CreateObject` (`TimeStamp`, `adminID`, `objectID`, `name`, `strength`, `power`) VALUES ('2015-03-23 09:26:37', '1000001', '4000007', 'Armor', '120', 'protection');
INSERT INTO `TheBestGameEver`.`CreateObject` (`TimeStamp`, `adminID`, `objectID`, `name`, `strength`, `power`) VALUES ('2015-03-23 05:36:18', '1000004', '4000008', 'Sword', '110', 'damage');
INSERT INTO `TheBestGameEver`.`CreateObject` (`TimeStamp`, `adminID`, `objectID`, `name`, `strength`, `power`) VALUES ('2015-03-24 12:35:56', '1000003', '4000009', 'Sword', '90', 'damage');
INSERT INTO `TheBestGameEver`.`CreateObject` (`TimeStamp`, `adminID`, `objectID`, `name`, `strength`, `power`) VALUES ('2015-03-24 07:27:36', '1000002', '4000010', 'Ring', '150', 'damage');


INSERT INTO `TheBestGameEver`.`hasObject` (`objectID`, `characterName`) VALUES ('4000006', 'Frodo');
INSERT INTO `TheBestGameEver`.`hasObject` (`objectID`, `characterName`) VALUES ('4000002', 'Gandalf');
INSERT INTO `TheBestGameEver`.`hasObject` (`objectID`, `characterName`) VALUES ('4000008', 'Gimli');
INSERT INTO `TheBestGameEver`.`hasObject` (`objectID`, `characterName`) VALUES ('4000003', 'Gimli');
INSERT INTO `TheBestGameEver`.`hasObject` (`objectID`, `characterName`) VALUES ('4000004', 'Legalus');
INSERT INTO `TheBestGameEver`.`hasObject` (`objectID`, `characterName`) VALUES ('4000001', 'Gandalf');
INSERT INTO `TheBestGameEver`.`hasObject` (`objectID`, `characterName`) VALUES ('4000010', 'Gimli');


  




  

  
