<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
    <h4 class="text-center mt-4">Ваши данные</h4>
    <hr>
    <form action="information_update/<?PHP echo $user['id']; ?>" enctype="multipart/form-data" method="POST" name="userupdate" >
        <ul>
            <?php foreach ($errors as $error): ?>
                <li> - <?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleDropdownFormEmail2"><span class="fa fa-user-secret"></span>  New Login </label>
                    <input type="text" name="login" class="form-control" value="<?PHP echo $user['login']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleDropdownFormEmail2"><span class="fa  fa-envelope-o"></span>  New Mail </label>
                    <input type="email" name="mail" class="form-control" value="<?PHP echo $user['mail']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleDropdownFormEmail2"><span class="fa fa-user-circle"></span>  New Name </label>
                    <input type="text" name="name" class="form-control" value="<?PHP echo $user['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleDropdownFormEmail2"><span class="fa fa-user-circle-o"></span>  New Surname </label>
                    <input type="text" name="surname" class="form-control" value="<?PHP echo $user['surname']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleDropdownFormPassword2"><span class="fa fa-keyboard-o"></span>  New Password (Заполните оба поля если хотите поменять пароль)</label>
                    <input type="password" name="password1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleDropdownFormPassword2"><span class="fa fa-keyboard-o"></span>  repeat New Password</label>
                    <input type="password" name="password2" class="form-control">
                </div>
            </div>
            
            <div class="col-6">
                <div class="form-group">
                    <label for="exampleDropdownFormEmail2"><span class="fa fa-id-card"></span>  New Description </label>
                    <textarea  rows="10" name="description" class="form-control"><?PHP echo $user['description']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleDropdownFormEmail2"><span class="fa fa-hashtag "></span>  New Interests (Напишите свои интересы - поставив перед словом #, и резделив их пробелами #Музыка #Спорт)</label>
                    <input name="interests" class="form-control" value="<?PHP echo $user['interests']; ?>">
                </div>
                <div class="form-group">
                    <p>Загружаемое изображение не должно превышать 105 КБ</p>
                    <img src="upload/images/avatar/<?PHP echo $user['image']; ?>" alt="Фото" class="rounded-circle col-2 mb-2">
                    <label for="exampleFormControlFile1">
                        <span class="fa fa-file-photo-o">  <?PHP echo $user['image']; ?>
                    </label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="105000">
                    <input type="file" accept="image/jpeg,image/png" class="form-control-file" name="image" >
                    <!--name="MAX_FILE_SIZE" value="67108864"-->
                </div>
            </div>
            <button type="submit" class="btn btn-dark ml-auto mr-3">Изменить</button>
        </div>
    </form>
</div>


<?php include ROOT . '/views/layouts/footer.php'; ?>