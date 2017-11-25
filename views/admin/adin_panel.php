<?php include ROOT . '/views/layouts/header.php'; ?>

    <div class="container">
        <?php if ($_SESSION['user']['rang']>= 2 && $_SESSION['user']['rang']<= 6 ): ?>
        <h4 class="text-center mt-4">Добро пожаловать.</h4>
        <div class="text-center"> 
            <small class="text-center">
                <em class="text-center"><?php echo Registration::getGreeting();?></em>
            </small>
        </div>
        <hr>
        <div class="row">
            <div class="col-3">
                <input type="button" class="btn btn-outline-secondary btn-block" value="Редакт. описание сайта"/>
                <input type="button" class="btn btn-outline-secondary btn-block" value="Редакт. комментарии"/>
                <input type="button" class="btn btn-outline-secondary btn-block" value="Редакт. статью, новость"/>
            </div>   
            <div class="col-3">
                <input type="button" class="btn btn-outline-dark btn-block" value="Редакт. категории шапке"/>
                <input type="button" class="btn btn-outline-dark btn-block" value="Редакт. раздел категории"/>
                <input type="button" class="btn btn-outline-dark btn-block" value="Редакт. администраторов"/>
            </div>
            <div class="col-6 border">
                <h6 class="text-center text-info">Личная информация</h6>
                    <p class="m-0">id: <?php echo $_SESSION['user']['id'];?></p>
                    <p class="m-0">Логин: <?php echo $_SESSION['user']['login'];?></p>
                    <p class="m-0">Ранг: <?php echo str_replace($_SESSION['user']['login'],'',Registration::getGreeting()); ?></p>
                    <p class="m-0">Имя: <?php echo $_SESSION['user']['name'];?></p>
                    <p class="m-0">Фамилия: <?php echo $_SESSION['user']['surname'];?></p>
                    <p class="m-0">Почта: <?php echo $_SESSION['user']['mail'];?></p>
                    <p class="m-0">О себе: <?php echo $_SESSION['user']['description'];?></p>
                    <p class="m-0">Интересы:
                        <?php echo str_replace(['#',' '],['|','|'],$_SESSION['user']['interests'].' '); ?>
                    </p>
                    <a class="btn btn-outline-info btn-block col-6 ml-auto" href="change_form/<?php echo $_SESSION['user']['id'] ?>">Редактировать</a>
            </div>
        </div>
        <!--                      *****                          -->
        <?php else:?>
        <h4 class="text-center mt-4">Вам здесь не рады.</h4>
        <?php endif;?>
    </div>
        
<?php include ROOT . '/views/layouts/footer.php'; ?>

