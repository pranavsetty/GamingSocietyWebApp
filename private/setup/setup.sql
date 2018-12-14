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
  homeAddress  VARCHAR(60),
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
VALUES (DEFAULT, 13, "CD", "PS4", 18, "Grand Theft Auto", TRUE, 2014,"https://upload.wikimedia.org/wikipedia/en/a/a5/Grand_Theft_Auto_V.png", "Experience the world of Grand Theft Auto V like never before with the power of the PlayStation 4.
Explore the City of Los Santos, the countryside and even the ocean.
Play through an epic single player experience using three very different characters.
Join your friends in GTA Online and see what trouble you can cause.
Play golf, tennis, see a film or call someone and just hang out", "https://www.gamesradar.com/gta-5-review/"),
       (DEFAULT, 10, "CD", "Nintendo", 13, "Super Mario Bros", TRUE, 1985,"https://upload.wikimedia.org/wikipedia/en/4/4e/Mariobrothers.png", "Jump, bounce and power-up through visually stunning side-scrolling worlds filled with Mushroom Kingdom madness
The worlds are swarming with classic enemies like Goombas and Koopas, but watch out for new foes, big bosses and unbelievable challenges
As Mario and Luigi, two players can battle for stars on specially designed levels over local wireless. The game won't end until one bro. reigns supreme.", "https://uk.ign.com/articles/2007/03/06/super-mario-bros-vc-review"),
       (DEFAULT, 9, "CD", "Nintendo", 13, "Mario Kart", TRUE, 1992,"https://upload.wikimedia.org/wikipedia/en/8/80/MK8_Mario_Circuit.jpg", "The Mario Kart you know and love, with many new features; Enjoy Mario Kart alone or with friends, anytime, anywhere, with anyone; Supports 2 players in Handheld mode, 4 players on one TV and 12-player online
5 exclusive new characters join the tournament, including Inkling Boy and Inkling Girl; 4 exclusive new multiplayer Battle Modes including Balloon Battle and Bob-omb Blast; 48 Tracks; 40+ Racers; It's the biggest", "https://www.metacritic.com/game/wii/mario-kart-wii"),
       (DEFAULT, 20, "CD", "PS4", 16, "Fifa 19", TRUE, 2018,"https://upload.wikimedia.org/wikipedia/en/7/71/FIFA_19_cover.jpg", "EA Sports FIFA 19
       delivers a champion-caliber experience on and off the pitch. Introducing the prestigious UEFA Champions League, offering authentic in-match atmospheres, featuring gameplay updates including elevated on-pitch
       personality and a striking overhaul, and providing new and unrivaled ways to play. Champions Rise in FIFA 19.  ", "https://uk.ign.com/articles/2018/09/19/fifa-19-review"),
       (DEFAULT, 13, "CD", "XBOX", 18, "Call of Duty Black Ops 4", TRUE, 2018,"https://upload.wikimedia.org/wikipedia/en/1/1c/Call_of_Duty_Black_Ops_4_official_box_art.jpg", "Black Ops returns - in your face. Featuring gritty, grounded, fluid Multiplayer combat, a massive Zombies offering with 3 full undead adventures at launch, and Blackout, where the universe of Black Ops
        comes to life in one huge battle royale experience featuring the largest map in Call of Duty history, signature Black Ops combat,
       characters, locations and weapons from the entire Black Ops series. Soldier up for all-out combat – tailor made for the Black Ops community", "https://uk.ign.com/articles/2018/10/20/call-of-duty-black-ops-4-review"),
       (DEFAULT, 13, "CD", "XBOX", 15, "Destiny 2", TRUE, 2016,"https://upload.wikimedia.org/wikipedia/en/0/05/Destiny_2_%28artwork%29.jpg", "Destiny 2 is an online-only multiplayer first-person shooter video game developed by Bungie and published by Activision. It was released for PlayStation 4 and Xbox One on September 6, 2017, followed by a Microsoft Windows version the following month. It is the sequel to 2014's Destiny and its subsequent expansions", "https://www.eurogamer.net/articles/2017-09-15-destiny-2-review"),
       (DEFAULT, 12, "CD", "PC", 18, "God of War", TRUE, 2018,"https://upload.wikimedia.org/wikipedia/en/a/a7/God_of_War_4_cover.jpg", "God of War is an action-adventure video game developed by Santa Monica Studio and published by Sony Interactive Entertainment. Released on April 20, 2018, for the PlayStation 4 console, it is the eighth installment in the God of War series, the eighth chronologically, and the sequel to 2010's God of War III.", "https://uk.ign.com/articles/2018/04/12/god-of-war-review"),
       (DEFAULT, 9, "CD", "XBOX", 18, "Minecraft", TRUE, 2018,"https://upload.wikimedia.org/wikipedia/en/c/c9/Minecraft_Mobs.png", "Minecraft is a 2011 sandbox video game created by Swedish game developer Markus Persson and later developed by Mojang. The game allows players to build with a variety of different blocks in a 3D procedurally generated world, requiring creativity from players. ", "https://uk.ign.com/articles/2011/11/24/minecraft-review"),
       (DEFAULT, 9, "CD", "PC", 18, "Rise of Tomb Rider", TRUE, 2018,"https://upload.wikimedia.org/wikipedia/en/2/29/Rise_of_the_Tomb_Raider.jpg", "Rise of the Tomb Raider is an action-adventure video game developed by Crystal Dynamics. It is the sequel to the 2013 video game, Tomb Raider, and the eleventh entry in the Tomb Raider series. The game was released by Microsoft Studios for Xbox One and Xbox 360 in 2015", "https://uk.ign.com/games/rise-of-the-tomb-raider"),
       (DEFAULT, 10, "CD", "PC", 18, "Jurassic World - Evolution", TRUE, 2018,"https://upload.wikimedia.org/wikipedia/en/e/e6/Jurassic_World_Evolution_cover_art.jpg", "Jurassic World Evolution is a business simulation video game developed and published by Frontier Developments. Based on the 2015 film Jurassic World, the game was released on 12 June 2018, for Microsoft Windows, PlayStation 4 and Xbox One.", "https://store.steampowered.com/app/648350/Jurassic_World_Evolution/"),
       (DEFAULT, 12, "CD", "Nintendo", 18, "Assassin's Creed : Odyssey", TRUE, 2018,"https://upload.wikimedia.org/wikipedia/en/9/99/ACOdysseyCoverArt.png", "Assassin's Creed Odyssey is a 2018 action role-playing video game developed by Ubisoft Quebec and published by Ubisoft. It is the eleventh major installment, and twentieth overall, in the Assassin's Creed series and the successor to 2017's Assassin's Creed Origins.", "https://uk.ign.com/games/assassins-creed-odyssey"),
       (DEFAULT, 12, "CD", "Nintendo", 18, "Spiderman Animated", TRUE, 2016,"https://upload.wikimedia.org/wikipedia/en/1/1c/Spider-Man_The_Animated_Series_Cover.jpg", "Spider-Man is a side-scrolling action game developed by Western Technologies and published by Acclaim and LJN in 1995, incorporating elements from the critically acclaimed 1990s Spider-Man cartoon series. The game was released for the Genesis and the Super NES. ", "https://uk.ign.com/articles/2018/09/04/marvels-spider-man-ps4-review");

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
