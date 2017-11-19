<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include ROOT . '/views/layouts/aside_news.php'; ?>
        <div class="col-md-8 mr-auto mt-5">
            <div class="card mb-2">
                <div class="card-body p-2">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                <a class="h5 text-info mt-4"><?PHP echo $New['caption']; ?></a>
                            </p>
                            <hr>
                            <?php if ($New['image'] == "no-image.jpg"): ?>
                                <img class="img-fluid float-left mr-3" src="upload/images/<?PHP echo $New['image']; ?>">
                            <?php else: ?>
                                <img class="img-fluid float-left mr-3" src="upload/images/news/<?PHP echo $New['folder_name']; ?>/<?PHP echo $New['image']; ?>">
                            <?php endif; ?>
                            <p class="m-0"><?PHP echo $New['description']; ?></p>
                            <p class="m-0">
                                <span class="float-right text-danger small font-italic"><?PHP echo $New['date']; ?></span>
                                <span class="text-success">Автор: <?PHP echo $New['author_login']; ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </div>   
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>        
