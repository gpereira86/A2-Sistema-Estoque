$(document).ready(function() {
    $('#clear-button').click(function() {
        $('#products-form input').each(function() {
            $(this).val('');
        });

        $('#products-form select').each(function() {
            $(this).prop('selectedIndex', 0);
        });

        $('#products-form textarea').each(function() {
            $(this).val('');
        });

        $('input[name="productcode"]').prop('disabled', false);
    });
});