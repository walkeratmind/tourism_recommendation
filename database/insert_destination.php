
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once dirname(__FILE__) . './../database/dbconnect.php';
    $database = new dbconnect();

    if (
        isset($_POST['submit']) &&
        isset($_POST['name'])
    ) {

        $image = $_FILES['image']['name'];    //image

        $target_dir = SITE_ROOT . "/../imageUploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg", "jpeg", "png", "gif", "JPG");

        // Check extension
        if (in_array($imageFileType, $extensions_arr)) {

            $mysqli = $database->connect();

            $sql_query = "INSERT INTO `destination`(`id`, `name`, `location`, `description`, `image`)
                VALUES (NULL, ?, ?, ? , ?);";

            $stmt = $mysqli->prepare($sql_query);

            $stmt->bind_param('ssss', $_POST['name'], $_POST['location'], $_POST['description'], $image);
            echo "<script> console.log(' image ')</script>";

            // Insert record
            if ($stmt->execute()) {
                // Upload file
                move_uploaded_file($_FILES['image']['tmp_name'], IMAGE_PATH . $image);

                echo "<script> console.log(' image uploaded')</script>";

                $_SESSION['message'] = "Destination Added";
                $_SESSION['msg_type'] = "success";
            } else {
                $_SESSION['message'] = "Failed to Add Destination";
                $_SESSION['msg_type'] = "danger";

                echo "error inserting : " . mysqli_error($con);
                echo "<script> console.log(' image uploaded failed')</script>";
            }
            $stmt->close();
            $mysqli->close();
        } else {
            $_SESSION['message'] = "Failed to Add Destination, Check your Image File Type";
            $_SESSION['msg_type'] = "danger";
        }
    }
}
header('location: ../admin/add_destination.php');

?>