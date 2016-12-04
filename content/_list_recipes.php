<?php
    if (isset($_GET['id'])) {
        if ($_GET['id'] == -1) {
            $type = "All";
            $recipes = ListAllRecipes();
        } else {
            $type = GetTypeName($_GET['id']);
            $recipes = ListRecipes($_GET['id']);
        }
    } else {
        $type = "All";
        $recipes = ListAllRecipes();
    }
?>

<div class="row">
    <div class="large-12 medium-12 columns">
        <div class="row">
            <div class="large-12 medium-12 columns">
                <h1>
                    <?php
                        echo $type . ' Recipes';
                    ?>
                </h1>
            </div>
        </div>
        <div class="row">
        <?php
            foreach ($recipes as $id => $recipe) {
                echo '<a href="view.php?id=' . $id . '">';
                    echo '<div class="large-3 medium-4 small-12 columns end" >';
                        echo '<div class="callout recipe-list-view" >';
                            echo '<div class="row">';
                                echo '<div class="large-6 medium-6 columns hide-for-small-only" >';
                                    echo '<p class="hide-for-small-only"><img class="recipe-image" style="height:5rem;" src="data:image/'.$recipe['image']['type'].';base64,'.base64_encode($recipe['image']['data']).'"/></p>';
                                echo '</div>';
                                echo '<div class="large-6 medium-6 columns" >';
                                    echo '<strong>' . $recipe['name'] . '</strong>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</a>';
            }
        ?>
        </div>
    </div>
</div>