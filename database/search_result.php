<?php
require_once dirname(__FILE__) . './dboperation.php';
require_once dirname(__FILE__) . './../inc/utils.php';

$db = new dboperation();
$mysqli = $db->getConn();

if (isset($_POST['query'])) {
    $search = $mysqli->real_escape_string($_POST["query"]);

    $sql_query = "SELECT * FROM `destination` 
            WHERE name LIKE '%" . $search . "%'
            OR location LIKE '%" . $search . "%'
            OR description LIKE '%" . $search . "%'
            OR image LIKE '%" . $search . "%'
        ";
} else {
    $sql_query = "SELECT * FROM destination ORDER BY destination.id";
}

$statement = $mysqli->prepare($sql_query);

if ($statement->execute()) {

    $statement->bind_result($id, $name, $location, $description, $image);
    $statement->store_result();

    $img_path = "./imageUploads/";

    echo '<div class="row">';

    if ($statement->num_rows > 0) {

        while ($statement->fetch()) {
            echo '<div class="item col-md-4 mb-2 ">';

            echo '<a href="get_destination.php?id=' . $id . '">';

            echo '<div class="card shadow-sm " id="" style="width: 24rem;">';
            echo '<div class="content-layout">';
            echo '<img src=\'', $img_path . $image, '\' style="width: 24rem; height: 18rem"  class="rounded card-img-top" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"  alt="' . $image . '">';
            echo '<span class="content-detail">' . $description . '</span>';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $name . '</h5>';
            // echo '<p>'. $description . '</p>';

            echo '</div>';    //end of card body
            echo '<card-footer class=" mx-2" >';
            echo '<div class=" text-muted" >' . $location . '</div>';
            echo '</card-footer>';
            echo '</div>';

            echo '</a>';
            echo '</div>';
        }
        echo '</div>';

        $statement->close();
        $mysqli->close();
    } else {
        $_SESSION['message'] = "No Results...";
        utils::message();
    }
}

?>


<style>
    .card {

        /* transition: all 0.3s; */
    }

    .item {
        overflow: hidden;
    }

    .item a {
        text-decoration: none;
        color: #000;
    }

    .item:hover {
        box-shadow: 12px 15px 20px 0px rgba(46, 61, 73, 0.4);
        border-radius: 4px;
        transition: all 0.3s ease;
        top: -2px;
    }

    .content-layout {
        position: relative;
    }

    .content-detail {
        position: absolute;
        overflow: hidden;
        background: #000;
        opacity: 0.8;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        bottom: 0;
        width: 100%;
        height: 18%;
        text-align: center;
        color: #fff;
        /* -webkit-transition: all 500ms ease-in-out;
    -moz-transition: all 500ms ease-in-out;
    -ms-transition: all 500ms ease-in-out;
    -o-transition: all 500ms ease-in-out;
    transition: all 500ms ease-in-out; */
        /* display: none; */
    }
</style>

<script>
    $(document).ready(function() {

        let $contentDetail = $('.content-detail');
        // $contentDetail.hide();

        $('.card').hover(function() {
            $contentDetail.show(500);
        }, function() {
            $contentDetail.hide();
        })

    });
</script>