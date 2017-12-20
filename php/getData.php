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

        $subjects_stmnt = $pdo->prepare("CALL getSubjectsLessons()");
        $subjects_stmnt->execute();
        $subjects = $subjects_stmnt->fetchAll();
        $subjects_stmnt->closeCursor();
/*
        $teachers_stmnt = $pdo->prepare("CALL getTeachersLessons()");
        $teachers_stmnt->execute();
        $teachers = $teachers_stmnt->fetchAll();
        $teachers_stmnt->closeCursor();

        $lessons_stmnt = $pdo->prepare("CALL getLessonsLessons()");
        $lessons_stmnt->execute();
        $lessons = $lessons_stmnt->fetchAll();
        $lessons_stmnt->closeCursor();
*/
        $response = array(
          'status' => SUCCESS,
          'subjects' => $subjects,
          //'teachers' => $teachers,
          //'lessons' => $lessons
        );

        $pdo->commit();
    } catch (Exception $e) {
      //Response if there is a SQL Error
      $pdo->rollBack();
      $response = array('status' => SQL_FAIL, 'error' => $e);
    }

    echo json_encode($response);
?>
