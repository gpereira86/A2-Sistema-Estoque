$(document).ready(function () {
    let sortDirection = {};

    $('.sortable').click(function () {
        const columnIndex = $(this).data('col');
        const tbody = $('#product-table tbody');
        const rows = tbody.find('tr').get();

        sortDirection[columnIndex] = !sortDirection[columnIndex];
        const isAscending = sortDirection[columnIndex];

        rows.sort(function (a, b) {
            const aText = $(a).children('td').eq(columnIndex).text().trim();
            const bText = $(b).children('td').eq(columnIndex).text().trim();

            const aValue = isNaN(aText) ? aText.toLowerCase() : parseFloat(aText.replace(/[^\d.-]/g, ''));
            const bValue = isNaN(bText) ? bText.toLowerCase() : parseFloat(bText.replace(/[^\d.-]/g, ''));

            if (aValue < bValue) return isAscending ? -1 : 1;
            if (aValue > bValue) return isAscending ? 1 : -1;
            return 0;
        });

        $.each(rows, function (index, row) {
            tbody.append(row);
        });

        $('.sortable .arrow').text('⇅');

        $(this).find('.arrow').text(isAscending ? '⇩' : '⇧');
    });
});

