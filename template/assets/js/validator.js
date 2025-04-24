document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('products-form');

    const isFloatWithMaxTwoDecimals = (value) => {
        return /^\d+(\.\d{1,2})?$/.test(value);
    };

    const validationRules = {
        productcode: {
            validate: input => Number.isInteger(+input.value) && parseInt(input.value) > 0,
            message: 'Informe um número inteiro maior que 0.'
        },
        productname: {
            validate: input => input.value.trim().length >= 3,
            message: 'O nome do produto deve ter pelo menos 3 caracteres.'
        },
        status: {
            validate: input => input.value !== '',
            message: 'Selecione o status do produto.'
        },
        price: {
            validate: input => {
                const val = input.value.trim();
                return val === '' || (parseFloat(val) >= 0 && isFloatWithMaxTwoDecimals(val));
            },
            message: 'Informe um valor válido (ex: 10,00) maior ou igual a 0 ou deixe em branco.'
        },
        quantity: {
            validate: input => Number.isInteger(+input.value) && parseInt(input.value) >= 0,
            message: 'A quantidade deve ser um número inteiro maior que 0.'
        },
        category_id: {
            validate: input => input.value !== '',
            message: 'Selecione uma categoria.'
        }
    };

    const showValidation = (input, valid, message) => {
        input.classList.remove('is-valid', 'is-invalid');

        let feedback = input.parentElement.querySelector('.invalid-feedback');

        if (!feedback) {
            feedback = document.createElement('div');
            feedback.className = 'invalid-feedback';
            input.parentElement.appendChild(feedback);
        }

        if (valid) {
            input.classList.add('is-valid');
            feedback.textContent = '';
        } else {
            input.classList.add('is-invalid');
            feedback.textContent = message;
        }
    };

    Object.keys(validationRules).forEach(name => {
        const input = form[name];
        if (!input) return;

        const handler = () => {
            const {validate, message} = validationRules[name];
            const isValid = validate(input);
            showValidation(input, isValid, message);
        };

        input.addEventListener('input', handler);
        if (input.tagName.toLowerCase() === 'select') {
            input.addEventListener('change', handler);
        }
    });

    form.addEventListener('submit', event => {
        let isFormValid = true;

        Object.keys(validationRules).forEach(name => {
            const input = form[name];
            if (!input) return;
            const {validate, message} = validationRules[name];
            const isValid = validate(input);
            showValidation(input, isValid, message);
            if (!isValid) isFormValid = false;
        });

        if (!isFormValid) {
            event.preventDefault();
            alert('Por favor, corrija os campos destacados antes de enviar.');
        }
    });

    document.getElementById('clear-button').addEventListener('click', () => {
        form.reset();
        form.querySelectorAll('.is-valid, .is-invalid').forEach(el => {
            el.classList.remove('is-valid', 'is-invalid');
        });
        form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
    });
});
