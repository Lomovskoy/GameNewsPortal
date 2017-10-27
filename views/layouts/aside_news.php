<div class="col-md-2 mr-auto mt-5">
    <div class="card">
        <div class="list-group list-group-flush">
            <?php foreach ($sections as $section): ?>
            <a href="section-<?php echo $section['id']; ?>" class="list-group-item focus">
                <?php echo $section['icon']; ?>
                &nbsp<?php echo $section['name']; ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
