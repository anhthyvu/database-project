<?php
    $page_title = "Delete Player";
    require_once "../database.php";

    // Get the team formation ID from the URL
    $teamID = isset($_GET['id']) ? $_GET['id'] : 0;
    $cmn=isset($_GET['cmn']) ? $_GET['cmn'] : 0;

    //Check if the teamID is valid
    $checkQuery = "
        SELECT * 
        FROM Role 
        WHERE TeamID = ? AND CMN = ?
    ";
    $stmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($stmt, "ii", $teamID, $cmn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $team = mysqli_fetch_assoc($result);

    if(!$team) {
        header("Location: index.php?error=Player not found in current team.");
        exit;
    }

    //Delete the team formation
    try{
        $deleteQuery = "DELETE FROM Role WHERE TeamID = ? AND CMN = ?";
        $stmt = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($stmt, "ii", $teamID, $cmn);
        
        if(!mysqli_stmt_execute($stmt)) {
            die("Error deleting player: " . mysqli_error($conn));
        } 

        mysqli_commit($conn);

        //Redirect to success page
        header("Location: index.php?success=Player deleted successfully.");
        exit();

    } catch (Exception $e) {
        header("Location: index.php?error=Failed to delete player.");
        exit;
    }
?>