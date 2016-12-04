<!--Updates posted recipe data in the database-->

<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '_data.php';
    
    $recipeid = "";
    $name = "";
    $type = -1;
    $ingredients = "";
    $instructions = "";
    $db = GetDB();

    if(isset($_POST['recipeid']))  {
        $recipeid = $_POST['recipeid'];
        $currentRecipe = GetRecipe($recipeid);
        $imageid = $currentRecipe['image']['id'];
    }

    if(isset($_POST['name']))  {
        $name = $_POST['name'];
    }

    if(isset($_POST['type']))  {
        $type = $_POST['type'];
    }

    if(isset($_POST['ingredients']))  {
        $ingredients = $_POST['ingredients'];
    }

    if(isset($_POST['instructions']))  {
        $instructions = $_POST['instructions'];
    }

    if(isset($_FILES['file']['name'])){
        if (strlen($_FILES['file']['name']) > 0) {
            // Insert the new image
            $fileName = $_FILES['file']['name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];
            $fileContents = file_get_contents($_FILES['file']['tmp_name'], 'rb');
            
            $sql = 'INSERT INTO image (image_name, image_data, image_size, image_type) '.
                    'VALUES(:name, :data, :size, :type)';

            $stmt = $db->prepare($sql);
            $stmt->execute(array(':name' => $fileName, ':data' => $fileContents, ':size' => $fileSize, ':type' => $fileType));

            $imageid = $db->lastInsertId();
        }
    }

    /* RECIPE */
    $sql = 'UPDATE recipe '.
            'SET recipe_name = :name, '.
            'type_id = :type, '.
            'image_id = :image '.
            'WHERE recipe_id = :id';

    $stmt = $db->prepare($sql);
    $stmt->execute(array(':name' => $name, ':type' => $type, ':image' => $imageid, ':id' => $recipeid));

    // If the image has been replaced, delete the old one
    if ($imageid != $currentRecipe['image']['id']) {
        $sql = 'DELETE FROM image WHERE image_id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $currentRecipe['image']['id']));
    }

    /* INGREDIENTS */
    // Delete the old ingredients first
    $sql = 'DELETE FROM ingredient WHERE recipe_id=:id';
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':id' => $recipeid));

    $displayorder = 0;
    
    foreach(explode("\n", $ingredients) as $name) {
        $sql = 'INSERT INTO ingredient(ingredient_name, ingredient_order, recipe_id) '.
                'VALUES(:name, :displayorder, :recipeid)';

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':name' => $name, ':displayorder' => $displayorder, ':recipeid' => $recipeid));

        $displayorder += 1;
    }

    /* INSTRUCTIONS */
    // Delete the old instructions first
    $sql = 'DELETE FROM instruction WHERE recipe_id=:id';
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':id' => $recipeid));

    $displayorder = 0;
    
    foreach(explode("\n", $instructions) as $name) {
        $sql = 'INSERT INTO instruction(instruction_name, instruction_order, recipe_id) '.
                'VALUES(:name, :displayorder, :recipeid)';

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':name' => $name, ':displayorder' => $displayorder, ':recipeid' => $recipeid));

        $displayorder += 1;
    }
    
    header('Location: ../view.php?id='.$recipeid);
?>