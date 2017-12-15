<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
    <h3 class="text-info text-center mt-4"><?php echo $decoration['caption']; ?></h3>
    <hr>
    <p>
        <?php echo $decoration['description']; ?> 
    </p>
    <hr>
    <h5 class="text-info text-center mt-2">
        Наши партнёры
    </h5>
    <hr>
    <div class="row">
        <?php foreach ($parners as $parner): ?>
        <div class="col-md-2">
            <div class="card mb-1">
                <a href="<?php echo $parner['src']; ?>" target="_blank">
                    <img class="img-fluid" src="upload/images/description/<?php echo $parner['image']; ?>" alt="Партнёр" >
                </a>
            </div>
        </div>
        <?PHP endforeach; ?>
    </div>
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>

