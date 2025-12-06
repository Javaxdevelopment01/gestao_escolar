// FINANCE CHART
const ctxFinance = document.getElementById('financeChart').getContext('2d');
const financeChart = new Chart(ctxFinance, {
    type: 'bar',
    data: {
        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
        datasets: [{
            label: 'Receitas',
            data: [12000, 15000, 14000, 17000, 16000, 18000],
            backgroundColor: '#27ae60'
        }, {
            label: 'Despesas',
            data: [8000, 9000, 10000, 9500, 11000, 12000],
            backgroundColor: '#c0392b'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' }
        }
    }
});

// PERFORMANCE CHART
const ctxPerformance = document.getElementById('performanceChart').getContext('2d');
const performanceChart = new Chart(ctxPerformance, {
    type: 'line',
    data: {
        labels: ['1º Trimestre', '2º Trimestre', '3º Trimestre', '4º Trimestre'],
        datasets: [{
            label: 'Média Geral',
            data: [75, 78, 80, 82],
            backgroundColor: 'rgba(39, 174, 96, 0.2)',
            borderColor: '#27ae60',
            borderWidth: 3,
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' }
        },
        scales: {
            y: { beginAtZero: true, max: 100 }
        }
    }
});
