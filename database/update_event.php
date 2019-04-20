
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once dirname(__FILE__) . './../database/dbconnect.php';

    $database = new dbconnect();

    if (
        isset($_POST['submit']) &&
        isset($_POST['eventName'])
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

            $date = new DateTime($_POST['date']);

            $date = $mysqli->real_escape_string($date->format('Y/m/d'));

            // $sql_query = "UPDATE `event` SET name = ?, location= ?,date='$date' description=?,
            // image= ? WHERE id= ?";

            // $stmt = $mysqli->prepare($sql_query);

            $sql_query = "UPDATE `event` SET `eventName` =?, `location`=?,`date`= '$date', `description`=?, `image`=?
            WHERE id=?";

            $stmt = $mysqli->prepare($sql_query);

            $stmt->bind_param('ssssi', $_POST['eventName'], $_POST['location'], $_POST['description'], $image, $_POST['id']);

            // $stmt->bind_param(
            //     'ssssi',
            //     $_POST['eventName'],
            //     $_POST['location'],
            //     $_POST['description'],
            //     $image,
            //     $_POST['id']
            // );
            echo "<script> console.log(' image ')</script>";

            // Insert record
            if ($stmt->execute()) {
                // Upload file
                move_uploaded_file($_FILES['image']['tmp_name'], IMAGE_PATH . $image);

                echo "<script> console.log(' image uploaded')</script>";

                $_SESSION['message'] = "Event Updated";
                $_SESSION['msg_type'] = "success";
            } else {
                $_SESSION['message'] = "Failed to Update Event";
                $_SESSION['msg_type'] = "danger";

                echo "error inserting : " . mysqli_error($con);
                echo "<script> console.log(' image uploaded failed')</script>";
            }
            $stmt->close();
            $mysqli->close();
        }
    }
}
header('location: ../admin/add_event.php');

?>