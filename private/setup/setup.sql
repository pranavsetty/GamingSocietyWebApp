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
  period      INT   NOT NULL,
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


INSERT into Member
VALUES (DEFAULT, "Mrs", "Jane", "Doe", '1992-01-19', 92648936271, 0, 10, "jane@hotmail.co.uk", "SW1"),
       (DEFAULT, "Mr", "Bob", "Heggel", '1995-11-20', 9264592625, 0, 20, "bob@hotmail.co.uk", "EN2 7AJ"),
       (DEFAULT, "Mrs", "Maria", "Labarias", '1999-05-12', 9257385734, 1, 20, "maria@hotmail.co.uk", "EN2 8AJ");

INSERT into Game
VALUES (DEFAULT, 13, "CD", "PS4", 18, "Grand Theft Auto", TRUE, 2014);

INSERT into Rental
VALUES(DEFAULT, 1,1,1, '2', '2018-01-23','2018-02-02');

INSERT into Ban
VALUES(1, '2012-02-12','2012-02-20',2);

INSERT into Staff
VALUES (DEFAULT, "31gj34", "Sir", "James", "Smith", '1992-01-19', 98765434567, "james@gmail.com", "someRandomAddress"),
       (DEFAULT, "wef34", "Mr", "Adam", "Able", '1998-01-19', 98764342467, "adam@gmail.com", "someOtherRandomAddress"),
       (DEFAULT, "sdfsdf4", "Mrs", "Julia", "Vila", '1999-07-09', 94535434567, "julia@gmail.com", "someRandomAddress");

INSERT into Admin
VALUES(1, TRUE);
