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
  violations  INT DEFAULT 0,
  debt        INT DEFAULT 0,
  email       VARCHAR(30),
  homeAddress  VARCHAR(60),
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
  gameDescription       VARCHAR(5000),
  link                  VARCHAR(5000),
  PRIMARY KEY (gameID)
);

CREATE TABLE Rental
(
  rentalID    INT AUTO_INCREMENT NOT NULL,
  memberID    INT NOT NULL,
  gameID      INT NOT NULL,
  extension   INT DEFAULT 0,
  period      INT NOT NULL DEFAULT 3,
  startDate   DATE NOT NULL,
  returnDate  DATE DEFAULT NULL,
  PRIMARY KEY (rentalID),
  FOREIGN KEY (memberID) REFERENCES Member(memberID),
  FOREIGN KEY (gameID) REFERENCES Game(gameID)
);

CREATE TABLE Ban
(
  memberID    INT   NOT NULL,
  startDate   DATE  NOT NULL,
  endDate     DATE,
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
  homeAddress  VARCHAR(60),
  PRIMARY KEY (staffID)
);

CREATE TABLE Admin
(
  staffID INT NOT NULL,
  isCurrent BOOLEAN NOT NULL,
  FOREIGN KEY (staffID) REFERENCES Staff(staffID)
);

CREATE TABLE Rules
(
  description VARCHAR(60) NOT NULL UNIQUE,
  value INT NOT NULL
);

INSERT into Member
VALUES (DEFAULT, "Mrs", "Jane", "Doe", '1992-01-19', 92648936271, 0, 10, "jane@hotmail.co.uk", "SW1"),
       (DEFAULT, "Mr", "Bob", "Heggel", '1995-11-20', 9264592625, 0, 20, "bob@hotmail.co.uk", "EN2 7AJ"),
       (DEFAULT, "Mrs", "Maria", "Labarias", '1999-05-12', 9257385734, 1, 20, "maria@hotmail.co.uk", "EN2 8AJ");

INSERT into Game
VALUES (DEFAULT, 13, "CD", "PS4", 18, "Grand Theft Auto", TRUE, 2014,"https://vignette.wikia.nocookie.net/grand-theft-auto/images/9/9e/Gta_vcs_wallpaper_soldiers.jpg/revision/latest?cb=20110126215723", "
Experience the world of Grand Theft Auto V like never before with the power of the PlayStation 4.
Explore the City of Los Santos, the countryside and even the ocean.
Play through an epic single player experience using three very different characters.
Join your friends in GTA Online and see what trouble you can cause.
Play golf, tennis, see a film or call someone and just hang out ", "https://www.gamesradar.com/gta-5-review/"),
       (DEFAULT, 10, "CD", "Nintendo", 13, "Super Mario Bros", TRUE, 1985,"https://vignette.wikia.nocookie.net/grand-theft-auto/images/9/9e/Gta_vcs_wallpaper_soldiers.jpg/revision/latest?cb=20110126215723",
        "Jump, bounce and power-up through visually stunning side-scrolling worlds filled with Mushroom Kingdom madness
The worlds are swarming with classic enemies like Goombas and Koopas, but watch out for new foes, big bosses and unbelievable challenges
As Mario and Luigi, two players can battle for stars on specially designed levels over local wireless. The game won't end until one bro. reigns supreme.", "https://uk.ign.com/articles/2007/03/06/super-mario-bros-vc-review"),
       (DEFAULT, 9, "CD", "Nintendo", 13, "Mario Kart", TRUE, 1992,"https://vignette.wikia.nocookie.net/grand-theft-auto/images/9/9e/Gta_vcs_wallpaper_soldiers.jpg/revision/latest?cb=20110126215723", "
The Mario Kart you know and love, with many new features; Enjoy Mario Kart alone or with friends, anytime, anywhere, with anyone; Supports 2 players in Handheld mode, 4 players on one TV and 12-player online
5 exclusive new characters join the tournament, including Inkling Boy and Inkling Girl; 4 exclusive new multiplayer Battle Modes including Balloon Battle and Bob-omb Blast; 48 Tracks; 40+ Racers; It's the biggest",
        "https://www.metacritic.com/game/wii/mario-kart-wii"),
       (DEFAULT, 20, "CD", "PS4", 16, "Fifa 19", TRUE, 2018,"https://vignette.wikia.nocookie.net/grand-theft-auto/images/9/9e/Gta_vcs_wallpaper_soldiers.jpg/revision/latest?cb=20110126215723", " EA Sports FIFA 19
       delivers a champion-caliber experience on and off the pitch. Introducing the prestigious UEFA Champions League, offering authentic in-match atmospheres, featuring gameplay updates including elevated on-pitch
       personality and a striking overhaul, and providing new and unrivaled ways to play. Champions Rise in FIFA 19.  ", "https://www.metacritic.com/game/playstation-4/fifa-19"),
       (DEFAULT, 13, "CD", "XBOX", 18, "Call of Duty Black Ops 4", TRUE, 2018,"https://vignette.wikia.nocookie.net/grand-theft-auto/images/9/9e/Gta_vcs_wallpaper_soldiers.jpg/revision/latest?cb=20110126215723",
        "Black Ops returns - in your face. Featuring gritty, grounded, fluid Multiplayer combat, a massive Zombies offering with 3 full undead adventures at launch, and Blackout, where the universe of Black Ops
        comes to life in one huge battle royale experience featuring the largest map in Call of Duty history, signature Black Ops combat,
       characters, locations and weapons from the entire Black Ops series. Soldier up for all-out combat – tailor made for the Black Ops community", "https://www.metacritic.com/game/playstation-4/call-of-duty-black-ops-4");

INSERT into Rental
VALUES(DEFAULT, 1,1,DEFAULT, DEFAULT, '2018-12-01',DEFAULT),
      (DEFAULT, 2,2,DEFAULT, DEFAULT, '2018-11-29',DEFAULT),
      (DEFAULT, 3,3,DEFAULT, DEFAULT,'2018-05-22',DEFAULT);

INSERT into Ban
VALUES(1, '2012-02-12','2012-02-20',DEFAULT);

INSERT into Staff
VALUES (DEFAULT, "12345", "Sir", "James", "Smith", '1992-01-19', 98765434567, "james@gmail.com", "someRandomAddress"),
       (DEFAULT, "123456", "Mr", "Adam", "Able", '1998-01-19', 98764342467, "adam@gmail.com", "someOtherRandomAddress"),
       (DEFAULT, "1234567", "Mrs", "Julia", "Vila", '1999-07-09', 94535434567, "julia@gmail.com", "someRandomAddress");

INSERT into Admin
VALUES(1, TRUE);

INSERT into Rules
VALUES("period in weeks", 2),
      ("max number of games at once", 2),
      ("extension period in weeks", 1),
      ("max number of extensions", 2),
      ("max violations per year", 3),
      ("ban period", 3);
