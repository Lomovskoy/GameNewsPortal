<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
    <h4 class="text-center mt-4">Ваши данные</h4>
    <hr>
    <div class="row">
    <form class="col-6" action="informationUpdate" method="POST" name="loginform">
        <div class="form-group">
            <label for="exampleDropdownFormEmail2"><span class="fa fa-user"></span>  New Login </label>
            <input type="text" name="login" class="form-control" value="<?PHP echo user['login'];?>">
        </div>
        <div class="form-group">
            <label for="exampleDropdownFormPassword2"><span class="fa fa-keyboard-o"></span>  New Password</label>
            <input type="password" name="password1" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleDropdownFormPassword2"><span class="fa fa-keyboard-o"></span>  repeat New Password</label>
            <input type="password" name="password1" class="form-control">
        </div>
        <button type="submit" class="btn btn-dark">Вход</button>
    </form>
    </div>
</div>


<?php include ROOT . '/views/layouts/footer.php'; ?>