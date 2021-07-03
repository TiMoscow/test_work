<?php
require($_SERVER["DOCUMENT_ROOT"] . "/templates/header.php");
?>

<div class="container my-5">
    <div class="row justify-content-md-center">
        <div class="col-12 col-md-6 my-2 my-md-0">
            <div class="card h-100">
                <h5 class="card-header">Готовый код API</h5>
                <div class="card-body">
                    <form action="tp.php" method="POST">
                        <div class="container">
                            <div class="row justify-content-md-center my-3">
                                <div class="col col-md-auto">
                                    Создаем новый файл. В папке "code_api".
                                </div>
                            </div>
                            <div class="row justify-content-md-center my-3">
                                <div class="col-12 col-md-9">
                                    <input class="form-control form-control-sm" type="text" size="40"
                                           placeholder="Имя файла"
                                           name="api_file_name"
                                           required="">
                                </div>
                                <div class="ccol-12 col-md-3 d-grid gap-2 h-100 my-2 my-md-0">
                                    <button type="submit" name="submit_api_create" class="btn btn-outline-custom-theme-custom-orange btn-sm">
                                        <i class="bi bi-file-earmark-check"></i>
                                        Создаем
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form action="tp.php" method="POST">
                        <div class="container">
                            <div class="row justify-content-md-center my-3">
                                <div class="col col-md-auto">
                                    Удалить файл/ы из папки "code_api"
                                </div>
                            </div>
                            <div class="row justify-content-md-center my-3">
                                <div class="col-12 col-md-9">
                                    <select size="5" class="form-select form-select-sm" multiple required
                                            name="file[]">
                                        <option disabled>выберите файл(ы)</option>
                                        <?php
                                        if ($handle = opendir('code_api')) {
                                            while (false !== ($file = readdir($handle))) {
                                                if ($file != "." && $file != "..") {

                                                    echo "<option value=" . $file . ">" . $file . "</option>";
                                                }
                                            }
                                            closedir($handle);
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 d-grid gap-2 h-100 my-2 my-md-0">
                                    <button type="submit" name="submit_api_delete" class="btn btn-outline-custom-theme-custom-orange btn-sm">
                                        <i class="bi bi-file-earmark-excel"></i>
                                        Удалить
                                    </button>
                                    <button type="submit" name="submit_api_open" class="btn btn-outline-custom-theme-custom-orange btn-sm mt-2">
                                        <i class="bi bi-box-arrow-in-up"></i>
                                        Открыть *
                                    </button>
                                </div>
                                * Открываем одну ссылку!
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 my-2 my-md-0">
            <div class="card h-100">
                <h5 class="card-header">Тест кода</h5>
                <div class="card-body">
                    <form id="test_php" action="tp.php" method="POST">
                        <div class="container">

                            <div class="row justify-content-md-center my-3">
                                <div class="col col-md-auto">
                                    Создаем новый тестовый файл с КОДОМ из ПОЛЯ "тут код" (Тег php уже есть)
                                </div>
                            </div>
                            <div class="row justify-content-md-center my-3">
                                <div class="col-12 col-md-9">

                                    <div class="mb-3">
                                        <input type="text" name="name_code" class="form-control" id="formGroupExampleInput"
                                               placeholder="Код №1">
                                    </div>

                                    <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" required="" id="floatingTextarea"
                                          name="text_code"></textarea>
                                        <label for="floatingTextarea">тут код</label>
                                    </div>

                                </div>
                                <div class="col-12 col-md-3 d-grid gap-2 h-100 my-2 my-md-0">
                                    <button type="submit" name="submit_code_create" class="btn btn-outline-custom-theme-custom-orange btn-sm">
                                        <i class="bi bi-file-earmark-check"></i>
                                        Создаем
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="tp.php" method="POST">
                        <div class="container">
                            <div class="row justify-content-md-center my-3">
                                <div class="col col-md-auto">
                                    Удалить файл/ы из папки "code"
                                </div>
                            </div>
                            <div class="row justify-content-md-center my-3">
                                <div class="col-12 col-md-9">
                                    <select size="5" id="form_code" class="form-select form-select-sm" multiple required
                                            name="file[]">
                                        <option disabled>выберите файл(ы)</option>
                                        <?php
                                        if ($handle = opendir('code')) {
                                            while (false !== ($file = readdir($handle))) {
                                                if ($file != "." && $file != "..") {

                                                    echo "<option value=" . $file . ">" . $file . "</option>";
                                                }
                                            }
                                            closedir($handle);
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 d-grid gap-2 h-100 my-2 my-md-0">
                                    <button type="submit" name="submit_code_delete" class="btn btn-outline-custom-theme-custom-orange btn-sm">
                                        <i class="bi bi-file-earmark-excel"></i>
                                        Удалить
                                    </button>
                                    <button type="submit" name="submit_code_open" class="btn btn-outline-custom-theme-custom-orange btn-sm">
                                        <i class="bi bi-box-arrow-in-up"></i>
                                        Окрыть *
                                    </button>
                                </div>
                                * Открываем одну ссылку!
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/templates/footer.php");
?>




