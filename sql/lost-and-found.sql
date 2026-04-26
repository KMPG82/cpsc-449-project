DROP DATABASE IF EXISTS LAF;
CREATE DATABASE LAF;

USE LAF;

CREATE TABLE USER (
    User_id INT AUTO_INCREMENT,
    Inserted_at TIMESTAMP NOT NULL,
    Email VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    
    PRIMARY KEY (User_id)
);

CREATE TABLE ITEM (
    Item_id INT AUTO_INCREMENT,
    Inserted_at TIMESTAMP NOT NULL,
    Location VARCHAR(50) NOT NULL,
    Description VARCHAR(250) NOT NULL,
    Title VARCHAR(50) NOT NULL, 
    Type VARCHAR(20) NOT NULL,
    Category VARCHAR(20) NOT NULL,
    Status VARCHAR(20) NOT NULL,
    Date DATE NOT NULL,
    Img VARCHAR(225) NOT NULL,
    User_id INT NOT NULL,

    PRIMARY KEY (Item_id),
    FOREIGN KEY (User_id) REFERENCES USER (User_id)
);

CREATE TABLE MESSAGE (
    Message_id INT AUTO_INCREMENT,
    Inserted_at TIMESTAMP NOT NULL,
    Content VARCHAR(250) NOT NULL,
	Sender_email VARCHAR(50) NOT NULL,
    Recipient_email VARCHAR(50) NOT NULL,
    Item_id INT NOT NULL,

    PRIMARY KEY (Message_id),
    FOREIGN KEY (Sender_email) REFERENCES USER (Email),
    FOREIGN KEY (Recipient_email) REFERENCES USER (Email),
    FOREIGN KEY (Item_id) REFERENCES ITEM (Item_id) ON DELETE CASCADE
);

CREATE TABLE NOTIFICATION (
    Notification_id INT AUTO_INCREMENT,
    Inserted_at TIMESTAMP NOT NULL,
	Sender_email VARCHAR(50) NOT NULL,
    Recipient_email VARCHAR(50) NOT NULL,
    Item_id INT NOT NULL,

    PRIMARY KEY (Notification_id),
    FOREIGN KEY (Sender_email) REFERENCES USER (Email),
    FOREIGN KEY (Recipient_email) REFERENCES USER (Email),
    FOREIGN KEY (Item_id) REFERENCES ITEM (Item_id) ON DELETE CASCADE
);

-- some dummy data for testing and demos
INSERT INTO `user` (`User_id`, `Inserted_at`, `Email`, `Password`) VALUES (NULL, current_timestamp(), 'user1@email.com', 'password1'), (NULL, current_timestamp(), 'user2@email.com', 'password2');
INSERT INTO `user` (`User_id`, `Inserted_at`, `Email`, `Password`) VALUES (NULL, current_timestamp(), 'user3@email.com', 'password3'), (NULL, current_timestamp(), 'user4@email.com', 'password4');
INSERT INTO `user` (`User_id`, `Inserted_at`, `Email`, `Password`) VALUES (NULL, current_timestamp(), 'user5@email.com', 'password5'), (NULL, current_timestamp(), 'user6@email.com', 'password6');
INSERT INTO `user` (`User_id`, `Inserted_at`, `Email`, `Password`) VALUES (NULL, current_timestamp(), 'user7@email.com', 'password7'), (NULL, current_timestamp(), 'user8@email.com', 'password8');
INSERT INTO `user` (`User_id`, `Inserted_at`, `Email`, `Password`) VALUES (NULL, current_timestamp(), 'user9@email.com', 'password9'), (NULL, current_timestamp(), 'user10@email.com', 'password10');

INSERT INTO `item` (`Item_id`, `Inserted_at`, `Location`, `Description`, `Title`, `Type`, `Category`, `Status`, `Date`, `Img`, `User_id`) VALUES (NULL, current_timestamp(), 'Cal State Fullerton', 'Found this wallet.', 'Found Wallet', 'Found', 'Wallets', 'Unresolved', '2026-03-01', './images/wallet1.webp', '1'), (NULL, current_timestamp(), 'Disneyland', 'I lost this purse, pls help', 'Lost Purse', 'Lost', 'Bags', 'Unresolved', '2026-02-20', './images/purse1.webp', '2');
INSERT INTO `item` (`Item_id`, `Inserted_at`, `Location`, `Description`, `Title`, `Type`, `Category`, `Status`, `Date`, `Img`, `User_id`) VALUES (NULL, current_timestamp(), 'LA Fitness', 'Lost my phone while working out.', 'Lost Phone', 'Lost', 'Electronics', 'Unresolved', '2026-03-01', './images/phone1.webp', '3'), (NULL, current_timestamp(), 'Universal Studios', 'I found black stone bracelets near one of the rides.', 'Found Bracelets', 'Found', 'Jewelry', 'Unresolved', '2026-02-20', './images/bracelet1.webp', '4');
INSERT INTO `item` (`Item_id`, `Inserted_at`, `Location`, `Description`, `Title`, `Type`, `Category`, `Status`, `Date`, `Img`, `User_id`) VALUES (NULL, current_timestamp(), 'Pollak Library', 'I found this near one of the computers in the library, it has a lot of stickers on it.', 'Found This Cool Hydroflask', 'Found', 'Bottles', 'Unresolved', '2026-03-01', './images/hydroflask1.webp', '5'), (NULL, current_timestamp(), 'Humaitites Building', 'I think I left my iPad in one of the classrooms in the Humaitites building. It has many stickers on it, pls message me if you found it.', 'Lost iPad', 'Lost', 'Electronics', 'Unresolved', '2026-03-08', './images/ipad1.jpg', '6');
INSERT INTO `item` (`Item_id`, `Inserted_at`, `Location`, `Description`, `Title`, `Type`, `Category`, `Status`, `Date`, `Img`, `User_id`) VALUES (NULL, current_timestamp(), 'Computer Science Building', 'I found a laptop in one of the classrooms in the CS building.', 'Found a Laptop', 'Found', 'Electronics', 'Unresolved', '2026-03-05', './images/laptop1.webp', '7'), (NULL, current_timestamp(), 'Kinesiology Building', 'I left my headphones in the kinesiology building in room KHS 104. I went back to get them and they were gone. If you found it please send me a message.', 'Lost Headphones', 'Lost', 'Electronics', 'Unresolved', '2026-03-13', './images/headphones1.jpg', '8');
INSERT INTO `item` (`Item_id`, `Inserted_at`, `Location`, `Description`, `Title`, `Type`, `Category`, `Status`, `Date`, `Img`, `User_id`) VALUES (NULL, current_timestamp(), 'Titan Student Union', 'Found a charger at one of the booths in the TSU.', 'Charger Found', 'Found', 'Electronics', 'Unresolved', '2026-03-07', './images/charger1.png', '9'), (NULL, current_timestamp(), 'Langsdorf Hall', 'I need help finidng my laptop charger. I think I last had it in Langsdorf Hall. If you have seen it or have it, please let me know.', 'Lost My Laptop Charger', 'Lost', 'Electronics', 'Unresolved', '2026-03-12', './images/charger2.webp', '10');

INSERT INTO `item` (`Item_id`, `Inserted_at`, `Location`, `Description`, `Title`, `Type`, `Category`, `Status`, `Date`, `Img`, `User_id`) VALUES
(NULL, current_timestamp(), 'Titan Student Union', 'Lost a gray hoodie near the food court.', 'Lost Gray Hoodie', 'Lost', 'Clothing', 'Unresolved', '2026-04-20', './images/hoodie1.jpg', '1'),
(NULL, current_timestamp(), 'Pollak Library', 'Found a black hoodie on a study chair.', 'Found Black Hoodie', 'Found', 'Clothing', 'Unresolved', '2026-04-21', './images/hoodie2.jpg', '2');

INSERT INTO `item` (`Item_id`, `Inserted_at`, `Location`, `Description`, `Title`, `Type`, `Category`, `Status`, `Date`, `Img`, `User_id`) VALUES
(NULL, current_timestamp(), 'Engineering Building', 'Found a denim jacket left in classroom.', 'Found Denim Jacket', 'Found', 'Clothing', 'Unresolved', '2026-04-22', './images/jacket1.jpg', '3'),
(NULL, current_timestamp(), 'Titan Gym', 'Lost a white baseball hat during workout.', 'Lost White Hat', 'Lost', 'Accessories', 'Unresolved', '2026-04-23', './images/hat1.jpg', '4');

INSERT INTO `item` (`Item_id`, `Inserted_at`, `Location`, `Description`, `Title`, `Type`, `Category`, `Status`, `Date`, `Img`, `User_id`) VALUES
(NULL, current_timestamp(), 'Pollak Library', 'Found a calculus textbook near the printer.', 'Found Math Book', 'Found', 'Books', 'Unresolved', '2026-04-24', './images/book1.jpg', '5'),
(NULL, current_timestamp(), 'Mihaylo Hall', 'Lost economics textbook after lecture.', 'Lost Economics Book', 'Lost', 'Books', 'Unresolved', '2026-04-25', './images/book2.jpg', '6');

INSERT INTO `item` (`Item_id`, `Inserted_at`, `Location`, `Description`, `Title`, `Type`, `Category`, `Status`, `Date`, `Img`, `User_id`) VALUES
(NULL, current_timestamp(), 'Student Recreation Center', 'Found student ID card near entrance.', 'Found Student ID Card', 'Found', 'Other', 'Unresolved', '2026-04-26', './images/id1.jpg', '7'),
(NULL, current_timestamp(), 'Titan Walk', 'Lost campus ID card between classes.', 'Lost Campus ID', 'Lost', 'Other', 'Unresolved', '2026-04-26', './images/id2.jpg', '8');

INSERT INTO `item` (`Item_id`, `Inserted_at`, `Location`, `Description`, `Title`, `Type`, `Category`, `Status`, `Date`, `Img`, `User_id`) VALUES
(NULL, current_timestamp(), 'Visual Arts Building', 'Found silver ring near art studio.', 'Found Silver Ring', 'Found', 'Jewelry', 'Unresolved', '2026-04-27', './images/ring2.jpg', '9'),
(NULL, current_timestamp(), 'Titan Gym', 'Lost black gym bag near locker room.', 'Lost Gym Bag', 'Lost', 'Bags', 'Unresolved', '2026-04-27', './images/gymbag1.jpg', '10');