<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container-fluid">
    <div class="row">

        <?php include ROOT . '/views/layouts/aside_news.php'; ?>

        <div class="col-md-8 mr-auto">
            <h3 class="text-info text-center mt-4"><?php echo $sectionNews[0]['section_name']; ?></h3>
            <hr>
            <div class="row">
                <?php foreach ($sectionNews as $News): ?>
                    <div class="card mb-2">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php if ($News['image'] == "no-image.jpg"): ?>
                                        <img class="img-fluid" src="upload/images/<?PHP echo $News['image']; ?>">
                                    <?php else: ?>
                                        <img class="img-fluid" src="upload/images/news/<?PHP echo $News['folder_name']; ?>/<?PHP echo $News['image']; ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-8">
                                    <p class="text-center">
                                        <a href="category-<?PHP echo $section['id_categories']; ?>/new-<?PHP echo $News['id']; ?>"class="h5 text-info mt-4"><?PHP echo $News['caption']; ?></a>
                                    </p>
                                    <hr>
                                    <p class="m-0"><?PHP echo $News['description']; ?></p>
                                    <p class="m-0">
                                        <span class="float-right text-warning small font-italic"><?PHP echo $News['date']; ?></span>
                                        <span class="text-success">Автор: <?PHP echo $News['author_login']; ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?PHP endforeach; ?>
            </div>
        </div>    
    </div>

</div>   
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>
