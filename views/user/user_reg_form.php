<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
    <h3 class="text-center mt-4">Форма регистрации</h3>
    <hr>
    <form class="col-4 mt-4 p-4 rounded container" action="ragistration_user" method="POST">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li> - <?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="form-group">
            <label for="exampleFormControlInput1">Login</label>
            <input type="text" class="form-control" name="login" min="3" max="20">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Email address</label>
            <input type="email" class="form-control" name="email" max="255">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Enter password</label>
            <input type="password" class="form-control" name="password1" min="6" max="20">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Repit password</label>
            <input type="password" class="form-control" name="password2" min="6" max="20">
        </div>
        <button type="submit" class="btn btn-dark">Регистрация</button>
    </form>

</div>


<?php include ROOT . '/views/layouts/footer.php'; ?>
