let paginaAtual = 1;
let carregando = false;

// Objeto que guarda os filtros ativos
let filtros = {
   obra:     '',
   cliente:  '',
   mes:      '',
   ano:      ''
};

function reatauraFiltros() {
   // Pega os filtros salvos no localStorage
   const filtrosSalvos = localStorage.getItem('filtros_gastos');
   if(!filtrosSalvos) return;
   
   filtros = JSON.parse(filtrosSalvos);

   console.log(filtros);
   

   document.getElementById('filtro_obra').value    = filtros.obra;
   document.getElementById('filtro_cliente').value = filtros.cliente;
   document.getElementById('filtro_mes').value     = filtros.mes;
   document.getElementById('filtro_ano').value     = filtros.ano;
}

async function carregarGastos(pagina) {
   if(carregando) return;
   carregando = true;

   try {
      // Cria uma URL personalizada com os parãmetros de página e filtros
      const params = new URLSearchParams ({
         pagina,
         ...filtros // espalha os filtros como parâmetros da URL
      });

      // Passamos a página e os filtros como parâmetros de URL para requisição
      const response = await fetch(`../../back/buscar_dados.php?${params}`);
      const dados = await response.json();
      
      renderizarTabela(dados.gastos);
      renderizarPaginacao(dados.pagina_atual, dados.total_paginas, dados.total);

      paginaAtual = dados.pagina_atual;
      
   } catch(erro) {
      console.error("Erro ao carregar os dados".erro);
   } finally {
      carregando = false;
   }
}

document.getElementById('btn_abrir_filtro').addEventListener('click', function() {
   document.getElementById('modal').style.display   = 'block';
   document.querySelector('.overlay').style.display = 'block';
});

document.getElementById('btn_fechar_filtro').addEventListener('click', function() {
   document.getElementById('modal').style.display   = 'none';
   document.querySelector('.overlay').style.display = 'none';
});

document.getElementById('btn_aplicar_filtro').addEventListener('click', function(){
   filtros.obra    = document.getElementById('filtro_obra').value;
   filtros.cliente = document.getElementById('filtro_cliente').value;
   filtros.mes     = document.getElementById('filtro_mes').value;
   filtros.ano     = document.getElementById('filtro_ano').value;

   // Adiciona os filtros ao localStorage para que o filtro persista
   localStorage.setItem('filtros_gastos', JSON.stringify(filtros));

   document.getElementById('modal').style.display   = 'none';
   document.querySelector('.overlay').style.display = 'none';

   carregarGastos(1); // reseta para a página 1 após carregar os dados com base nos filtros
});

// Limpa o objeto que armazena os valores do filtros e também os inputs
document.getElementById('btn_limpar_filtro').addEventListener('click', function(){
   filtros = {
      obra:    '',
      cliente: '',
      mes:     '',
      ano:     ''
   };

   // Limpa o localStorage
   localStorage.removeItem('filtros_gastos');

   document.getElementById('filtro_obra').value     = '';
   document.getElementById('filtro_cliente').value  = '';
   document.getElementById('filtro_mes').value      = '';
   document.getElementById('filtro_ano').value      = '';

   document.getElementById('modal').style.display   = 'none';
   document.querySelector('.overlay').style.display = 'none';

   carregarGastos(1);
});

function renderizarTabela(gastos){
   const corpo = document.getElementById('corpo-tabela');

   if (gastos.length == 0) {
      corpo.innerHTML = '<tr><td colspan="6">Nenhum registro encontrado.</td></tr>';
      return;
   }

   corpo.innerHTML = gastos.map(g => `
      <tr>
         <td class="f2">
            <p class="">${g.nomeObra}</p>
         </td>
         <td class="f2">${g.nomeCliente}</td>
         <td class="f1-2 verde">${parseFloat(g.valor_gasto).toLocaleString('pt-br', {style: 'currency', currency: 'BRL'})}</td>
         <td class="f-6">${formatarData(g.data_gasto)}</td>
         <td class="f4">${g.descricao}</td>
         <td class="f1 celula_botoes_acoes">
            <a href="${BASE_URL}pages/front/edits/editar_gasto_obra.php?id=${g.id_gasto}" class="btn editar">
               <i class='bx bx-edit'></i>
            </a>
            <a
               href="${BASE_URL}pages/back/excluir/excluir_gasto_obradb.php?id=${g.id_gasto}" 
               class="btn excluir"
               onclick="confirmarExclusao(event, '')">
               <i class='bx bx-message-alt-x'></i>
            </a>
         </td>
      </tr>
   `).join('');
}

function renderizarPaginacao(atual, total, totalRegistros) {
   // Exibe a quantidade de páginas e registros
   document.getElementById('info_pagina').textContent = 
      `Página ${atual} de ${total} - ${totalRegistros} registros`;

   const container = document.getElementById('botoes_pagina');
   container.innerHTML = '';

   // Cria e seta a funcionalidade do botão de 'Anterior'
   const btnAnterior = document.createElement('button');
   btnAnterior.textContent = '← Anterior';
   btnAnterior.disabled = parseInt(atual) === 1;
   btnAnterior.addEventListener('click', () => carregarGastos(parseInt(atual) - 1));
   container.appendChild(btnAnterior);

   // essas linhas definem qual o valor mínimo e máximo para os botões de paginação
   const inicio   = Math.max(1, atual - 2);
   const fim      = Math.min(total, atual + 2);

   // Cria os botões da paginação
   for (let i = inicio; i <= fim; i++) {
      const btn = document.createElement('button');
      btn.textContent = i;
      btn.classList.toggle('ativo', i === atual); // se o valor/texto do botão for igual ao da página atual, ele recebe a classe ativo
      btn.addEventListener('click', () => carregarGastos(i));
      container.appendChild(btn);

      btn.classList.remove('active');

      // Adiciona um background diferente no botão com o número da página selecionada
      if (btn.textContent == parseInt(atual)) {
         btn.classList.add('active');
      }
   }

   const btnProxima = document.createElement('button');
   btnProxima.textContent = 'Próxima →';
   btnProxima.disabled = atual === total;
   btnProxima.addEventListener('click', () => carregarGastos(parseInt(atual) + 1));
   container.appendChild(btnProxima);
}

function formatarData(data) {
   if (!data) return '-';

   const meses = ['Jan','Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

   const [ano, mes, dia] = data.split('-');
   return meses[parseInt(mes) - 1];
}

document.addEventListener('DOMContentLoaded', () => {
   reatauraFiltros();
   carregarGastos(1);

   console.log(localStorage.getItem('filtros_gastos'));
});