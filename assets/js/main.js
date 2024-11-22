let datepicker;

let api_type = 'py';
let base_url = 'http://demo.dvl.to/';
let api_url_get_available_dates = 'api/php/get_available_dates.php';
let api_url_query = 'api/php/query.php';

// python switch
if(api_type != 'php'){
    base_url = 'http://demo-flask.dvl.to/';
    api_url_get_available_dates = 'api/get_available_dates';
    api_url_query = 'api/query';
}


window.onload = function() {
    getAvailableDates();
};

function getAvailableDates(){
    let availableDates = [];
    fetch(base_url + api_url_get_available_dates)
        .then(response => response.json())
        .then(data => {
            availableDates = data.map(date => {
                let dateArray = date.split('-');
                let newDate = new Date(dateArray[0], dateArray[1] - 1, dateArray[2]);
                return newDate;
            });
            datepicker = new Datepicker('#datepicker', {
                onChange: (date) => {
                    if(date){
                        getData(date);
                    }
                },
                within: availableDates
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function getData(date){

    let formattedDate = date.getFullYear() + '-' + 
        ('0' + (date.getMonth() + 1)).slice(-2) + '-' + 
        ('0' + date.getDate()).slice(-2);

    let url = base_url + api_url_query + '?date=' + formattedDate;
    fetch(url)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if(data.success){
            let theater = data.data.theater;
            let total_sales = data.data.total_sales;
            let html = 'Highest sales on ' + formattedDate + ' was at ' + theater.name + ' in ' + theater.location + ' with total sales of ' + total_sales;
            document.getElementById('result').innerHTML = html;
        }else{
            console.log('No data found');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}