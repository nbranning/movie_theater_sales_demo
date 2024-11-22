# Movie Theater Sales

This project is a web application that displays movie theater sales data. It includes both a PHP and a Python backend, and a frontend built with HTML, CSS, and JavaScript.

## Project Structure

## Project Structure

```
api/
    php/
        config.php
        get_available_dates.php
        query.php
    python/
        app/
            config.py
            main.py
            requirements.txt
assets/
    css/
        datepicker.material.css
        datepicker.minimal.css
    js/
        datepicker.js
        main.js
composer.json
db/
    1_database.sql
    2_tables.sql
    3_data.sql
    3monthsSalesData.sql
index.html
package.json
README.md
```

## Installation

### PHP Backend

1. Install dependencies using Composer:
    ```sh
    composer install
    ```

2. Configure the database connection in `api/php/config.php`.

### Python Backend

1. Create a virtual environment and activate it:
    ```sh
    python -m venv venv
    source venv/bin/activate  # On Windows use `venv\Scripts\activate`
    ```

2. Install dependencies:
    ```sh
    pip install -r api/python/app/requirements.txt
    ```

3. Configure the database connection in `api/python/app/config.py`.

### Frontend

1. Install dependencies using npm:
    ```sh
    npm install
    ```

## Usage

### PHP Backend

1. Start the PHP server:
    ```sh
    php -S localhost:8000 -t api/php
    ```

### Python Backend

1. Start the Flask server:
    ```sh
    python api/python/app/main.py
    ```

### Frontend

1. Open `index.html` in your browser.

## API Endpoints

### PHP Backend

- `GET /api/php/get_available_dates.php`: Get available sales dates.
- `GET /api/php/query.php?date=YYYY-MM-DD`: Get sales data for a specific date.

### Python Backend

- `GET /api/get_available_dates`: Get available sales dates.
- `GET /api/query?date=YYYY-MM-DD`: Get sales data for a specific date.

## Database

The database schema and initial data are provided in the `db/` directory.

## License

This project is licensed under the MIT License.