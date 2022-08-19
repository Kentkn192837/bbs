CREATE TABLE `test` ( `id` MEDIUMINT AUTO_INCREMENT NOT NULL PRIMARY KEY ,
                      `name` VARCHAR(20) NOT NULL ,
                      `comment` VARCHAR(300) NOT NULL ,
                      `date` VARCHAR(100) NOT NULL
                    );

show columns from test;

alter table product add price int after id;
ALTER TABLE test add date VARCHAR(50) NOT NULL;

INSERT INTO test;


--users DBのsql情報
CREATE DATABASE users DEFAULT CHARACTER SET utf8 collate utf8_general_ci;
GRANT ALL ON users.* TO 'staff'@'localhost' IDENTIFIED BY 'password';

CREATE TABLE `user` ( `id`       MEDIUMINT AUTO_INCREMENT NOT NULL PRIMARY KEY ,
                      `name`     VARCHAR(50) NOT NULL,
                      `password` VARCHAR(50) NOT NULL,
                      `login`    VARCHAR(50) NOT NULL,
                      `address`  VARCHAR(50) NOT NULL);
