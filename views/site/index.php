<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">
    <h3 class="text-info text-center mt-4"><?php echo $decoration['caption']; ?></h3>
    <p>
        <?php echo $decoration['description']; ?> 
    </p>
    <h3 class="text-info text-center mt-4">Последние новости</h3>
    <hr>
    <div class="row">
        <?php foreach ($latestNews as $News): ?>
            <div class="col-md-3">
                <div class="card mb-3">
                    <?php if ($News['image'] == "no-image.jpg"): ?>
                        <div class="new-image" style="background-image:url(upload/images/<?PHP echo $News['image']; ?>);">
                        <?php else: ?>
                            <div class="new-image" style="background-image:url(upload/images/news/<?PHP echo $News['folder_name']; ?>/<?PHP echo $News['image']; ?>);">
                            <?php endif; ?>
                            <span class="badge badge-pill badge-danger"><?PHP echo $News['section_name']; ?></span>
                        </div>
                        <div class="card-body p-2">
                            <p class="card-text m-0">
                                <a href="category-2/new-<?PHP echo $News['id']; ?>" class="card-link"><?PHP echo $News['caption']; ?></a>
                            </p>
                            <p class="card-text text-right"><small class="text-danger"><em><?PHP echo $News['date']; ?></em></small></p>
                        </div>
                    </div>
                </div>
            <?PHP endforeach; ?>
        </div>
    </div>
</div>
<?php include ROOT . '/views/layouts/footer.php'; ?>