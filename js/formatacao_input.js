const input   = document.getElementById('valor');
const hidden  = document.getElementById('valor_numerico');
const inputWrap = document.querySelector('.input_wrap');

// Formata centavos + milhares no padrão pt-BR
function formatarBRL(raw) {
   // Remove tudo que não é dígito
   let digits = raw.replace(/\D/g, '');

   // Limita a 13 dígitos (999.999.999.999,99)
   if (digits.length > 13) digits = digits.slice(0, 13);

   // Pad com zeros à esquerda para garantir pelo menos 3 chars
   digits = digits.padStart(3, '0');

   const intPart  = digits.slice(0, -2);   // tudo menos os 2 últimos
   const decPart  = digits.slice(-2);       // últimos 2 = centavos

   // Remove zeros à esquerda da parte inteira (mas deixa pelo menos "0")
   const intClean = intPart.replace(/^0+/, '') || '0';

   // Insere pontos de milhar
   const intFmt = intClean.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

   return `${intFmt},${decPart}`;
}

// Converte a string formatada para float puro (para o PHP)
function paraFloat(formatted) {
   // "1.234.567,89" → "1234567.89"
   return formatted.replace(/\./g, '').replace(',', '.');
}

input.addEventListener('focus', function(e) {
   inputWrap.classList.add("focus");
});

input.addEventListener('focusout', function(e) {
   inputWrap.classList.remove("focus");
});

/* ── Evento: formatar enquanto digita ── */
input.addEventListener('input', function (e) {
   inputWrap.classList.add('focus');
   
   const raw = this.value;
   const formatted = formatarBRL(raw);
   this.value = formatted;

   // Cursor sempre no final
   const pos = this.value.length;
   this.setSelectionRange(pos, pos);

   // Insere o valor formatado dinamicamente no input hidden
   const numerico = parseFloat(paraFloat(formatted));
   hidden.value = isNaN(numerico) ? '' : paraFloat(formatted);
});

/* ── Teclas especiais: Backspace apaga dígito ── */
input.addEventListener('keydown', function (e) {
   if (e.key === 'Backspace') {
      e.preventDefault();
      // Remove o último dígito dos dígitos brutos
      const digits = this.value.replace(/\D/g, '');
      const novoDigits = digits.slice(0, -1);
      this.value = novoDigits ? formatarBRL(novoDigits) : '';

      const raw = this.value;
      const numerico = raw ? parseFloat(paraFloat(raw)) : 0;
      hidden.value = raw ? paraFloat(raw) : '';
   }
});