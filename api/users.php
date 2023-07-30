<?php include('../config.php'); ?>
<?php

// Check the HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Get All Users, Get User
    try {
        if (empty($_GET)){
            // GET all users
            $sql_statement = "SELECT * FROM User";
            $result = mysqli_query($db, $sql_statement);
            $users = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            } 
            header('Content-Type: application/json');
            echo json_encode($users);
        }else{
            // GET user
            $userId = intval($_GET['userId']);
            $resultUser = mysqli_query($db, "SELECT * FROM User WHERE id = $userId");
            
            $rowUser = mysqli_fetch_assoc($resultUser);
            $departUser=$rowUser['department'];
            $sql_count_statement = "SELECT COUNT(*) FROM Project WHERE department=?";
        
        // SQL statement preparation
        $stmt = mysqli_prepare($db, $sql_count_statement);

        if (!$stmt) {
            echo "Error: " . mysqli_error($db);
            exit;
        }
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "s", $departUser); 
        if (mysqli_stmt_execute($stmt)) {
                    
            mysqli_stmt_bind_result($stmt, $projectCount);

            // Fetch the result
            mysqli_stmt_fetch($stmt);

            // Close statement
            mysqli_stmt_close($stmt);

            // You can use the $projectCount variable as needed
            $rowUser['projects_of_depart'] = $projectCount;
          
        }
            
            $resultSkill = mysqli_query($db, "SELECT id,title FROM Skill WHERE userId=$userId");
            $resultProject = mysqli_query($db,"SELECT id,title,statu,description,startDate,endDate FROM Project INNER JOIN (SELECT projectId FROM UserInProject WHERE userId = $userId) x ON Project.id = x.projectId");
        

            $skills = array();
            $projects = array();
            if ($resultUser && $resultSkill && $resultProject) {  
                // Selection successful
                
                while ($rowSkill = mysqli_fetch_assoc($resultSkill)){
                    $skills[] = $rowSkill;
                }
                $rowUser['skills'] = $skills;

                while ($rowProject = mysqli_fetch_assoc($resultProject)){
                    $projects[] = $rowProject;
                }
                
                $rowUser['projects'] = $projects;
                $rowUser['projects_involved'] = count($projects);
                

                http_response_code(200);
                header('Content-Type: application/json');
                echo json_encode($rowUser);
            } else {
                // Selection failed
                http_response_code(404);
                echo "Error: " . mysqli_error($db);
            }
            
        }
        
        
    } catch (\Throwable $th) {
        http_response_code(500);
        echo "error selecting data";
    }
   
}

else if ($method === 'POST'){
    // Insert User
    try {
        // Get Data from Body
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        $name = $data['name'];
        $username = $data['username'];
        $gender = $data['gender'];
        $age = intval($data['age']);
        $email = $data['email'];
        $parole = $data['parole'];
        $role = $data['role'];
        $department = $data['department'];
        $picture = $data['picture'];
        $enteredDate = $data['enteredDate'];   


        $sql_statement = "INSERT INTO User (role, department, enteredDate, age, username, email, gender, picture, name, parole) 
                VALUES ('$role', '$department', '$enteredDate', $age, '$username', '$email', '$gender', '$picture', '$name', '$parole')";
        

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
else if ($method === 'PUT'){
    // Update User
    try {
        // Get Data from Body
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);

        $userId = intval($data['id']);
        $username = $data['username'];
        $email = $data['email'];
        $role = $data['role'];
        $picture = $data['picture'];

        $sql_statement = "UPDATE User 
        SET username=?, email=?, role=?, picture=?
        WHERE id=?";
        
        // SQL statement preparation
        $stmt = mysqli_prepare($db, $sql_statement);

        if (!$stmt) {
            echo "Error: " . mysqli_error($db);
            exit;
        }
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ssssi", $username, $email, $role, $picture, $userId);

        
        if (mysqli_stmt_execute($stmt)) {
            // Update successful
            http_response_code(200);
            echo "User updated successfully.";
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
    // Delete User
    try {
        // Get Data from Body
        $jsonData = file_get_contents("php://input");
        $data = json_decode($jsonData, true);
        $userId = intval($data['id']);
        if (mysqli_query($db, "DELETE FROM User WHERE id = $userId")) {
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
