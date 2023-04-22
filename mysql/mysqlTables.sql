CREATE TABLE `User` (
  `idUser` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`idUser`)
);
CREATE TABLE `Friendship` (
  `idFriendship` int(11) NOT NULL AUTO_INCREMENT,
  `idUser1` int(11) NOT NULL,
  `idUser2` int(11) NOT NULL,
  PRIMARY KEY (`idFriendship`)
);
CREATE TABLE `Chat` (
  `idChat` int(11) NOT NULL AUTO_INCREMENT,
  `idFriendship` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `content` varchar(512) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`idChat`)
);

CREATE TABLE `FriendRequests` (
  `idRequest` int(11) NOT NULL AUTO_INCREMENT,
  `idUserRequesting` int(4) NOT NULL,
  `idUserAsked` int(4) NOT NULL,
  PRIMARY KEY (`idRequest`)
);

