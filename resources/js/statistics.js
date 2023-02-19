import Chart from 'chart.js/auto';

const apartmentId = document.getElementById("apartment-id");

let views;
let prova = [];
let i = 0;


// FUNZIONE CORRETTA CHE PASSA I DATI ALLA API -------------

// async function getChart() {
//     try {
//         const response = await axios.get(`http://127.0.0.1:8000/api/views/${apartmentId.value}`).then(resp => {
//             views = resp.data.views;
//             console.log("VIEWWWWW", views);
//             let statistic = views;
//             statistic.forEach(element => {
//                 prova.push({ year: element.date, count: i++ })
//             });
//             console.log(prova);
//             var ctx = document.getElementById('myChart').getContext('2d');
//             var chart = new Chart(ctx, {
//                 type: 'line',
//                 data: {
//                     labels: prova.map(row => row.year),
//                     datasets: [{
//                         data: prova.map(row => row.count),
//                         label: 'Data',
//                         backgroundColor: 'rgba(255, 99, 132, 0.2)',
//                         borderColor: 'rgba(255, 99, 132, 1)',
//                         borderWidth: 1
//                     }]
//                 },
//                 options: {
//                     scales: {
//                         yAxes: [{
//                             ticks: {
//                                 beginAtZero: true
//                             }
//                         }]
//                     }
//                 }
//             });
//         });
//     } catch (error) {
//         console.error(error);
//     }
// }

// getChart(); // esempio di chiamata

// TEST AGGIORNAMENTO COUNTER E AGGREGAZIOEN DATE
const data = [];

function statisticsChart(data) {
    const result = data.reduce((accumulator, currentObject) => {
        const data = currentObject.data;
        console.log(data, "questo è data");
        if (!accumulator[data]) {
            accumulator[data] = { data: [], count: 0 };
        }
        accumulator[data].data.push(currentObject);
        accumulator[data].count++;
        return accumulator;
    }, {});

    console.log(result);
}

const response = await axios.get(`http://127.0.0.1:8000/api/views/${apartmentId.value}`).then(resp => {
    views = resp.data.views;
    console.log("VIEWWWWW", views);
    let statistic = views;
    statistic.forEach(element => {
        data.push({ year: element.date, count: 0 })
    })
});
console.log(data);

function getAggragate() {
    const result = data.reduce((accumulator, currentObject) => {
        const year = currentObject.year;
        if (!accumulator[year]) {
            accumulator[year] = { data: [], count: 0 };
        }
        accumulator[year].data.push(currentObject);
        accumulator[year].count++;
        return accumulator;
    }, {});

    console.log(result);
}





async function getChart() {
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/views/${apartmentId.value}`).then(resp => {
            views = resp.data.views;
            console.log("VIEWWWWW", views);
            let statistic = views;
            statistic.forEach(element => {
                data.push({ year: element.date, count: 0 })
            })
        });
        console.log(data);

        const result = data.reduce((accumulator, currentObject) => {
            const year = currentObject.year;
            if (!accumulator[year]) {
                accumulator[year] = { data: [], count: 0 };
            }
            accumulator[year].data.push(currentObject);
            accumulator[year].count++;
            return accumulator;
        }, {});

        console.log(result);
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: result.map(row => row.year),
                datasets: [{
                    data: result.map(row => row.count),
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
        })
    } catch (error) {
        console.error(error);
    }
}


getChart(); // esempio di chiamata

