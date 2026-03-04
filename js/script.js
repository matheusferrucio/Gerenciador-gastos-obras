function confirmarExclusao(event, nome) {
    event.preventDefault(); // cancela o evento do link
    const urlDestino = event.currentTarget.href; // guarda o caminho para o qual o botão encaminha

    // Swal é uma biblioteca para pop-ups em js
    Swal.fire({
        title: 'Confirmar Exclusão',
        text: `Tem certeza que deseja excluir esse gasto? Esta ação não poderá ser desfeita.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f16060',
        cancelButtonColor: '#213C51',
        confirmButtonText: 'Excluir',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if(result.isConfirmed) {
            window.location.href = urlDestino;
        }
    });
}

