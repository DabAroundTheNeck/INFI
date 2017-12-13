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
        $post_f_name = json_decode($post_data)->{'fName'};
        $post_l_name = json_decode($post_data)->{'lName'};
        $post_short = json_decode($post_data)->{'short'};

        $teachers_stmnt = $pdo->prepare("insert into teachers(f_name, l_name, short) values(:f_name, :l_name, :short)");
        $teachers_stmnt->bindParam(':f_name', $post_f_name);
        $teachers_stmnt->bindParam(':l_name', $post_l_name);
        $teachers_stmnt->bindParam(':short', $post_short);

        $teachers_stmnt->execute();
        $teachers_stmnt->closeCursor();


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
