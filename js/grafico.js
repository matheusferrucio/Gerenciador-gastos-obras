// Faz a requisição para a API interna que pega os dados do banco
async function fetchData() {
   try {
      const response = await fetch('../back/api_dados_grafico.php');
      const data = response.json();
      return data;
   } catch(error) {
      console.log('Erro ao buscar os dados: ', error);
      return null;
   }
}

async function makeChart() {
   const data = await fetchData(); // Pega os dados retornados pela API interna

   console.log(data);

   const ctx = document.getElementById('myChart'); // Pega minha tag <canvas> para adicionar o gráfico

   new Chart(ctx, {
      type: 'bar',
      data: {
         labels: data.nome_obra,
         datasets: [{
            label: data.nome_obra,
            data: data.soma_gastos_obra,
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

makeChart();