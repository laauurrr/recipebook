<?php 
    if (isset($_GET['id'])) {
        $recipe = GetRecipe($_GET['id']);
    }else{
        $recipe = GetRecipe(7);
    }
?>

<div class="row">
    <div class="large-4 medium-12 columns">
        <!--<p><img src="http://lorempixel.com/320/240/food/" alt="Recipe Image" /></p>-->
        <p>
            <?php 
                echo '<p><img src="data:image/'.$recipe['image']['type'].';base64,'.base64_encode($recipe['image']['data']).'"/></p>';
            ?>
        </p>
        <?php echo '<a href="edit.php?id='.$recipe['id'].'" class="button">Edit Recipe</a>'; ?>
        <button type="button" class="button">Delete Recipe</button>
    </div>

    <div class="large-8 medium-12 columns">
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
    </div>
</div>