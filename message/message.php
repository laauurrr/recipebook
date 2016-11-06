<h1>Message</h1>

<?php
    //determine page content
    switch($_GET['id']) {

        default: 
        $page_content = 'content_error.php';
    }

    include('../_master.php');
?>