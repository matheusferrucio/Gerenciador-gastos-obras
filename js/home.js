// Esse algoritmo abaixo serve para abrir e fechar o dropdown do filtro de anos do dashboard
const btnAno = document.getElementById('btn_ano');
let dropdownAberto = false;

btnAno.addEventListener('click', function(e){
    e.stopPropagation();
    
    if(dropdownAberto) {
        btnAno.classList.remove('active');
        dropdownAberto = false;
    } else {
        btnAno.classList.add('active');
        dropdownAberto = true;
    }
});

document.addEventListener('click', function() {
    if (dropdownAberto) {
        btnAno.classList.remove('active');
        dropdownAberto = false;
    }
});

// Esse algoritmo abaixo puxa os dados do banco para exibir no dashboard
let graficoColunas = null;
let graficoRosca  = null;

const hoje = new Date();

// Objeto dos filtros ativos
let filtroAtivo = {
    // Pega o mês atual e adiciona 1(porque a função recupera o mês a partir do 0)
    // padStart(2, '0') -> garante que o mês tenha 2 número e comece com 0
    mes: String(hoje.getMonth() + 1).padStart(2, '0'),
    ano: String(hoje.getFullYear()),
};

async function carregarDashboard() {
    const params = new URLSearchParams(filtroAtivo);
    const response = await fetch(`../back/apis/api_dados_home.php?${params}`);
    const dados    = await response.json();
    
    atualizarCards(dados.resumo);
    atualizarTabela(dados.tabela);
    atualizarGraficos(dados);
}

// Função que atualiza os valores dos cards
function atualizarCards(cards) {
    document.getElementById("total_comissoes").textContent = new Intl.NumberFormat('pr-BR', {
        style: 'currency', currency: 'BRL'
    }).format(cards.total_comissao_obras);

    document.getElementById("total_gastos").textContent = new Intl.NumberFormat('pr-BR', {
        style: 'currency', currency: 'BRL'
    }).format(cards.total_gastos_obras);

    document.getElementById("qtd_obras").textContent = cards.qtd_total_obras;

    document.getElementById("media_comissoes").textContent = new Intl.NumberFormat('pr-BR', {
        style: 'currency', currency: 'BRL'
    }).format(cards.ticket_medio_obra);
}

// Função que atualiza a tabela de resumo das obras
function atualizarTabela(obras) {
    const tabela = document.querySelector(".tabela_gastos_obras");

    if(obras.length === 0) { 
        tabela.innerHTML += "<tr><td>Nenhum dado foi encontrado</td></tr>";
        return;
    }
    
    tabela.innerHTML = obras.map(o => `
        <tr>
            <td class="f2">
                <p class="">${o.nome_obra}</p>
            </td>

            <td class="f1 verde">${new Intl.NumberFormat('pr-BR', {style: 'currency', currency: 'BRL'}).format(o.total_obra)}</td>

            <td class="f-6">${o.porcentagem}%</td>

            <td class="f1 verde">${new Intl.NumberFormat('pr-BR', {style: 'currency', currency: 'BRL'}).format(o.comissao_obra)}</td>
        </tr>
    `).join('');
}

function atualizarGraficos(obras) {
    const labels    = obras.grafico_colunas.labels;
    const gastos    = obras.grafico_colunas.values.map(o => parseFloat(o));
    const comissoes = obras.grafico_rosca.values.map(o => parseFloat(o));
    
    // Gráfico de colunas
    if(graficoColunas) {
        // Caso o gráfico já exista, ele pega os novos dados e o atualiza
        graficoColunas.data.labels           = labels;
        graficoColunas.data.datasets[0].data = gastos;
        graficoColunas.update();
    } else {
        const ctx = document.getElementById('myChart').getContext('2d'); // Pega minha tag <canvas> para adicionar o gráfico

        graficoColunas = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: gastos,
                    backgroundColor: [
                    '#213C51'
                    ],
                    borderWidth: 1,
                    borderRadius: 20
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                    enabled: true
                    },
                    legend: {
                    display: false
                    }
                }
            }
        });
    }

    // Gráfico de rosca
    if(graficoRosca) {
        graficoRosca.data.labels           = labels;
        graficoRosca.data.datasets[0].data = comissoes;
        graficoRosca.update();
    } else {
        const ctx = document.getElementById('donut_chart').getContext('2d');

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

        graficoRosca = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: comissoes,
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
}

document.querySelectorAll('span.mes_dashboard').forEach(btn => {
    btn.addEventListener('click', function() {
        // Remove a classe 'active' de todos os outros botões
        document.querySelectorAll('.mes_dashboard').forEach(el => el.classList.remove('active'));
        this.classList.add('active');

        filtroAtivo.mes = this.getAttribute('value');
        carregarDashboard();
    });
});

document.querySelectorAll('li.ano_dashboard').forEach(btn => {
    btn.addEventListener('click', function() {
        filtroAtivo.ano = this.dataset.ano;

        // Atualiza o ano selecionado no botão do dropdown
        document.getElementById('btn_ano').firstChild.textContent = this.dataset.ano + ' ';

        // Fecha o dropdown
        btnAno.classList.remove('active');
        dropdownAberto = false;

        carregarDashboard();
    });
});

document.addEventListener('DOMContentLoaded', carregarDashboard());