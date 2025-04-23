<div class="container text-center my-4">


    <div class="container">

        <h3 class="mb-4">
            Cadastro de Produtos
        </h3>
        <div class="row justify-content-center">
            <div class="col-sm-9 col-12">
                colocar mensagem
            </div>
        </div>


        <form action="url" method="POST">

            <input type="hidden" name="id" value="colocar id">

            <div class="row justify-content-center mb-2">
                <div class="col-sm-6 col-12">
                    <input type="text"
                           name="nomeDespesa"
                           class="form-control mb-2"
                           placeholder="Insira aqui a descriçao da despesa"
                           aria-label="Descriçao da despesa"
                           value="{{ formData.nomeDespesa is defined ? formData.nomeDespesa : '' }}" disabled>
                </div>

                <div class="col-sm-3 col-12">
                    <input type="number"
                           name="valor"
                           class="form-control mb-2"
                           placeholder="Valor (formato 0.00)"
                           aria-label="valor"
                           min="0" step="0.01"
                           value="{{ formData.valor is defined ? formData.valor : '' }}" disabled>
                </div>


            </div>

            <div class="row justify-content-center">
                <div class="col-sm-9 col-12">
                <textarea class="form-control"
                          rows="3"
                          placeholder="Se necessário, inclua seu(s) comentário(s) e observações sobre o lançamento aqui..."
                          id="observacao"
                          name="observacao" disabled>{{ formData.observacao|trim }}</textarea>
                </div>
            </div>

            <div class="text-center">
                <button class="btn custom-primary-button mt-3" type="submit" disabled>
                    {% if not formData.id %}
                    Cadastrar
                    {% else %}
                    Salvar
                    {% endif %}
                </button>


                <button class="btn btn-secondary mt-3" type="reset"
                        onclick="window.location.href='{{ url('cadastrar-transacao') }}'">
                    {% if not formData.id %}
                    limpar Formulário
                    {% else %}
                    cancelar
                    {% endif %}
                </button>

            </div>
        </form>
    </div>

    <?php if (isset($produtos) && is_array($produtos)) : ?>
        <?php foreach ($items as $item) : ?>
            <h5><?php echo $item; ?></h5>
        <?php endforeach; ?>
    <?php endif; ?>


</div>