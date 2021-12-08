import Chart from 'chart.js/auto';

let ctx = document.getElementById('doughnutChart').getContext('2d');

let myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Binance coin', 'Moonpot', 'Nexo', 'Bitcoin', 'Solana', 'Ethereum', 'Crypto.com coin', 'Tether'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3, 19, 3],
            backgroundColor: [
                '#344665',
                '#620fbd',
                '#00daff',
                '#c0dc00',
                '#f44336',
                '#10b981',
                '#796cff',
            ],
            borderColor: [
                '#344665',
                '#620fbd',
                '#00daff',
                '#c0dc00',
                '#f44336',
                '#10b981',
                '#796cff',
            ],
            borderWidth: 0
        }]
    },
    options: {
        cutout: 80,
        scales: {
           
        },
        responsive: true,
        plugins: {
            legend: {
                display: false,
            },
            title: {
                display: false,
                text: 'Chart.js Doughnut Chart'
            }
        }
    }
});


let ctx1 = document.getElementById('lineChart').getContext('2d');

let myChart1 = new Chart(ctx1, {
    type: 'line',
    data: {
        labels: ['Sep11', 'Sep12', 'Sep13', 'Sep14', 'Sep15', 'Sep16', 'Sep17'],
        datasets: [{
            label: '#',
            data: [12, 19, 3, 5, 2, 3, 10],
            backgroundColor: [
                '#7a6cff',
            ],
            borderColor: [
                '#7a6cff',     
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            
        },
        responsive: true,
        plugins: {
            legend: {
                display: false	
            },
            title: {
                display: false
            }
        }
    }
});