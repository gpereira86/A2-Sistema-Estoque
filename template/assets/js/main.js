$(document).ready(function () {
    $('#clear-button').click(function () {

        $('#products-form input').each(function () {
            $(this).val('');
        });

        $('#products-form select').each(function () {
            $(this).prop('selectedIndex', 0);
        });

        $('#products-form textarea').each(function () {
            $(this).val('');
        });

        $('#form-title').text('Cadastro de Produtos');
        $('#action-type-title').text('Cadastrar');


        $('input[name="productcode"]').prop('disabled', false);
    });
});