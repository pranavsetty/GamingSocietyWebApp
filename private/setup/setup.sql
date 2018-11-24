create database omega_db;
use omega_db;

CREATE TABLE Member
(
  memberID    INT AUTO_INCREMENT NOT NULL,
  title       VARCHAR(3)    NOT NULL,
  firstname   VARCHAR(20)   NOT NULL,
  surname     VARCHAR(30)   NOT NULL,
  DoB         DATE,
  phoneNo     CHAR(11),
  violations  INT,
  debt        INT,
  email       VARCHAR(30),
  homeAdress  VARCHAR(60),
  PRIMARY KEY (memberID)
);

CREATE TABLE Game
(
  gameID                INT AUTO_INCREMENT NOT NULL,
  cost                  INT           NOT NULL,
  type                  VARCHAR(20),
  platform              VARCHAR(20)   NOT NULL,
  ageLimit              INT           NOT NULL,
  name                  VARCHAR(40)   NOT NULL,
  isCurrentlyAvailable  BOOLEAN       NOT NULL,
  releaseYear           INT,
  imageLink             VARCHAR(5000)  NOT NULL,
  PRIMARY KEY (gameID)
);

CREATE TABLE Rental
(
  rentalID    INT AUTO_INCREMENT NOT NULL,
  memberID    INT NOT NULL,
  gameID      INT NOT NULL,
  extension   INT DEFAULT 1,
  period      INT NOT NULL,
  startDate   DATE NOT NULL,
  endDate     DATE NOT NULL,
  PRIMARY KEY (rentalID),
  FOREIGN KEY (memberID) REFERENCES Member(memberID),
  FOREIGN KEY (gameID) REFERENCES Game(gameID)
);

CREATE TABLE Ban
(
  memberID    INT   NOT NULL,
  startDate   DATE  NOT NULL,
  endDate     DATE  NOT NULL,
  period      INT   NOT NULL DEFAULT 6,
  FOREIGN KEY (memberID) REFERENCES Member(memberID)
);

CREATE TABLE Staff
(
  staffID     INT AUTO_INCREMENT NOT NULL,
  password    VARCHAR(20)   NOT NULL,
  title       VARCHAR(3)    NOT NULL,
  firstname   VARCHAR(20)   NOT NULL,
  surname     VARCHAR(30)   NOT NULL,
  DoB         DATE,
  phoneNo     CHAR(11),
  email       VARCHAR(30),
  homeAdress  VARCHAR(60),
  PRIMARY KEY (staffID)
);

CREATE TABLE Admin
(
  staffID INT NOT NULL,
  isCurrent BOOLEAN NOT NULL,
  FOREIGN KEY (staffID) REFERENCES Staff(staffID)
);


