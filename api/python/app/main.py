from flask import Flask, request, jsonify
import mysql.connector
from config import DB_CONFIG
from datetime import datetime
from flask_cors import CORS


app = Flask(__name__)
CORS(app) 

def get_db_connection():
    try:
        conn = mysql.connector.connect(**DB_CONFIG)
        return conn
    except mysql.connector.Error as err:
        print(f"Error: {err}")
        return None


@app.route('/api/query', methods=['GET'])
def query():
    return_json = {
        'success': False,
    }

    sales_date = request.args.get('date')
    if sales_date and not datetime.strptime(sales_date, '%Y-%m-%d'):
        return_json['message'] = 'Invalid date format'
        return jsonify(return_json)

    if sales_date:
        conn = get_db_connection()
        cursor = conn.cursor(dictionary=True)
        cursor.execute("""
            SELECT theater_id, SUM(sales_amount) as total_sales 
            FROM sales 
            WHERE sales_date = %s
            GROUP BY theater_id 
            ORDER BY total_sales DESC 
            LIMIT 1
        """, (sales_date,))
        row = cursor.fetchone()

        if row:

            theater_id = row['theater_id']
            total_sales = row['total_sales']
            cursor.execute("SELECT * FROM theaters WHERE id = %s", (theater_id,))
            theater = cursor.fetchone()
            return_json['success'] = True
            return_json['data'] = {
                'theater': theater,
                'total_sales': total_sales
            }
        else:
            return_json['message'] = 'No data found'
        
        conn.close()
    else:
        return_json['message'] = 'Invalid date'

    return jsonify(return_json)


@app.route('/api/get_available_dates', methods=['GET'])
def get_available_dates():
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("SELECT sales_date FROM sales GROUP BY sales_date")
    rows = cursor.fetchall()

    dates = [row[0].strftime('%Y-%m-%d') for row in rows]

    conn.close()

    return jsonify(dates)



if __name__ == '__main__':
    app.run(debug=True)
