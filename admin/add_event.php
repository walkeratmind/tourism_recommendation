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

<button class="btn btn-lg btn-info  my-2 " data-toggle="modal" data-target="#formModal"><i
        class="fa fa-plus-square"></i> Add Event</button>

<?php
        // utils::message();
        ?>
<!-- Event Lists -->

<div class="box box-info">
    <div class="box-header with-border">

        <h3 class="box-title">Events</h3>

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
                        <th class="">Event Date</th>
                        <th class="">Description</th>
                        <th class="">Options</th>

                        <!-- <th class="">Popularity</th> -->
                    </tr>
                </thead>

                <tbody style="overflow-y: scroll; height=680px">
                    <?php

                            $mysqli = $database->connect();

                            $query = "SELECT * FROM `event` ";

                            $stmt = $mysqli->prepare($query);

                            echo "<script>console.log('hello')</script>";

                            if ($stmt->execute()) {

                                $stmt->bind_result($id, $name, $location,$date, $description, $image);

                                $stmt->store_result();
                                $img_path = "../imageUploads/";
                                if (!$stmt->num_rows > 0) {
                                    $output = "<div class='alert alert-info'>No Any Events</div>";
                                    echo $output;
                                } else {
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

                                        echo '<td>' . $date . '</td>';

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
    
                                            '<a class="option" href="../database/delete_event.php?id=' . $id . '" onclick="return confirm(\'Remove destination: ' . $name . ' ?\');">' .
                                            '<span><i class="fa fa-trash"></i>Remove</span>' . '</a>' .
    
                                            '</td>';
    
                                        // echo '<td id="option">'. 'Delete' .   '</td>';
    
                                        echo "</tr>";
                                    }
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
                <h3 class="modal-title text-center" id="addDestination">Add Event</h5>
            </div>
            <!-- form for adding destination -->

            <div class="modal-body">
                <form class="" action="../database/insert_event.php" method="POST" enctype='multipart/form-data'>

                    <div class="form-group">
                        <label for="Name">Event Name</label>
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

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="date">Event Date</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="date-input">
                                        <i class="fa fa-location-arrow"></i></span>
                                    <input type="date" class="form-control" id="date" name="date" value="01/01/2019"
                                         aria-describedby="date-input" required>
                                </div>
                            </div>
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


<style>
    .data-item {
        position: relative;
    }

    .content-layout {
        position: relative;
    }

    .option {
        position: relative;

        display: block;
        padding: 2px;
        /* margin-top: 4px; */
        font-size: 1.4rem;
        text-align: center;
        text-decoration: none;
        color: black;
        /* background: #000; */
        /* -webkit-transition: all 500ms ease-in-out;
        -moz-transition: all 500ms ease-in-out;
        -ms-transition: all 500ms ease-in-out;
        -o-transition: all 500ms ease-in-out;
        transition: all 500ms ease-in-out; */
        /* display: none; */
    }

    .option:hover {
        /* position: absolute; */
        border: none;
        padding: 2px;
        border-radius: 8px;
        background: #ccc;
        color: black;
        /* opacity: 0.9; */
        /* -webkit-transition: all 500ms ease-in-out;
        -moz-transition: all 500ms ease-in-out;
        -ms-transition: all 500ms ease-in-out;
        -o-transition: all 500ms ease-in-out; */
        transition: all 200ms ease-in-out;
    }

    /* tr .data-item:hover , tr td .option {
        display: block;
    } */

    .editor-container {
        height: 320px;
    }

    .editor-container img {
        /* display: block; */
        max-width: 100%;
        width: 32rem;
        height: 16rem;
    }
</style>
<!-- for editor -->
<script>
    // for content overlay for option menu
    $(document).ready(function () {


        // $.ajax({
        //     url: 'update_destination_modal.php',
        //     method: 'POST', 
        //     date:{ destination_id: destination_id },
        //     success: function(data) {
        //         $('#destination_detail').html(data);
        //         $('#updateFormModal').modal('show');
        //     }

        // })

    })

    let $optionMenu = $('.option');
    $optionMenu.hide();
    // $(this).next('.option').hide();

    $dataItem = $('.data-item');
    $dataItem.hover(function () {
    $optionMenu.show();

    // $(this).next('.option').fadeIn();
    }, function () {
    $optionMenu.hide();
    //    $(this).next('.option').fadeIn();

    });

    });


    // for Quill Editor
    var toolbarOptions = [
        [{
            'font': []
        }],
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],
        [{
            'header': 1
        }, {
            'header': 2
        }], // custom button values
        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
        ['blockquote', 'code-block', 'image', 'video'],
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],
        [{
            'script': 'sub'
        }, {
            'script': 'super'
        }], // superscript/subscript
        [{
            'indent': '-1'
        }, {
            'indent': '+1'
        }], // outdent/indent
        // [{ 'direction': 'rtl' }],                         // text direction

        //   [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown

        [{
            'color': []
        }, {
            'background': []
        }], // dropdown with defaults from theme
        [{
            'align': []
        }],

        ['clean'] // remove formatting button
    ];
    var quill = new Quill('#editor', {
        debug: 'info',
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: 'Magical Lines here...',
        theme: 'snow'
    });

    // If the user hits backspace at the beginning of list or blockquote,
    // remove the format instead delete any text
    quill.keyboard.addBinding({
        key: Keyboard.keys.BACKSPACE
    }, {
        collapsed: true,
        format: ['blockquote', 'list'],
        offset: 0
    }, function (range, context) {
        if (context.format.list) {
            this.quill.format('list', false);
        } else {
            this.quill.format('blockquote', false);
        }
    });

    // If the user hits enter on an empty list, remove the list instead
    quill.keyboard.addBinding({
        key: Keyboard.keys.ENTER
    }, {
        empty: true, // implies collapsed: true and offset: 0
        format: ['list']
    }, function (range, context) {
        this.quill.format('list', false);
    });

    var range = quill.getSelection();
    if (range) {
        if (range.length == 0) {
            console.log('User cursor is at index', range.index);
        } else {
            var text = quill.getText(range.index, range.length);
            console.log('User has highlighted: ', text);
        }
    } else {
        console.log('User cursor is not in editor');
    }

    quill.on('text-change', function () {

                var editorContent = quill.root.innerHTML;

                <?php $content = '<script>editorContent
</script>';
?>
console.log("editor" + editorContent);
document.getElementById('#htmlContent').innerHTML = editorContent;
})


// on form submission
var form = document.querySelector('form');
form.onsubmit = function() {
// Populate hidden form on submit
var description = document.querySelector('input[name=description]');
description.value = JSON.stringify(quill.getContents());

console.log("Submitted", $(form).serialize(), $(form).serializeArray());

// No back end to actually submit to!
alert('Open the console to see the submit data!')
return false;
};
</script>

<?php require_once dirname(__FILE__) . './admin_footer.php';