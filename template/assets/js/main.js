$(document).ready(function () {
    $('.edit-product').on('click', function (e) {
        e.preventDefault();

        const productId = $(this).data('id');

        $.ajax({
            url: '/cadastro-clientes/products/update',
            method: 'POST',
            data: { id: productId },
            success: function (response) {
                console.log('Produto carregado com sucesso:', response);

                // Exemplo: redirecionar para edição
                window.location.href = '/cadastro-clientes/products/edit';

            },
            error: function (xhr) {
                console.error('Erro ao carregar produto:', xhr.responseText);
            }
        });
    });
});
