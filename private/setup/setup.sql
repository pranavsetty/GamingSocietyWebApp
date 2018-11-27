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

INSERT into Member
VALUES (DEFAULT, "Mrs", "Jane", "Doe", '1992-01-19', 92648936271, 0, 10, "jane@hotmail.co.uk", "SW1"),
       (DEFAULT, "Mr", "Bob", "Heggel", '1995-11-20', 9264592625, 0, 20, "bob@hotmail.co.uk", "EN2 7AJ"),
       (DEFAULT, "Mrs", "Maria", "Labarias", '1999-05-12', 9257385734, 1, 20, "maria@hotmail.co.uk", "EN2 8AJ");

INSERT into Game
VALUES (DEFAULT, 13, "CD", "PS4", 18, "Grand Theft Auto", TRUE, 2014,"https://www.google.co.uk/search?q=gta+5&source=lnms&tbm=isch&sa=X&ved=0ahUKEwj_k9j7_uLeAhUMMewKHbt5AGEQ_AUIESgE#imgrc=SSJk5vZAa-ixbM:"),
       (DEFAULT, 10, "CD", "Nintendo", 13, "Mario Bros", TRUE, 1985,"https://www.google.co.uk/search?q=mario+bros&source=lnms&tbm=isch&sa=X&ved=0ahUKEwiZ0uqMgOPeAhVKM-wKHcorCAoQ_AUIDigB&biw=1163&bih=526#imgrc=ANzp8ddFhIm74M:"),
       (DEFAULT, 12, "CD", "PS2", 18, "Grand Theft Auto Vice City", TRUE, 2002,"https://www.google.co.uk/search?tbm=isch&q=grand+theft+auto+vice+city&chips=q:grand+theft+auto+vice+city,g_1:ps2:wTgMP36g-j0%3D&usg=AI4_-kRxCB2c0jE1prl79T510ToWz9ofLg&sa=X&ved=0ahUKEwiHjYSlgOPeAhVmMOwKHXaICEMQ4lYIKCgB&biw=1163&bih=526&dpr=1.65#imgrc=DjdEe1karA--WM:"),
       (DEFAULT, 9, "CD", "Nintendo", 13, "Mario Kart", TRUE, 1992,"https://www.google.co.uk/search?biw=1163&bih=526&tbm=isch&sa=1&ei=7QL0W9icNcPTsAfJop2YCg&q=mario+kart+&oq=mario+kart+&gs_l=img.3...8957.8957..9156...0.0..0.0.0.......0....1..gws-wiz-img.9qqAZQAzm90#imgrc=iOkbSPaA2dG98M:"),
       (DEFAULT, 20, "CD", "PS4", 16, "Fifa 19", TRUE, 2018,"https://www.google.co.uk/search?q=fifa+19&source=lnms&tbm=isch&sa=X&ved=0ahUKEwjDz6fZgePeAhWKsqQKHRP3A-oQ_AUIESgE&biw=1163&bih=526#imgrc=E7s1fKt4SQ_FsM:"),
       (DEFAULT, 13, "CD", "XBOX", 18, "Call of Duty Black Ops 4", TRUE, 2018,"https://www.google.co.uk/search?q=call+of+duty+black+ops+4&source=lnms&tbm=isch&sa=X&ved=0ahUKEwjM-N32gePeAhXFyaQKHdptASkQ_AUIESgE&biw=1163&bih=526#imgrc=hAaSLQo3beZw-M:");

INSERT into Rental
VALUES(DEFAULT, 1,1,DEFAULT, '2', '2018-01-23','2018-02-02');

INSERT into Ban
VALUES(1, '2012-02-12','2012-02-20',DEFAULT);

INSERT into Staff
VALUES (DEFAULT, "12345", "Sir", "James", "Smith", '1992-01-19', 98765434567, "james@gmail.com", "someRandomAddress"),
       (DEFAULT, "123456", "Mr", "Adam", "Able", '1998-01-19', 98764342467, "adam@gmail.com", "someOtherRandomAddress"),
       (DEFAULT, "1234567", "Mrs", "Julia", "Vila", '1999-07-09', 94535434567, "julia@gmail.com", "someRandomAddress");

INSERT into Admin
VALUES(1, TRUE);
