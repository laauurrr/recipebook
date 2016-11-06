<?php 
    if (isset($_GET['id'])) {
        $recipe = GetRecipe($_GET['id']);
    }else{
        //redirect to error page
        header('Location: message/message.php');
    }

    $types = ListTypes();

    function buildOptionTag($id, $type, $recipetype) {
        $selected = '';

        if ($recipetype == $id) {
            $selected = ' selected';
        }

        return '<option value="'.$id.'"'.$selected.'>'.$type.'</option>';
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
                        <?php echo '<input type="hidden" name="recipeid" value="'.$recipe['id'].'"/>'; ?>
                    </label>
                </div>
                <div class="large-4 columns">
                    <label>Type
                        <select name="type">
                            <?php
                                foreach ($types as $id => $type) {
                                    echo buildOptionTag($id, $type, $recipe['type']);
                                }
                            ?>
                        </select>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-4 columns">
                    <label>Ingredients
                        <textarea name="ingredients" rows="8"><?php 
                                foreach ($recipe['ingredients'] as $ingredient) {
                                    echo $ingredient;
                                } 
                        ?></textarea>
                    </label>
                </div>
                <div class="large-8 columns">
                    <label>Instructions
                        <textarea name="instructions" rows="8"><?php 
                                foreach ($recipe['instructions'] as $instruction) {
                                    echo $instruction;
                                } 
                        ?></textarea>
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