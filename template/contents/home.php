<div class="">

    <div>
        <h3 class="text-center mb-4">
            Itens cadastrados
        </h3>

        <form method="get">
            <div class="container">


                <div class="row justify-content-center mb-1">

                    <div class="col-sm">
                        <input type="text" id="filter-name" class="form-control mb-2" placeholder="Filtrar por nome">
                    </div>

                    <div class="col-sm">
                        <select name="status" class="form-control mb-2 text-center" aria-label="Status do produto"
                                required>
                            <option value="" disabled <?= !isset($old['status']) ? 'selected' : '' ?>>
                                >Selecione o Status<
                            </option>
                            <option value="1" <?= isset($old['status']) && $old['status'] == '1' ? 'selected' : (isset($_POST['status']) && $_POST['status'] == '1' ? 'selected' : '') ?>>
                                Ativo
                            </option>
                            <option value="0" <?= isset($old['status']) && $old['status'] == '0' ? 'selected' : (isset($_POST['status']) && $_POST['status'] == '0' ? 'selected' : '') ?>>
                                Inativo
                            </option>
                        </select>
                    </div>


                    <div class="col-sm">
                        <select name="category_id" class="form-control mb-2 text-center" aria-label="Status do produto"
                                required>
                            <option value="" disabled <?= !isset($old['category_id']) ? 'selected' : '' ?>>
                                >Selecione a categoria<
                            </option>

                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category->id; ?>" <?= isset($old['category_id']) && $old['category_id'] == $category->id ? 'selected' : ''; ?>>
                                    <?php echo $category->category; ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="col-sm-2">
                        <button type="button" id="clear-filters" class="btn btn-primary w-100 text-center">
                            Limpar filtros <span class="text-light"><i class="fa-solid fa-filter-circle-xmark"></i></span>
                        </button>
                    </div>

                </div>

        </form>
    </div>
</div>


<div class="bg-image h-100 mt-3">
    <div class="mask d-flex align-items-center h-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive table-scroll" id="custom-size-home-table" data-mdb-perfect-scrollbar="true">
                                <table id="product-table" class="table table-striped mb-0">
                                    <thead style="background-color: #202a44; font-size: 0.7rem;">
                                    <tr>
                                        <th class="sortable" data-col="0" scope="col"
                                            style="background-color: transparent; color: #ffffff;">Id <span
                                                    class="arrow">⇅</span>
                                        </th>
                                        <th data-col="1" scope="col"
                                            style="background-color: transparent; color: #ffffff;">Código
                                        </th>
                                        <th class="sortable" data-col="2" scope="col"
                                            style="background-color: transparent; color: #ffffff;">Item <span
                                                    class="arrow">⇅</span>
                                        </th>
                                        <th class="sortable" data-col="3" scope="col"
                                            style="background-color: transparent; color: #ffffff;">Categoria <span
                                                    class="arrow">⇅</span>
                                        </th>
                                        <th class="sortable" data-col="4" scope="col"
                                            style="background-color: transparent; color: #ffffff;">Cadastrado <span
                                                    class="arrow">⇅</span>
                                        </th>
                                        <th class="sortable" data-col="5" scope="col"
                                            style="background-color: transparent; color: #ffffff;">Valor Unitário
                                            <span class="arrow">⇅</i></span>
                                        </th>
                                        <th class="sortable" title="Quantidade" data-col="6" scope="col"
                                            style="background-color: transparent; color: #ffffff;">Qtde <span
                                                    class="arrow">⇅</span>
                                        </th>
                                        <th class="sortable" data-col="7" scope="col"
                                            style="background-color: transparent; color: #ffffff;">Status <span
                                                    class="arrow">⇅</span>
                                        </th>
                                        <th data-col="8" scope="col"
                                            style="background-color: transparent; color: #ffffff;">Descrição
                                        </th>
                                        <th data-col="9" scope="col"
                                            style="background-color: transparent; color: #ffffff;">Ação
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (isset($items)) : ?>
                                        <?php foreach ($items as $item) : ?>
                                            <tr>
                                                <td><?php echo $item->id ?>
                                                </td>
                                                <td>
                                                    <?php echo $item->productcode ?>
                                                </td>
                                                <td class="text-start"
                                                    title="<?php echo htmlspecialchars($item->productname); ?>">
                                                    <?php echo mb_strimwidth($item->productname, 0, 15, '...') ?>
                                                </td>
                                                <td class="text-start"
                                                    title="<?php echo htmlspecialchars($item->categoryName); ?>">
                                                    <?php echo mb_strimwidth($item->categoryName, 0, 20, '...') ?>
                                                </td>
                                                <td class="text-start"
                                                    title="<?php echo htmlspecialchars($item->userName); ?>">
                                                    <?php echo mb_strimwidth($item->userName, 0, 15, '...') ?>
                                                </td>
                                                <td>
                                                    <?php echo 'R$ ' . number_format($item->price, 2, ',', '.'); ?>
                                                </td>
                                                <td>
                                                    <?php echo $item->quantity ?>
                                                </td>
                                                <td class="text-<?php echo $item->status == 0 ? 'danger' : 'success'; ?>">
                                                    <?php echo $item->status == 0 ? 'Inativo' : 'Ativo'; ?>
                                                </td>
                                                <td class="text-start"
                                                    title="<?php echo htmlspecialchars($item->description); ?>">
                                                    <?php echo $item->description ? mb_strimwidth($item->description, 0, 20, '...') : '-' ?>
                                                </td>
                                                <td>
                                                    <a href="#"
                                                       class="me-3 trigger-action"
                                                       data-url="<?php echo \System\Core\Helpers::url('products/update/' . $item->id); ?>"
                                                       data-message="Deseja realmente editar este item?"
                                                       data-btn-class="btn-primary"
                                                       data-title="Confirmar Edição">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>

                                                    <a href="#"
                                                       class="trigger-action"
                                                       data-url="<?php echo \System\Core\Helpers::url('products/deleted/' . $item->id); ?>"
                                                       data-message="Tem certeza de que deseja excluir este item?"
                                                       data-btn-class="btn-danger"
                                                       data-title="Confirmar Exclusão">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </a>
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

<script src="./assets/js/filter-fields.js"></script>