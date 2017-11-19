<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
    <h3 class="text-info text-center mt-4"><?php echo $decoration['caption']; ?></h3>
    <hr>
    <p class="text-center">
        <?php echo $decoration['description']; ?> 
    </p>
    <hr>
    <h5><span class="fa fa-thumb-tack badge badge-pill badge-info">
        Москва, пр. Волоколамский, дом 6
    </span></h5>
    <h5><span class="fa fa-phone-square badge badge-pill badge-info">
        + 7 (499) 740-82-39
    </span></h5>
    <h5><span class="fa fa-skype badge badge badge-pill badge-info">
        info.seosystem
    </span></h5>
    <h5><span class="fa fa-envelope-o badge badge-pill badge-info">
        info@seosystem.ru
    </span></h5>
    
    <script 
        type="text/javascript" 
        charset="utf-8" 
        async 
        src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A6b2e590a228c890079f0ccb16adb987e07e53adf12d2078173cda98458b2a9df&amp;width=878&amp;height=359&amp;lang=ru_RU&amp;scroll=true">
    </script>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>

