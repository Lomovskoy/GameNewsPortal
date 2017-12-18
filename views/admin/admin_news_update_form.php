<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="container">
    <h4 class="text-center mt-2">Добавить новость</h4>
    <hr>
    <form action="add_article" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleFormControlInput1">Заголовок</label>
            <input type="text" name="caption" class="form-control">
        </div>
        <div class="row">
            <div class="form-group col-8">
                <label for="exampleFormControlSelect1">Выберите категорию</label>
                <select class="form-control" name="section">
                    <?php foreach ($sections as $section): ?>
                        <option value="<?php echo $section['id']; ?>"><?php echo $section['name']; ?></option>
                    <?PHP endforeach; ?>
                </select>
            </div>
            <div class="form-group col-4">
                <label for="exampleFormControlSelect1">Публикация</label>
                <select class="form-control" name="publicing">
                    <option value="1">Публичная</option>
                    <option value="0">Скрытая</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Текст новости, статьи</label>
            <textarea class="form-control"  name="description" rows="5"></textarea>
        </div>
        <div class="row">
            <div class="form-group ml-4">
                <label for="exampleFormControlFile1">Изображение к статье.</label>
                <input type="file" class="form-control-file" name="image">
            </div>
            <div class="form-group col-4">
                <label for="exampleFormControlSelect1">Новость или форум</label>
                <?php if ($_SESSION['user']['rang'] == 6): ?>
                    <select class="form-control" name="new_or_forum" >
                        <option value="0">Новость</option>
                        <option value="1">форум</option>
                    </select>
                <?php endif; ?>
            </div>
        </div>
        <button class="btn btn-dark col-2 ml-auto">Опубликовать</button>
    </form>
    <h4 class="text-center mt-2">Изменить новость</h4>
    <hr>
    <form action="upload_new_view" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-8">
                <label for="exampleFormControlSelect1">Выберите категорию</label>
                <select class="form-control" name="section">
                    <?php foreach ($sections as $section): ?>
                        <option value="<?php echo $section['id']; ?>"><?php echo $section['name']; ?></option>
                    <?PHP endforeach; ?>
                </select>
            </div>
            <div class="form-group col-4">
                <label for="exampleFormControlSelect1">Новость или форум</label>
                <?php if ($_SESSION['user']['rang'] == 6): ?>
                    <select class="form-control" name="new_or_forum" >
                        <option value="2">Новость</option>
                        <option value="5">форум</option>
                    </select>
                <?php endif; ?>
            </div>
            <button class="btn btn-dark col-2 mr-auto">Показать</button>
    </form>
    <hr>
    <?php if (isset($news_by_category)): ?>
        
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Username</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        
    <?php endif; ?>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>