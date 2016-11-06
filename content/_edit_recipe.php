<?php 
    if (isset($_GET['id'])) {
        $recipe = GetRecipe($_GET['id']);
    }else{
        //redirect to error page
        header('Location: message/message.php');
    }
?>

<div class="row">
    <div class="large-12 medium-12 columns">
        <h1>Edit Recipe</h1>
        <form action="data/_update-recipe.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="large-8 columns">
                    <label>Name
                        <?php echo '<input type="text" name="name" value="'.$recipe['name'].'"/>'; ?>
                        <input type="hidden" name="recipeid"/>
                    </label>
                </div>
                <div class="large-4 columns">
                    <label>Type
                        <select name="type">
                            <!--TODO Make this dynamic-->
                            <option value="0">Breakfast</option>
                            <option value="1">Lunch</option>
                            <option value="2">Dinner</option>
                            <option value="3">Pudding</option>
                            <option value="4">Misc</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-4 columns">
                    <label>Ingredients
                        <?php echo '<textarea name="ingredients" rows="8">'.$recipe['ingredients'].'</textarea>'; ?>
                    </label>
                </div>
                <div class="large-8 columns">
                    <label>Instructions
                        <textarea name="instructions" rows="8"></textarea>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-8 columns">
                    <input type="file" name="file">
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns text-center">
                    <button type="submit" class="button" name="submit">Update</button>
                    <button type="button" class="secondary button">Cancel</button>
                </div>            
            </div>            
        </form>
    </div>
</div>