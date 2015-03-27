CREATE TABLE `TheBestGameEver`.`LoginState` (
`tstart` DATETIME NOT NULL,
`tend` DATETIME NOT NULL,
`id` INT NOT NULL,
PRIMARY KEY (`tstart`, `tend`),
INDEX `id_idx` (`id` ASC));

CREATE TABLE `TheBestGameEver`.`Character` (
`name` VARCHAR(50) NOT NULL,
`health` INT NULL,
`age` INT NULL,
`CTID` INT NULL,
`ID` INT NULL ,
PRIMARY KEY (`name`),
INDEX `ID_players_idx` (`ID` ASC));

CREATE TABLE `TheBestGameEver`.`HasObject` (
`idHasObject` INT NOT NULL,
`name` VARCHAR(50) NULL,
`strength` INT NULL,
`power` VARCHAR(50) NULL,
`cName` VARCHAR(45) NULL,
PRIMARY KEY (`idHasObject`));

CREATE TABLE `TheBestGameEver`.`CreateObject` (
  `TimeStamp` int(11) NOT NULL,
  `ID` int(11) NOT NULL ,
  `OID` int(11) DEFAULT NULL,
  PRIMARY KEY (`TimeStamp`,`ID`),
  KEY `ID_idx` (`ID`));

CREATE TABLE `TheBestGameEver`.`CharacterType` (
`id` INT NOT NULL,
`name` VARCHAR(50) NULL,
`feature` VARCHAR(50) NULL,
`cost` INT NULL,
`adminId` INT NULL,
`timestamp` INT NULL,
PRIMARY KEY (`id`),
UNIQUE INDEX `name_UNIQUE` (`name` ASC),
INDEX `aId_idx` (`adminId` ASC));

CREATE TABLE `TheBestGameEver`.`Players` (
  `idPlayers` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NULL,
  `email` VARCHAR(75) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `coins` INT NULL,
  PRIMARY KEY (`idPlayers`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC));

CREATE TABLE `TheBestGameEver`.`Admin` (
  `idAdmin` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NULL,
  `email` VARCHAR(75) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idAdmin`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC));

ALTER TABLE `TheBestGameEver`.`LoginState` 
ADD CONSTRAINT `loginId`
FOREIGN KEY (`id`)
REFERENCES `TheBestGameEver`.`Players` (`idPlayers`)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE `TheBestGameEver`.`Character` 
ADD CONSTRAINT `ID_players`
FOREIGN KEY (`ID`)
REFERENCES `TheBestGameEver`.`Players` (`idPlayers`)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE `TheBestGameEver`.`HasObject` 
ADD CONSTRAINT `characterName`
FOREIGN KEY (`cName`)
REFERENCES `TheBestGameEver`.`Character` (`name`)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE `TheBestGameEver`.`CreateObject` 
ADD CONSTRAINT `createId`
FOREIGN KEY (`ID`)
REFERENCES `TheBestGameEver`.`Admin` (`idAdmin`)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE `TheBestGameEver`.`Character` 
ADD INDEX `characterTypeId_idx` (`ctId` ASC);
ALTER TABLE `TheBestGameEver`.`Character` 
ADD CONSTRAINT `characterTypeId`
FOREIGN KEY (`ctId`)
REFERENCES `TheBestGameEver`.`CharacterType` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE `TheBestGameEver`.`CreateObject` 
ADD INDEX `idHasObject_idx` (`OID` ASC);
ALTER TABLE `TheBestGameEver`.`CreateObject` 
ADD CONSTRAINT `idHasObject`
FOREIGN KEY (`OID`)
REFERENCES `TheBestGameEver`.`HasObject` (`idHasObject`)
ON DELETE CASCADE
ON UPDATE CASCADE;


ALTER TABLE `thebestgameever`.`Character` 
ADD COLUMN `playerId` INT NOT NULL AFTER `ID`;
ALTER TABLE `thebestgameever`.`Character` 
ADD INDEX `playerId_idx` (`playerId` ASC);
ALTER TABLE `thebestgameever`.`Character` 
ADD CONSTRAINT `playerId`
FOREIGN KEY (`playerId`)
REFERENCES `thebestgameever`.`Players` (`idPlayers`)
ON DELETE CASCADE
ON UPDATE CASCADE;
ALTER TABLE `thebestgameever`.`CreateObject` 
DROP FOREIGN KEY `createId`,
DROP FOREIGN KEY `idHasObject`;
ALTER TABLE `thebestgameever`.`CreateObject` 
CHANGE COLUMN `ID` `adminID` INT(11) NOT NULL ,
CHANGE COLUMN `OID` `objectID` INT(11) NULL DEFAULT NULL ;
ALTER TABLE `thebestgameever`.`CreateObject` 
ADD CONSTRAINT `createId`
FOREIGN KEY (`adminID`)
REFERENCES `thebestgameever`.`Admin` (`idAdmin`)
ON DELETE CASCADE
ON UPDATE CASCADE,
ADD CONSTRAINT `idHasObject`
FOREIGN KEY (`objectID`)
REFERENCES `thebestgameever`.`HasObject` (`idHasObject`)
ON DELETE CASCADE
ON UPDATE CASCADE;
ALTER TABLE `thebestgameever`.`CreateObject` 
ADD COLUMN `name` VARCHAR(50) NULL AFTER `objectID`,
ADD COLUMN `strength` INT NULL AFTER `name`,
ADD COLUMN `power` VARCHAR(50) NULL AFTER `strength`;
ALTER TABLE `thebestgameever`.`CreateObject` 
DROP FOREIGN KEY `idHasObject`;
DROP TABLE `thebestgameever`.`hasObject`;
ALTER TABLE `thebestgameever`.`Character` 
DROP FOREIGN KEY `characterTypeId`;
ALTER TABLE `thebestgameever`.`Character` 
CHANGE COLUMN `CTID` `characterTypeID` INT(11) NULL DEFAULT NULL ;
ALTER TABLE `thebestgameever`.`Character` 
ADD CONSTRAINT `characterTypeId`
FOREIGN KEY (`characterTypeID`)
REFERENCES `thebestgameever`.`CharacterType` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE;
ALTER TABLE `thebestgameever`.`Character` 
DROP FOREIGN KEY `ID_players`;
ALTER TABLE `thebestgameever`.`Character` 
DROP INDEX `ID_players_idx` ;
CREATE TABLE `thebestgameever`.`hasObject` (
`objectID` INT NOT NULL,
`characterID` INT NULL,
PRIMARY KEY (`objectID`));
ALTER TABLE `thebestgameever`.`hasObject` 
ADD CONSTRAINT `hasObjectId`
FOREIGN KEY (`objectID`)
REFERENCES `thebestgameever`.`CreateObject` (`objectID`)
ON DELETE CASCADE
ON UPDATE CASCADE;
ALTER TABLE `thebestgameever`.`hasObject` 
CHANGE COLUMN `characterID` `characterName` VARCHAR(50) NULL DEFAULT NULL ,
ADD UNIQUE INDEX `characterName_UNIQUE` (`characterName` ASC);
ALTER TABLE `thebestgameever`.`hasObject` 
ADD CONSTRAINT `hasCharacterName`
FOREIGN KEY (`characterName`)
REFERENCES `thebestgameever`.`Character` (`name`)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
ALTER TABLE `thebestgameever`.`Character` 


ALTER TABLE `TheBestGameEver`.`hasObject` 
DROP FOREIGN KEY `hasObjectId`;
ALTER TABLE `TheBestGameEver`.`CreateObject` 
CHANGE COLUMN `name` `name` VARCHAR(50) NOT NULL ,
CHANGE COLUMN `strength` `strength` INT(11) NOT NULL ,
CHANGE COLUMN `power` `power` VARCHAR(50) NOT NULL ;
ALTER TABLE `TheBestGameEver`.`CreateObject` 
CHANGE COLUMN `objectID` `objectID` INT(11) NOT NULL AUTO_INCREMENT ;
ALTER TABLE `TheBestGameEver`.`hasObject` 
ADD CONSTRAINT `objectID`
FOREIGN KEY (`objectID`)
REFERENCES `TheBestGameEver`.`CreateObject` (`objectID`)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
UNLOCK TABLES;


ALTER TABLE `TheBestGameEver`.`CharacterType` 
CHANGE COLUMN `timestamp` `timestamp` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `TheBestGameEver`.`hasObject` 
DROP FOREIGN KEY `objectID`;

ALTER TABLE `TheBestGameEver`.`CreateObject` 
CHANGE COLUMN `TimeStamp` `TimeStamp` DATETIME NOT NULL ;

ALTER TABLE `TheBestGameEver`.`hasObject` 
ADD CONSTRAINT `objectID`
  FOREIGN KEY (`objectID`)
  REFERENCES `TheBestGameEver`.`CreateObject` (`adminID`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;