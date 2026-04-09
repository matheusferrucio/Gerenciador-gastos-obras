const input = document.querySelector('.input_cpf_cnpj');
const hiddenInput = document.querySelector('.hidden_cpf_cnpj');

input.addEventListener('input', function() {
   // remove tudo que não é dígito
   const numeros = this.value.replace(/\D/g, '');

   // Limita a entrada a 14 dígitos (CPF ou CNPJ) para o input hidden
   if (numeros.length > 14) {
      this.value = formatarCnpj(numeros.slice(0, 14));
      hiddenInput.value = numeros.slice(0, 14);
      return;      
   }

   this.value = numeros.length <= 11 ? formatarCpf(numeros) : formatarCnpj(numeros);
   hiddenInput.value = parseInt(numeros); // Armazena apenas os números no campo oculto
});

function formatarCpf(v) {
   v = v.slice(0, 11); // Limita a entrada a 11 dígitos
   if (v.length > 9) return v.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4');
   if (v.length > 6) return v.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3');
   if (v.length > 3) return v.replace(/(\d{3})(\d{1,3})/, '$1.$2');
   return v;
}

function formatarCnpj(v) {
   v = v.slice(0, 14); // Limita a entrada a 14 dígitos
   if (v.length > 12) return v.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{1,2})/, '$1.$2.$3/$4-$5');
   if (v.length > 8)  return v.replace(/(\d{2})(\d{3})(\d{3})(\d{1,4})/, '$1.$2.$3/$4');
   if (v.length > 5)  return v.replace(/(\d{2})(\d{3})(\d{1,3})/, '$1.$2.$3');
   if (v.length > 2)  return v.replace(/(\d{2})(\d{1,3})/, '$1.$2');
   return v;
}