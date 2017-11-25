<?php include ROOT . '/views/layouts/header.php'; ?>

    <div class="container">
        <?php if ($_SESSION['user']['rang']==1): ?>
        <h4 class="text-center mt-4">Добро пожаловать.</h4>
        
        <?php else:?>
        <h4 class="text-center mt-4">Вам здесь не рады.</h4>
            
        <?php endif;?>
    </div>    

<?php include ROOT . '/views/layouts/footer.php'; ?>

