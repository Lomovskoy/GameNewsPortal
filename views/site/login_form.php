<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="row my-4 ml-2">
    <div class="col-7">
        <h5 class="text-center"><?php echo $decoration['caption']; ?></h5>
        <hr>
        <p class="text-info mt-2">
            <?php echo $decoration['description']; ?>  
        </p>
    </div>
    <form class="container col-4" action="logincheck" method="POST" name="loginform">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li> - <?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="form-group">
            <label for="exampleDropdownFormEmail2"><span class="fa fa-user"></span> Login </label>
            <input type="text" name="login" class="form-control" id="exampleDropdownFormEmail2">
        </div>
        <div class="form-group">
            <label for="exampleDropdownFormPassword2"><span class="fa fa-keyboard-o"></span> Password</label>
            <input type="password" name="password" class="form-control" id="exampleDropdownFormPassword2">
        </div>
        <button type="submit" class="btn btn-dark">Вход</button>
    </form>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>

