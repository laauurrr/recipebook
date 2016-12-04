<?php
    function GetDB() {
        try {
            $servername = 'localhost';
            $username = 'root';
            $password = 'gnutella';
            $dbname = 'db_recipes';

            $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo "connection failed: " . $ex->getMessage();
        }

        return $db;
    }

    function GetTypeName($id) {
        $db = GetDB();
        $sql = 'SELECT type_name FROM type WHERE type_id=:id';
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $type = null;
        
        foreach($result as $row) {
            $type = $row['type_name'];
        }
        return $type;
    }

    function ListTypes() {
        $db = GetDB();
        $sql = 'SELECT * FROM type';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $types = null;
        
        foreach($result as $row) {
            $types[$row['type_id']] = $row['type_name'];
        }
        return $types;
    }

    function ListRecipes($type) {
        $db = GetDB();
        $sql = 'SELECT * '.
                'FROM recipe r, image i '.
                'WHERE r.image_id = i.image_id '.
                'AND type_id=:type '.
                'ORDER BY recipe_name '; 

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':type' => $type));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $recipe = null;
        $recipes = null;
        
        foreach($result as $row) {
            $recipe['name'] = $row['recipe_name'];
            $recipe['image']['id'] = $row['image_id'];
            $recipe['image']['imagename'] = $row['image_name'];
            $recipe['image']['data'] = $row['image_data'];
            $recipe['image']['type'] = $row['image_type'];

            $recipes[$row['recipe_id']] = $recipe;
        }

        return $recipes;
    }

    function ListAllRecipes() {
        $db = GetDB();
        $sql = 'SELECT * '.
                'FROM recipe r, image i '.
                'WHERE r.image_id = i.image_id '.
                'ORDER BY recipe_name '; 
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $recipe = null;
        $recipes = null;
        
        foreach($result as $row) {
            $recipe['name'] = $row['recipe_name'];
            $recipe['image']['id'] = $row['image_id'];
            $recipe['image']['imagename'] = $row['image_name'];
            $recipe['image']['data'] = $row['image_data'];
            $recipe['image']['type'] = $row['image_type'];

            $recipes[$row['recipe_id']] = $recipe;
        }

        return $recipes;
    }

    function GetRecipe($id) {
        $db = GetDB();
        $recipe['id'] = $id;

        $sql = 'SELECT * '.
                'FROM recipe r, image i '.
                'WHERE r.recipe_id = :recipe_id '.
                'AND r.image_id = i.image_id';

        $stmt = $db->prepare($sql);
        $stmt->execute(array(':recipe_id' => $id));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($result as $row) {
            $recipe['name'] = $row['recipe_name'];
            $recipe['type'] = $row['type_id'];

            foreach($db->query('SELECT * FROM ingredient WHERE recipe_id='.$id.' order by ingredient_order') as $ingredient) {
                $recipe['ingredients'][$ingredient['ingredient_order']] = $ingredient['ingredient_name'];
            }

            foreach($db->query('SELECT * FROM instruction WHERE recipe_id='.$id.' order by instruction_order') as $instruction) {
                $recipe['instructions'][$instruction['instruction_order']] = $instruction['instruction_name'];
            }

            $recipe['image']['id'] = $row['image_id'];
            $recipe['image']['imagename'] = $row['image_name'];
            $recipe['image']['data'] = $row['image_data'];
            $recipe['image']['type'] = $row['image_type'];
        }
      
        return $recipe;
    }

?>