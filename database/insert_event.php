
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once dirname(__FILE__) . './../database/dbconnect.php';
    $database = new dbconnect();

    if (
        isset($_POST['submit']) &&
        isset($_POST['name']) 
        // &&
        // isset($_POST['location']) &&
        // isset($_POST['date']) &&
        // isset($_POST['description'])
    ) {

        $image = $_FILES['image']['name'];    //image

        $target_dir = SITE_ROOT . "/../imageUploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg", "jpeg", "png", "gif");

        // Check extension
        if (in_array($imageFileType, $extensions_arr)) {

            $mysqli = $database->connect();

            $name = $_POST['name'];
            $location = $_POST['location'];
            $description = $_POST['description'];

            // $rawdate = htmlentities($_POST['date']);
            // $date = date('Y-m-d', strtotime($rawdate));

            $date = new DateTime($_POST['date']);

            $date = $mysqli->real_escape_string($date->format('Y/m/d'));

            
            // $time = $_POST['time'];
            // $time = date('H:i:s',strtotime($time));    //converts time to HH:mm:ss

            // $sql_query = "INSERT INTO `event`(`id`, `eventName`, `location`,`date`, `description`, `image`)
            //     VALUES (NULL, ('$name), ('$location'),('$date'), ('$description') , ('$image'));";

            $sql_query = "INSERT INTO `event`(`id`, `eventName`, `location`,`date`, `description`, `image`)
            VALUES (NULL, ?,?, '$date', ?, ?);";

            $stmt = $mysqli->prepare($sql_query);

            $stmt->bind_param('ssss', $_POST['name'], $_POST['location'], $_POST['description'], $image);
            echo "<script> console.log(' image ')</script>";

            // Insert record
            if ($stmt->execute()) {
                // Upload file
                move_uploaded_file($_FILES['image']['tmp_name'], IMAGE_PATH . $image);

                echo "<script> console.log(' image uploaded')</script>";

                $_SESSION['message'] = "Event Added";
                $_SESSION['msg_type'] = "success";
            } else {
                $_SESSION['message'] = "Failed to Add Event";
                $_SESSION['msg_type'] = "danger";

                echo "error inserting : " . mysqli_error($con);
                echo "<script> console.log(' image uploaded failed')</script>";
            }
            $stmt->close();
            $mysqli->close();
        } else {
            $_SESSION['message'] = "Invalid Image Format";
            $_SESSION['msg_type'] = "danger";
            echo "error inserting : " . mysqli_error($con);
        }
    } else {
        $_SESSION['message'] = "Missing Params";
        $_SESSION['msg_type'] = "danger";
    }
}
header('location: ../admin/add_event.php');

?>