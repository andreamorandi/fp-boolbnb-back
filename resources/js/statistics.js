import Chart from 'chart.js/auto';

const apartmentId = document.getElementById("apartment-id");

let views;
let prova = [];
let i = 0;
let year = 2010;

axios.get(`http://127.0.0.1:8000/api/views/${apartmentId.value}`).then(resp => {
    views = resp.data.views;
    console.log("VIEWWWWW", views);
    let statistic = views;
    statistic.forEach(element => {
        prova.push([{ year: year++, count: i++ }])
    });
    console.log("Prova", prova);
    console.log(statistic);
});



// [
//     { year: 2010, count: views[] },
//     { year: 2011, count: 20 },
//     { year: 2012, count: 15 },
//     { year: 2013, count: 25 },
//     { year: 2014, count: 22 },
//     { year: 2015, count: 30 },
//     { year: 2016, count: 28 },
// ];
console.log(prova.map);

var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: prova.year.map(row => row.year),
        datasets: [{
            label: 'Acquisitions by year',
            data: prova.count.map(row => row.count),
            label: 'Data',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});




