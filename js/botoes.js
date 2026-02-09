const botoesMeses = document.querySelectorAll(".mes_dashboard");

botoesMeses.addEventListenner('click', (e)=>{
   e.classList.toggle('clicado');

   console.log(e);
});