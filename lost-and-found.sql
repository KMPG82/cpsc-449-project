DROP DATABASE IF EXISTS LAF;
CREATE DATABASE LAF;

USE LAF;

CREATE TABLE USER (
    User_id INT AUTO_INCREMENT,
    Inserted_at TIMESTAMP NOT NULL,
    Email VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(50) NOT NULL,
    
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
    Img VARCHAR(100) NOT NULL,
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
    FOREIGN KEY (Item_id) REFERENCES ITEM (Item_id)
);

INSERT INTO `user` (`User_id`, `Inserted_at`, `Email`, `Password`) VALUES (NULL, current_timestamp(), 'user1@email.com', 'password1'), (NULL, current_timestamp(), 'user2@email.com', 'password2');
INSERT INTO `item` (`Item_id`, `Inserted_at`, `Location`, `Description`, `Title`, `Type`, `Category`, `Status`, `Date`, `Img`, `User_id`) VALUES (NULL, current_timestamp(), 'Test location', 'Found this wallet.', 'Found Wallet', 'Found', 'Wallet', 'Unresolved', '2026-03-01', './images/wallet1.webp', '1'), (NULL, current_timestamp(), 'Another location', 'I lost this purse, pls help', 'Lost Purse', 'Lost', 'Bag', 'Unresolved', '2026-02-20', './images/purse1.webp', '2');
INSERT INTO `message` (`Message_id`, `Inserted_at`, `Content`, `Sender_email`, `Recipient_email`, `Item_id`) VALUES (NULL, current_timestamp(), 'I think this might be my wallet', 'user2@email.com', 'user1@email.com', '1');
