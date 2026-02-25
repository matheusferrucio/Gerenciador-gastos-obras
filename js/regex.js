function formatarCpfCnpj(valores){
   valores.forEach(element => {
      // remove tudo que não é digito
      const numero = element.textContent.replace(/\D/g, '');

      if (numero.length <= 11) {
         var novoNumero = numero
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d{1,2})$/, '$1-$2');

         element.textContent = novoNumero;
      } else {
         var novoNumero = numero
         .replace(/(\d{2})(\d)/, '$1.$2')
         .replace(/(\d{3})(\d)/, '$1.$2')
         .replace(/(\d{3})(\d)/, '$1/$2')
         .replace(/(\d{4})(\d{1,2})$/, '$1-$2');
         
         element.textContent = novoNumero;
      }
   });
}

const cpfCnpj = document.querySelectorAll("td p.cpf_cnpj_cliente");

formatarCpfCnpj(cpfCnpj);