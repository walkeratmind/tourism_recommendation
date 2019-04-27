<?php
require_once dirname(__FILE__) . './../database/dbconnect.php';
require_once dirname(__FILE__) . './../database/dboperation.php';
require_once '../inc/utils.php';
require_once '../inc/editor_lib.php';

$database = new dbconnect();

require_once dirname(__FILE__) . './admin_header.php';

utils::toastMessage();

require_once dirname(__FILE__) . './show_top_details.php';
?>
        <button class="btn btn-lg btn-info  my-2 " data-toggle="modal" data-target="#formModal"><i class="fa fa-plus-square"></i> Add Destination</button>

        <?php
        // utils::message();
        ?>
        <!-- Destination Lists -->
        <div class="box box-info">
            <div class="box-header with-border">

                <h3 class="box-title">Destinations</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">

                <!-- <a tabindex="0" class="btn btn-lg btn-danger" role="button" data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="And here's some amazing content. It's very engaging. Right?">Dismissible popover</a> -->
                <div class="table-responsive">

                    <!-- destinations table -->
                    <table class="table no-margin table-hover table-fixed">
                        <thead>
                            <tr>
                                <th class="">Serial No.</th>
                                <th class="">ID</th>
                                <th class="">Image</th>
                                <th class="">Place</th>
                                <th class="">Location</th>
                                <th class="">Description</th>
                                <th class="">Options</th>

                                <!-- <th class="">Popularity</th> -->
                            </tr>
                        </thead>

                        <tbody style="overflow-y: scroll; height=680px">
                            <?php

                            $mysqli = $database->connect();

                            $query = "SELECT * FROM `destination` ";

                            $stmt = $mysqli->prepare($query);

                            echo "<script>console.log('hello')</script>";

                            if ($stmt->execute()) {

                                $stmt->bind_result($id, $name, $location, $description, $image);

                                $img_path = "../imageUploads/";

                                $i = 1;
                                while ($stmt->fetch()) {
                                    echo "<script>console.log('loop')" . $description . "</script>";
                                    echo "<tr class='data-item'>";
                                    echo '<td>' . $i++ . '</td>';
                                    echo '<td>' . $id . '</td>';
                                    echo '<td>
                                                    <div class="img" style="max-width:100%">
                                                        <img src=\'', $img_path . $image, '\'style="width: 38rem;"
                                                            class="card-img-top img-fluid img-thumbnail" alt=' . $image . '>
                                                    </div>
                                                </td>';
                                    echo '<td>
                                                    <h3 class="">' . $name . '</h3>
                                                </td>';
                                    echo '<td>' . $location . '</td>';

                                    // echo '<td>' . $description . '</td>';

                                    echo '<td>
                                            <p id="wrapper">'. utils::getDefinateString($description) . 
                                            '</p>
                                        </td>';

                                    echo '<td>' . '' .
                                        '<a class="option" href="">
                                            <span><i class="fa fa-list"></i>View</span>
                                        </a>' .

                                        '<a class="option" href="./add_destination_form.php?id=' . $id . '">
                                            <span class="update_btn" ><i class="fa fa-edit"></i>Update</span>
                                        </a>' .

                                        '<a class="option" href="../database/delete_destination.php?id=' . $id . '" onclick="return confirm(\'Remove destination: ' . $name . ' ?\');">' .
                                        '<span><i class="fa fa-trash"></i>Remove</span>' . '</a>' .

                                        '</td>';

                                    // echo '<td id="option">'. 'Delete' .   '</td>';

                                    echo "</tr>";
                                }
                            }
                            $stmt->close();
                            $mysqli->close();
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">

                <!-- <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All
                            Orders</a> -->
            </div>
            <!-- /.box-footer -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Add Destination Form Modal -->
<div class="modal" id="formModal" tabindex="-1" role="dialog" aria-labelledby="addDestination" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title text-center" id="addDestination">Add Destination</h5>
            </div>
            <!-- form for adding destination -->

            <div class="modal-body">
                <form class="" action="../database/insert_destination.php" method="POST" enctype='multipart/form-data'>

                    <div class="form-group">
                        <label for="Name">Name</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="name-input">#</span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="name-input" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Location">Location</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="location-input">
                                <i class="fa fa-location-arrow"></i></span>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Location" aria-describedby="location-input" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name='description' id="description">

                        <!-- <div id="editor" class="editor-container">
                        </div> -->


                    </div>

                    <div class="form-group">
                        <label for="imageFile">Select Image</label>
                        <!-- MAX_FILE_SIZE must precede the file input field -->
                        <input type="file" name="image" id="imageFile" />
                    </div>
                    <div class="modal-footer mx-auto" style="text-align:center;">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>

                <div id="htmlContent"></div>
            </div>
        </div>
    </div>
</div>

<!-- for editor -->

<?php require_once dirname(__FILE__) . './admin_footer.php';
