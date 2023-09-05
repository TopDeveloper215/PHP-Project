CREATE TABLE detail (
user_id int(10) NOT NULL AUTO_INCREMENT,
name varchar(255) NOT NULL,
email varchar(255) NOT NULL,
contact int(15) NOT NULL,
password varchar(255) NOT NULL,
religion varchar(255) NOT NULL,
nationality varchar(255) NOT NULL,
gender varchar(255) NOT NULL,
qualification varchar(255) NOT NULL,
experience varchar(255) NOT NULL,
address1 varchar(255) NOT NULL,
address2 varchar(255) NOT NULL,
city varchar(255) NOT NULL,
pin int(10) NOT NULL,
state varchar(255) NOT NULL,
PRIMARY KEY (user_id)
)