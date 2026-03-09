// Esse algoritmo abaixo serve para abrir e fechar o dropdown do filtro de anos do dashboard
const btnAno = document.getElementById('btn_ano');
let dropdownAberto = false;

btnAno.addEventListener('click', function(e){
    e.stopPropagation();
    
    if(dropdownAberto) {
        btnAno.classList.remove('active');
        dropdownAberto = false;
        console.log(dropdownAberto);
    } else {
        btnAno.classList.toggle('active');
        dropdownAberto = true;
        console.log(dropdownAberto);
    }
});

document.addEventListener('click', function() {
    if (dropdownAberto) {
        btnAno.classList.remove('active');
        dropdownAberto = false;
    }
});

// Esse algoritmo abaixo puxa os dados do banco para exibir no dashboard

async function carregaDados() {
    try {
        
    } catch (error) {
        
    }
}