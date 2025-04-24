<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    .h-custom {
        height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }
</style>

<div class="position-absolute top-50 start-50 translate-middle">

    <div class="container-fluid h-custom text-center">

        <img src="./assets/img/error404.png" class="img-fluid" alt="Sample image">
        <h1>404 Not Found</h1>
        <h3>Algo deu errado!</h3>
        <button onclick="window.location.href='<?php echo \System\Core\Helpers::url()?>'" class="btn btn-primary my-3">
            Voltar para Home
        </button>

    </div>


</div>