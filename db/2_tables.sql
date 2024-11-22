USE movie_theater;

DROP TABLE IF EXISTS theaters;
CREATE TABLE theaters (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    location VARCHAR(255)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS movies;
CREATE TABLE movies (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    genre VARCHAR(255),
    release_date DATE
) ENGINE=InnoDB;

DROP TABLE IF EXISTS sales;
CREATE TABLE sales (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    theater_id INT(11),
    movie_id INT(11),
    sales_date DATE,
    sales_amount DECIMAL(10, 2),
    FOREIGN KEY (theater_id) REFERENCES theaters(id),
    FOREIGN KEY (movie_id) REFERENCES movies(id)
) ENGINE=InnoDB;
