document.addEventListener('DOMContentLoaded', () => {
    const actionButtons = document.querySelectorAll('.trigger-action');
    const modal = new bootstrap.Modal(document.getElementById('confirmActionModal'));
    const modalTitle = document.getElementById('confirmActionLabel');
    const modalMessage = document.getElementById('confirmActionMessage');
    const confirmBtn = document.getElementById('confirmActionBtn');

    const updateBtn = document.getElementById('action-type-title');
    const form = document.getElementById('products-form');

    actionButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();

            const url = button.getAttribute('data-url');
            const message = button.getAttribute('data-message');
            const btnClass = button.getAttribute('data-btn-class');
            const title = button.getAttribute('data-title');

            modalTitle.textContent = title;
            modalMessage.textContent = message;
            confirmBtn.setAttribute('href', url);
            confirmBtn.className = `btn ${btnClass}`;
            modal.show();
        });
    });

    if (updateBtn.textContent.trim() === 'Atualizar') {
        updateBtn.addEventListener('click', (e) => {
            e.preventDefault();

            modalTitle.textContent = 'Confirmação de Edição';
            modalMessage.textContent = "Tem certeza de que deseja atualizar este item?";
            confirmBtn.className = 'btn btn-warning';

            modal.show();


            confirmBtn.addEventListener('click', () => {
                modal.hide();
                form.submit();
            });
        });
    }
});
