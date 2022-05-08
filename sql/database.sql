CREATE TABLE `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cardnumber` varchar(45) NOT NULL,
  `cardname` varchar(45) NOT NULL,
  `month` varchar(45) NOT NULL,
  `year` varchar(45) NOT NULL,
  `cardcvv` varchar(45) NOT NULL,
  `cardtype` varchar(45) NOT NULL,
  `transactionid` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
