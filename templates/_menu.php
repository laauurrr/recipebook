<?php
    $types = ListTypes();
?>

 <!--DESKTOP TOP BAR-->
<div class="top-bar desktop-top-bar">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="site-logo menu-text">RECIPE BOOK</li>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Browse Recipes</a>
                <ul class="menu vertical">
                    <?php
                        foreach ($types as $id => $type) {
                            $recipes = ListRecipes($id);
                            echo '<li><a href="#">' . $type . '</a>';
                            if ($recipes != null) {
                                echo '<ul class="menu vertical">';
                                foreach ($recipes as $id => $r) {
                                    echo '<li><a href="index.php?id='.$id.'">'.$r.'</a></li>';
                                }
                                echo '</ul>';
                            }
                            echo '</li>';
                        }
                    ?>
                </ul>
            </li>
            <li><a href="create.php">Create Recipe</a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
        <li><input type="search" placeholder="Search"></li>
        <li><button type="button" class="button">Search</button></li>
        </ul>
    </div>
</div>

<!--MOBILE TOP BAR-->
<!--TBA-->