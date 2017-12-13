<?php
    session_start();
    include 'functions.php';
    include 'constants.php';

    $response = array();

    //Creating a connection to the Database
    $pdo = create_pdo();

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();

        $post_data = file_get_contents("php://input");
        $post_lvnr = json_decode($post_data)->{'lvnr'};
        $post_title = json_decode($post_data)->{'title'};
        $post_groups = json_decode($post_data)->{'groups'};

        $subjects_stmnt = $pdo->prepare("insert into subjects(lvnr, title, groupsRequired) values(:lvnr, :title, :groupsRequired)");
        $subjects_stmnt->bindParam(':lvnr', $post_lvnr);
        $subjects_stmnt->bindParam(':title', $post_title);
        $subjects_stmnt->bindParam(':groupsRequired', $post_groups);

        $subjects_stmnt->execute();
        $subjects_stmnt->closeCursor();


        $response = array(
          'status' => SUCCESS
        );

        $pdo->commit();
    } catch (Exception $e) {
      //Response if there is a SQL Error
      $pdo->rollBack();
      $response = array('status' => SQL_FAIL, 'error' => $e);
    }

    echo json_encode($response);
?>
