<div class="container text-center my-4">


    <div class="container">

        <h3 class="mb-4">
            Cadastro de Produtos
        </h3>

        <?php if (!empty($errorMessages)): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <?php foreach ($errorMessages as $message): ?>
                    <div><i class="bi bi-exclamation-triangle-fill me-2"></i><?= $message ?></div>
                <?php endforeach; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php elseif (!empty($successMessages)): ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <?php foreach ($successMessages as $message): ?>
                    <div><i class="bi bi-exclamation-triangle-fill me-2"></i><?= $message ?></div>
                <?php endforeach; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <form id="products-form" action="<?php echo \System\Core\Helpers::url('products/store'); ?>" method="POST">

            <input type="hidden" name="id" value="<?php echo $old['id'] ?? ''; ?>">

            <div class="row justify-content-center mb-2">

                <div class="col-sm-2 col-12">
                    <input type="number"
                           name="productcode"
                           class="form-control mb-2"
                           placeholder="Código"
                           aria-label="Código do produto"
                           min="0" step="1"
                           value="<?php echo $old['productcode'] ?? ''; ?>">
                </div>

                <div class="col-sm col-12">
                    <input type="text"
                           name="productname"
                           class="form-control mb-2"
                           placeholder="Item"
                           aria-label="Nome do produto"
                           value="<?php echo $old['productname'] ?? ''; ?>">
                </div>

                <div class="col-sm-3 col-12">
                    <input type="number"
                           name="price"
                           class="form-control mb-2"
                           placeholder="Valor unitário"
                           aria-label="Valor unitário do item"
                           min="0" step="0.01"
                           value="<?php echo $old['price'] ?? ''; ?>">
                </div>

                <div class="col-sm-2 col-12">
                    <input type="number"
                           name="quantity"
                           class="form-control mb-2"
                           placeholder="Quantidade"
                           aria-label="Quantidade de itens"
                           min="0" step="1"
                           value="<?php echo $old['quantity'] ?? ''; ?>">
                </div>

                <div class="col-sm-2 col-12">
                    <select name="status" class="form-control mb-2 text-center" aria-label="Status do produto" required>
                        <option value="" disabled <?= !isset($old['status']) ? 'selected' : '' ?>>Selecione o Status
                        </option>
                        <option value="1" <?= isset($old['status']) && $old['status'] == '1' ? 'selected' : (isset($_POST['status']) && $_POST['status'] == '1' ? 'selected' : '') ?>>
                            Ativo
                        </option>
                        <option value="0" <?= isset($old['status']) && $old['status'] == '0' ? 'selected' : (isset($_POST['status']) && $_POST['status'] == '0' ? 'selected' : '') ?>>
                            Inativo
                        </option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-sm col-12">
                <textarea class="form-control"
                          rows="3"
                          placeholder="Descrição do item"
                          id="description"
                          aria-label="Descrição do item"
                          name="description"><?php echo $old['description'] ?? ''; ?></textarea>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-primary mt-3" type="submit">
                    Cadastrar
                </button>

                <button class="btn btn-secondary mt-3" type="reset">
                    Limpar Formulário
                </button>

            </div>
        </form>
    </div>
    <hr/>
    <div class="container">
        <div class="bg-image h-100">
            <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true"
                                         style="position: relative; max-height: 700px">
                                        <table class="table table-striped mb-0">
                                            <thead style="background-color: #202a44;">
                                            <tr>
                                                <th scope="col"
                                                    style="background-color: transparent; color: #ffffff">Id
                                                </th>
                                                <th scope="col"
                                                    style="background-color: transparent; color: #ffffff">Código
                                                </th>
                                                <th scope="col"
                                                    style="background-color: transparent; color: #ffffff">Item
                                                </th>
                                                <th scope="col"
                                                    style="background-color: transparent; color: #ffffff">Descrição
                                                </th>
                                                <th scope="col"
                                                    style="background-color: transparent; color: #ffffff">Valor
                                                    Unitário
                                                </th>
                                                <th scope="col"
                                                    style="background-color: transparent; color: #ffffff">Quantidade
                                                </th>
                                                <th scope="col"
                                                    style="background-color: transparent; color: #ffffff">Status
                                                </th>
                                                <th scope="col"
                                                    style="background-color: transparent; color: #ffffff">Ação
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (isset($itens)) : ?>
                                                <?php foreach ($itens as $item) : ?>
                                                    <tr>
                                                        <td><?php echo $item->id ?></td>
                                                        <td><?php echo $item->productcode ?></td>
                                                        <td><?php echo $item->productname ?></td>
                                                        <td><?php echo $item->description ?? '-' ?></td>
                                                        <td><?php echo 'R$ ' . number_format($item->price, 2, ',', '.'); ?></td>
                                                        <td><?php echo $item->quantity ?></td>
                                                        <td><?php echo $item->status ?></td>
                                                        <td>
                                                            <a href="<?php echo \System\Core\Helpers::url('products/update'); ?>" class="me-3"><i class="fa-regular fa-pen-to-square"></i></a>
                                                            <a href="#" ><i class="fa-regular fa-trash-can"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


</div>