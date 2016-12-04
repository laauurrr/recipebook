<?php
    $types = ListTypes();
?>

<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar mobile-top-bar desktop-top-bar show-for-small-only" data-topbar role="navigation" id="example-menu">
    <div class="top-bar-left">
        <ul class="dropdown menu vertical" data-dropdown-menu>
            <li>
                <a class="button" href="list.php?id=-1">All</a></li>
            <?php
                foreach ($types as $id => $type) {
                    $recipes = ListRecipes($id);
                    echo '<li><a class="button" href="list.php?id='.$id.'">' . $type . '</a></li>';
                }
            ?>

            <li><a href="create.php" class="secondary button">Create Recipe</a></li>
        </ul>
    </div>
</div>

<div class="top-bar desktop-top-bar hide-for-small-only" data-topbar role="navigation">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="site-logo menu-text">RECIPE BOOK</li>
            <li>
                <a class="button" href="list.php?id=-1">All</a></li>
            <?php
                foreach ($types as $id => $type) {
                    $recipes = ListRecipes($id);
                    echo '<li><a class="button" href="list.php?id='.$id.'">' . $type . '</a></li>';
                }
            ?>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
            <li><a href="create.php" class="secondary button">Create Recipe</a></li>
        </ul>
    </div>
</div>