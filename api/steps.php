<?php include('../config.php'); ?>
<?php
// Check the HTTP request method
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'GET'){
    // Get all steps
    $sql_statement = "SELECT * FROM Step";
    $result = mysqli_query($db, $sql_statement);
    $steps = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $steps[] = $row;
    } 
    header('Content-Type: application/json');
    echo json_encode($steps);
}
else if ($method === 'POST'){
    // Add step
    try {
        // Get Data from Body
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        $title = $data['title'];
        $description = $data['description'];
        $completed = $data['completed'];
        $projectId = intval($data['projectId']);
        
        $sql_statement = "INSERT INTO Step (title, description, completed, projectId) 
                VALUES ('$title','$description','$completed','$projectId')";
        
        if (mysqli_query($db, $sql_statement)) {
            // Insertion successful
            header('Content-Type: application/json');
            http_response_code(201);
            echo json_encode($data);
        } else {
            // Insertion failed
            echo "Error: " . mysqli_error($db);
        }
    } catch (\Throwable $th) {
        http_response_code(500);
        echo "error inserting data";
    }
}
else if ($method === 'DELETE'){
    // Delete Skill
    try {
        // Get id from query
        $stepId = intval($_GET['stepId']);
        if (mysqli_query($db, "DELETE FROM Step WHERE id = $stepId")) {
            // Deletion successful
            http_response_code(200);
            echo 'Value deleted.';
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
else if ($method === 'PUT'){ 
    try {
        // Get Data from Body
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        $completed = $data['completed'];
        $stepId = intval($data['stepId']);
        
        $stmt = mysqli_prepare($db, "UPDATE Step SET completed = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $completed, $stepId);

        if (mysqli_stmt_execute($stmt)) {
            // Update successful
            http_response_code(200);
            echo 'Value Updated.';
        } else {
            // Update failed
            http_response_code(404);
            echo "Error: " . mysqli_error($db);
        }
        mysqli_stmt_close($stmt);

    } catch (\Throwable $th) {
        http_response_code(500);
        echo "error deleting data";
    }
}
?>