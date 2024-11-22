USE movie_theater;

INSERT INTO theaters (name, location) VALUES ('Theater 1', 'Town 1'), ('Theater 2', 'Town 2');
INSERT INTO movies (title, genre, release_date) VALUES ('Movie A', 'Action', '2024-10-01'), ('Movie B', 'SIFI', '2024-11-01');
INSERT INTO sales (theater_id, movie_id, sales_date, sales_amount)
VALUES (1, 1, '2024-10-02', 1000), (1, 2, '2024-10-09', 1500), (2, 1, '2024-11-02', 1200), (2, 2, '2024-11-09', 1800);
