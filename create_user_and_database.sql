CREATE DATABASE biko;
USE biko;
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin@biko.edu';
GRANT ALL PRIVILEGES ON *. * TO 'admin'@'localhost';