<?php
$title = get_the_title();
?>

<header class="page-header">
    <h2 class="page-header__title" itemprop="headline">
        <?= esc_html($title); ?>
    </h2>
</header>