async function fetchData() {
    try {
        const response = await fetch('../back/apis/api_dados_grafico_rosca.php');
        const dados = response.json();
        return dados;
    } catch(error) {
        console.log('Não foi possível recuperar os dados');
        return null;
    }
}

async function makeThreadChart() {
    const dados = await fetchData();

    console.log(dados);

    const ctx = document.getElementById('donut_chart');

    const cores = [
        '#BFD7EA',
        '#A8C3D6',
        '#91AEC1',
        '#719DB3',
        '#508CA4',
        '#2D8A7C',
        '#0A8754',
        '#056B41',
        '#004F2D',
        '#175F40'
    ];

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: dados.labels,
            datasets: [{
                data: dados.values,
                backgroundColor: cores,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
            legend: {
                display: false
            },
            title: {
                display: false
            }
            }
        },
    });
}

makeThreadChart();