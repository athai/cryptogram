-- Some CREATE TABLE commands to set up Cryptogram's MySQL database. 

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `CryptogramUsers` (
	`UserID` char(6) NOT NULL,
	`username` varchar(20) NOT NULL,
	`email` varchar(40) NOT NULL,
	`password` varchar(20) NOT NULL,
	`profilePicture` varchar(20) DEFAULT NULL,
	`favoriteCryptid` varchar(20) DEFAULT '',
	`description` varchar(140) DEFAULT '',
	`isAdmin` tinyint(1) NOT NULL DEFAULT '0',
	`active` tinyint(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
