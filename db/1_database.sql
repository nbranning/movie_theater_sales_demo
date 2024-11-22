CREATE DATABASE IF NOT EXISTS movie_theater;

CREATE USER 'movie_user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON movie_theater.* TO 'movie_user'@'localhost';
FLUSH PRIVILEGES;