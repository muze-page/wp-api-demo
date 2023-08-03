<?php
get_header();
// Custom template code goes here



?>

<header class="entry-header alignwide">
    <h1 class="entry-title">
        <?php
        $title = get_the_title();
        echo $title;
        ?>
    </h1>

</header>
<div class="entry-content">
    <?php
    $content = get_the_content();
    echo $content;
    ?>
</div>

<div id="apps"></div>

<?php

?>
<?php
get_footer();
