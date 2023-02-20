import Chart from 'chart.js/auto';

const apartmentId = document.getElementById("apartment-id");
const data = [];

async function getChart() {
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/views/${apartmentId.value}`).then(resp => {
            const views = resp.data.views;
            let statistic = views;
            statistic.forEach(element => {
                data.push({ year: element.date, count: 0 })
            })
        });

        const result = data.reduce((accumulator, currentObject) => {
            const year = currentObject.year;
            if (!accumulator[year]) {
                accumulator[year] = { data: [], count: 0 };
            }
            accumulator[year].data.push(currentObject);
            accumulator[year].count++;
            return accumulator;
        }, {});

        let nuovoArray = [];
        for (let key in result) {
            nuovoArray.push({ year: key, count: result[key].count });
        }

        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: nuovoArray.map(row => row.year),
                datasets: [{
                    data: nuovoArray.map(row => row.count),
                    label: 'Visualizzazioni',
                    backgroundColor: '#c9e265',
                    borderColor: '#c9e265',
                    borderWidth: 1,
                    tension: 0.4
                }]
            },
        })
    } catch (error) {
        console.error(error);
    }
}


getChart(); // esempio di chiamata

