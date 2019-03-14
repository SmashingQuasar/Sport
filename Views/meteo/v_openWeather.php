<!--- Elie Bismuth -->

<?php if($error) : ?>

    <div class="alert alert-danger">
        <?= $error ?>
    </div>

<?php else : ?>

<div class="container">
    <ul>
        <?php foreach($forecast as $day) : ?>
            <li>
                <?= $day['date']->format('d/m/y')?> <?= $day['description'] ?> <?= $day['temp'] ?> C
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php endif; ?>