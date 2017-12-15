<?php include ROOT . '/views/layouts/header.php'; ?>
<div class="container">
    <h4 class="text-center mt-4">Изменить описание сайта.</h4>
    <hr>
    <?php foreach ($decorationAll as $decoration): ?>
        <form action="decoration_update/<?PHP echo $decoration['id']; ?>" method="POST">
            <table class="table table-bordered table-dark mb-0">
                <thead>
                    <tr>
                        <th>Категория</th>
                        <th>Заголовок</th>
                        <th>Описание</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p><?php echo $decoration['categiri_name']; ?></p>
                        </td>
                        <td>
                            <p> <?php echo $decoration['caption']; ?></p>
                        </td>
                        <td>
                            <textarea rows="15" class="form-control" name="description"> <?php echo $decoration['description']; ?></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-secondary btn-block col-1 ml-auto mb-1">Изменить</button>
        </form>
    <?PHP endforeach; ?>
    <h4 class="text-center mt-4">Изменить партнёров.</h4>
    <hr>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">image</th>
                <th scope="col">name</th>
                <th scope="col">Загрузка</th>
                <th scope="col">Ссылка</th>
                <th scope="col" colspan="2">обновить | удалить</th>
            </tr>
        </thead>
        <?php foreach ($parners as $parner): ?>
            <form action="update_partners/<?php echo $parner['id']; ?>" enctype="multipart/form-data" method="POST">
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $parner['id']; ?></th>
                        <td><img class="img-fluid" src="upload/images/description/<?php echo $parner['image']; ?>" alt="<?php echo $parner['image']; ?>" style="width: 75px"></td>
                        <td><?php echo $parner['image']; ?><input type="hidden" name="name" value="<?php echo $parner['image']; ?>"></td>
                        <td>
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $parner['id']; ?>">
                                <input type="hidden" name="MAX_FILE_SIZE" value="1050000">
                                <input type="file" accept="image/jpeg,image/png" class="form-control-file" name="image" >
                            </div>
                        </td>
                        <td><input class="form-control" value="<?php echo $parner['src']; ?>" name="src"/></td>
                        <td><button name="upload_partners" class="fa fa-pencil-square-o btn btn-light"></button></td>
                        <td><button name="delite_partners" class="fa fa-close btn btn-light"></button></td>
                    </tr>
                </tbody>
            </form>
        <?PHP endforeach; ?>

        <form action="add_partners" enctype="multipart/form-data" method="POST">
            <tbody>
                <tr>
                    <th scope="row"><?php echo $parner['id'] + 1; ?></th>
                    <td><img class="img-fluid " src="upload/images/no-image.jpg" style="width: 75px"></td>
                    <td>
                        <div class="form-group">
                            <input type="hidden" name="MAX_FILE_SIZE" value="105000">
                            <input type="file" accept="image/jpeg,image/png" class="form-control-file" name="image" >
                        </div>
                    </td>
                    <td><input class="form-control" name="src"></td>
                    <td colspan="3"><button type="submit" name="add" class="btn btn-light ml-4">Добавить</button></td>
                </tr>
            </tbody>
    </table>
    <?php foreach ($errors as $error): ?>
        <li> - <?php echo $error; ?></li>
    <?php endforeach; ?>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>