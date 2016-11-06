<?php
    $servername = 'localhost';
    $username = 'root';
    $password = 'gnutella';
    $dbname = 'db_recipes';
    
    try {
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "connected successfully";

        $id = 1;
        $recipe['id'] = $id;

        $stmt = $db->prepare("SELECT * FROM recipe WHERE id=:id");
        $stmt->execute(array(':id' => $id));
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($rows as $row) {
            $recipe['title'] = $row['title'];

            echo $recipe['title'];

            foreach($db->query('SELECT * FROM ingredient WHERE recipeid='.$id.' order by displayorder') as $ingredient) {
                $recipe['ingredients'][$ingredient['displayorder']] = $ingredient['title'];
            }

            foreach($db->query('SELECT * FROM instruction WHERE recipeid='.$id.' order by displayorder') as $instruction) {
                $recipe['instructions'][$instruction['displayorder']] = $instruction['title'];
            }
        }
    } catch (PDOException $ex) {
        echo "connection failed: " . $ex->getMessage();
    } finally {
        $db = null;
    }
?>