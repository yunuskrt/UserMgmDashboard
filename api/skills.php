<?php include('../config.php'); ?>
<?php
// Check the HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST'){
    // Add skill
    try {
        // Get Data from Body
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        $title = $data['title'];
        $userId = intval($data['userId']);
        
        $sql_statement = "INSERT INTO Skill (title, userId) 
                VALUES ('$title', '$userId')";
        
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
        $skillId = intval($_GET['skillId']);
        if (mysqli_query($db, "DELETE FROM Skill WHERE id = $skillId")) {
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