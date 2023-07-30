<?php include('../config.php'); ?>
<?php
// Check the HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET'){
    // Get all projects, Get project
    try {
        if (empty($_GET)){
            // Get all projects
            $sql_statement = "SELECT * FROM Project";
            $result = mysqli_query($db, $sql_statement);
            $projects = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $projects[] = $row;
            } 
            header('Content-Type: application/json');
            echo json_encode($projects);
        }else{
            // Get project
            $projectId = intval($_GET['projectId']);
            $sql_statement = "SELECT * FROM Project WHERE id=$projectId";

            $resultProject = mysqli_query($db, $sql_statement);
            $row = mysqli_fetch_assoc($resultProject);

            $resultStep=mysqli_query($db, "SELECT * FROM Step WHERE projectId=$projectId");
            $steps = array();
            while ($rowStep = mysqli_fetch_assoc($resultStep)) {
                $steps[] = $rowStep;
            } 
            $row['steps'] = $steps;

            header('Content-Type: application/json');
            echo json_encode($row);
        }
    } catch (\Throwable $th) {
        http_response_code(500);
        echo "error updating data";
    }
}
else if ($method === 'PUT'){
    // Edit Project
    try {
    // Get Data from Body
    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData, true);

    $id = intval($data['id']);
    $title = $data['title'];
    $description = $data['description'];
    $status = $data['status'];
    $endDate = $data['endDate'];
    
    $sql_statement = "UPDATE Project 
    SET title=?, description=?, statu=?, endDate=?
    WHERE id=?";

    // SQL statement preparation
    $stmt = mysqli_prepare($db, $sql_statement);

    if (!$stmt) {
        echo "Error: " . mysqli_error($db);
        exit;
    }

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ssssi", $title, $description, $status, $endDate, $id);

    if (mysqli_stmt_execute($stmt)) {
        // Update successful
        http_response_code(200);
        echo "Project updated successfully.";
    } else {
        // Update failed
        http_response_code(404);
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    // Close statement
    mysqli_stmt_close($stmt);
} catch (\Throwable $th) {
    http_response_code(500);
    echo "error updating data";
}
}
else if ($method === 'DELETE'){
    // Delete Project
    try {
        // Get id from query
        $projectId = intval($_GET['projectId']);
        if (mysqli_query($db, "DELETE FROM Project WHERE id = $projectId")) {
            // Deletion successful
            http_response_code(200);
        } else {
            // Deletion failed
            http_response_code(404);
            echo "Error: " . mysqli_error($db);
        }
    } catch (\Throwable $th) {
        http_response_code(500);
        echo "error deleting data";
    }
}
?>