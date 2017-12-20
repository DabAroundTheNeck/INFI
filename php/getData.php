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

        $subjectsLessons_stmnt = $pdo->prepare("CALL getSubjectsLessons()");
        $subjectsLessons_stmnt->execute();
        $subjects = $subjectsLessons_stmnt->fetchAll();
        $subjectsLessons_stmnt->closeCursor();

        $response = array(
          'status' => SUCCESS,
          'subjects' => $subjects,
        );

        $pdo->commit();
    } catch (Exception $e) {
      //Response if there is a SQL Error
      $pdo->rollBack();
      $response = array('status' => SQL_FAIL, 'error' => $e);
    }

    echo json_encode($response);
?>
