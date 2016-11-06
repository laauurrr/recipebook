<?php 
    if (isset($_GET['id'])) {
        $recipe = GetRecipe($_GET['id']);
    }else{
        $recipe = GetRecipe(7);
    }
?>

<div class="row">
    <div class="large-4 medium-12 columns text-center">
        <!--<p>-->
            <?php 
                echo '<p><img class="recipe-image" src="data:image/'.$recipe['image']['type'].';base64,'.base64_encode($recipe['image']['data']).'"/></p>';
            ?>
        <!--</p>-->
        <?php echo '<a href="edit.php?id='.$recipe['id'].'" class="small button">Edit Recipe</a>'; ?>
        <button type="button" class="small button">Delete Recipe</button>
    </div>

    <div class="large-8 medium-12 columns">
        <!--<div class="callout secondary">-->
            <h1><?php echo $recipe['name']; ?></h1>
            <h2>Ingredients</h2>
            <ul class="no-bullet">
                <?php foreach($recipe['ingredients'] as $i) {
                    echo '<li>' . $i . '</li>';} ?>
            </ul>
            <h2>Instructions</h2>
            <ol>
                <?php foreach($recipe['instructions'] as $i) {
                    echo '<li>' . $i . '</li>';} ?>
            </ol>
        <!--</div>-->
    </div>
</div>