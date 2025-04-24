<header class="d-flex align-items-center fixed-top fade-in py-3 shadow-sm">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between flex-wrap">

        <a href="<?php echo \System\Core\Helpers::url(); ?>" class="d-flex align-items-center mb-2 mb-lg-0 not-underline">
            <img id="custom-logo-img-header" src="./assets/img/img_logo_no_bg.png" alt="Logo" class="me-2">
            <h1 class="m-0"><?php echo $title ?? SITEFUNCTIONNAME; ?></h1>
        </a>

        <nav class="navbar navbar-expand-lg">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarHeader">
                <ul class="navbar-nav me-auto mb-lg-0">
                    <li class="nav-item mx-lg-2">
                        <a class="nav-link" href="<?php echo \System\Core\Helpers::url(); ?>">Home</a>
                    </li>
                    <li class="nav-item mx-lg-2">
                        <a class="nav-link" href="<?php echo \System\Core\Helpers::url('products'); ?>">Cadastrar</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- telas grandes -->
        <div class="d-none d-lg-flex flex-row align-items-center gap-2">

            <div class="d-flex flex-column text-end text-lg-start">
        <span class="">
            Bem vindo(a), <strong><?php echo \System\Core\AuthMiddleware::get()['name']; ?></strong> |
            <a href="<?php echo \System\Core\Helpers::url('logout'); ?>" class="small text-danger fw-bolder me-2">Logout</a>
        </span>
            </div>

            <form action="<?php echo \System\Core\Helpers::url('search'); ?>" method="get" role="search" class="d-flex">
                <div class="input-group input-group-sm">
                    <input
                            type="search"
                            name="q"
                            class="form-control"
                            placeholder="Pesquisar..."
                            aria-label="Pesquisar"
                            required
                    >
                    <button type="submit" class="btn btn-outline-secondary" aria-label="Buscar">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

        </div>

        <!-- telas pequenas -->
        <div class="w-100 d-lg-none text-center mt-2">

            <div class="mb-2">
        <span class="small">
            Bem vindo(a), <strong><?php echo \System\Core\AuthMiddleware::get()['name']; ?></strong>
            <a href="<?php echo \System\Core\Helpers::url('logout'); ?>" class="small">Logout</a>
        </span>
            </div>

            <form action="<?php echo \System\Core\Helpers::url('search'); ?>" method="get" role="search" class="d-flex justify-content-center">
                <div class="input-group input-group-sm" style="max-width: 90%;">
                    <input
                            type="search"
                            name="q"
                            class="form-control"
                            placeholder="Pesquisar..."
                            aria-label="Pesquisar"
                            required
                    >
                    <button type="submit" class="btn btn-outline-secondary" aria-label="Buscar">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

        </div>

    </div>
</header>
