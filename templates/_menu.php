<?php
    $types = ListTypes();
?>

<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title">Menu</div>
</div>

 <!--DESKTOP TOP BAR-->
<div class="top-bar desktop-top-bar" data-topbar role="navigation" id="example-menu">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="site-logo menu-text">RECIPE BOOK</li>
            <?php
                foreach ($types as $id => $type) {
                    $recipes = ListRecipes($id);
                    echo '<li><a class="secondary button" href="#">' . $type . '</a>';
                    if ($recipes != null) {
                        echo '<ul class="menu vertical left">';
                        foreach ($recipes as $id => $r) {
                            echo '<li><a class="secondary button left" href="index.php?id='.$id.'">'.$r.'</a></li>';
                        }
                        echo '</ul>';
                    }
                    echo '</li>';
                }
            ?>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
            <!--<li><input type="search" placeholder="Search"></li>
            <li><button type="button" class="button">Search</button></li>-->
            <li><a href="create.php" class="button">Create Recipe</a></li>
        </ul>
    </div>
</div>

<!--MOBILE TOP BAR-->
<!--TBA-->