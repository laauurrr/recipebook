<!--Inserts posted recipe data into the database-->

<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include '_data.php';

    $name = "";
    $type = -1;
    $ingredients = "";
    $instructions = "";

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
        $fileName = $_FILES['file']['name'];
        $tmpName  = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        $fp = file_get_contents($_FILES['file']['tmp_name'], 'rb');
        //echo $fp;

        // echo '<h1>Image Test</h1>';;
        // echo '<p><img src="data:image/'.$fileType.';base64,'.base64_encode($fp).'"/></p>';
    }

    /* IMAGE */
    $db = GetDB();
    $sql = 'INSERT INTO image (image_name, image_data, image_size, image_type) '.
            'VALUES(:name, :data, :size, :type)';

    $stmt = $db->prepare($sql);
    $stmt->execute(array(':name' => $fileName, ':data' => $fp, ':size' => $fileSize, ':type' => $fileType));

    $imageid = $db->lastInsertId();

    /* RECIPE */
    $sql = 'INSERT INTO recipe(recipe_name, type_id, image_id) '.
            'VALUES(:name, :type, :imageid)';

    $stmt = $db->prepare($sql);
    $stmt->execute(array(':name' => $name, ':type' => $type, ':imageid' => $imageid));

    $recipeid = $db->lastInsertId();

    /* INGREDIENTS */
    $displayorder = 0;
    
    foreach(explode("\n", $ingredients) as $name) {
        $sql = 'INSERT INTO ingredient(ingredient_name, ingredient_order, recipe_id) '.
                'VALUES(:name, :displayorder, :recipeid)';

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':name' => $name, ':displayorder' => $displayorder, ':recipeid' => $recipeid));

        $displayorder += 1;
    }

    /* INSTRUCTIONS */
    $displayorder = 0;
    
    foreach(explode("\n", $instructions) as $name) {
        $sql = 'INSERT INTO instruction(instruction_name, instruction_order, recipe_id) '.
                'VALUES(:name, :displayorder, :recipeid)';

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':name' => $name, ':displayorder' => $displayorder, ':recipeid' => $recipeid));

        $displayorder += 1;
    }
    
    echo $recipeid;
    header('Location: ../view.php?id='.$recipeid);
?>