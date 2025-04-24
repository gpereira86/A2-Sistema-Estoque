document.addEventListener('DOMContentLoaded', function () {
    const filterName = document.getElementById('filter-name');
    const filterCategory = document.querySelector('select[name="category_id"]');
    const filterStatus = document.querySelector('select[name="status"]');
    const tableRows = document.querySelectorAll('#product-table tbody tr');
    const clearBtn = document.getElementById('clear-filters');

    function normalize(text) {
        return text.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }

    function applyFilters() {
        const name = normalize(filterName.value.trim());
        const category = filterCategory.value;
        const status = filterStatus.value;

        tableRows.forEach(row => {
            const nameText = normalize(row.cells[2].innerText);
            const categoryText = row.cells[3].innerText.trim();
            const statusText = row.cells[7].innerText.trim();

            const matchName = name === "" || nameText.includes(name);
            const matchCategory = category === "" || categoryText === filterCategory.options[filterCategory.selectedIndex].text;
            const matchStatus = status === "" || statusText === (status === "1" ? "Ativo" : "Inativo");

            row.style.display = (matchName && matchCategory && matchStatus) ? "" : "none";
        });
    }

    filterName.addEventListener('input', applyFilters);
    filterCategory.addEventListener('change', applyFilters);
    filterStatus.addEventListener('change', applyFilters);

    if (clearBtn) {
        clearBtn.addEventListener('click', function () {
            filterName.value = '';
            filterCategory.selectedIndex = 0;
            filterStatus.selectedIndex = 0;
            applyFilters();
        });
    }
});