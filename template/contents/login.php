<main class="fade-in">
    <div class="position-absolute top-50 start-50 translate-middle">

        <div class="card custom-card-style">
            <div class="card-body p-5 text-center">

                <h3 class="mb-4">Cadastro de Clientes</h3>

                <?php if (!empty($message)): ?>
                    <div class="mb-2 text-danger fw-bolder"><?php echo $message; ?></div>
                <?php endif; ?>

                <form method="post">
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input name="email" type="email" id="typeEmailX-2"
                               class="form-control form-control-lg <?php echo $emailValidator ?? ''; ?>"
                               placeholder="E-mail" value="<?php echo $email ?? ''; ?>"/>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <input name="password" type="password" id="typePasswordX-2"
                               class="form-control form-control-lg <?php echo $passwordValidator ?? ''; ?>"
                               placeholder="Senha" value=""/>
                    </div>

                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block"
                            type="submit">
                        Login
                    </button>
                </form>

            </div>
        </div>
    </div>

</main>
