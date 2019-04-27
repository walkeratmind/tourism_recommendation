<?php
require_once dirname(__FILE__) . './../database/dbconnect.php';
require_once dirname(__FILE__) . './../database/dboperation.php';
require_once '../inc/utils.php';
require_once '../inc/editor_lib.php';

$database = new dbconnect();

require_once dirname(__FILE__) . './admin_header.php';

utils::toastMessage();

require_once dirname(__FILE__) . './show_top_details.php';


// We already get the feedbacks values in admin_nav page
// IN variable $feedbacks
?>

<!-- Destination Lists -->
<div class="box box-info">
    <div class="box-header with-border">

        <h3 class="box-title">Feedbacks</h3>

    </div>

    <!-- /.box-header -->
    <div class="box-body">

        <?php 
                foreach ($feedbacks as $feedback) {

                    //get username of the user who have sent feedback
                    $result = $db->getSingleData('user', $feedback['user_id']);
                    $user = json_decode($result, true);
                    // Start Message
                      echo '<a href="#" style="text-decoration: none">';
                      // echo '<div class="pull-left">'. 
                      //   '<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">';
                      // echo '</div>';

                      echo '<h4>';
                        echo 'From: '. $user['email'];
                        echo '<small class="pull-right"><i class="fa fa-clock-o"></i>' . $feedback['datetime'] . '</small>';
                      echo '</h4>.';

                      echo '<p>'. utils::getDefinateString($feedback['feedback'], 50).'</p>';

                      echo '</a>';
                    // END Feedback Message


                  }

                ?>

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
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                aria-describedby="name-input" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Location">Location</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="location-input">
                                <i class="fa fa-location-arrow"></i></span>
                            <input type="text" class="form-control" id="location" name="location" placeholder="Location"
                                aria-describedby="location-input" required>
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

<?php require_once dirname(__FILE__) . './admin_footer.php';