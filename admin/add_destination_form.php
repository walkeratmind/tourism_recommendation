<?php
require_once dirname(__FILE__) . './../database/dbconnect.php';
require_once dirname(__FILE__) . './../database/dboperation.php';
require_once '../inc/utils.php';
require_once '../inc/editor_lib.php';

$database = new dbconnect();

require_once dirname(__FILE__) . './admin_header.php';

utils::toastMessage();


?>


<div class="content-wrapper">
    <div class="box box-info">
        <div class="box-header with-border">

            <h3 class="box-title">Update</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="box-body">
            <?php

            $db = new dboperation();
            // destiantion id is assigned in javascript in bottom script part

            $destination_id = $_GET['id'] ?? '';
            // $destination_id = 'id';
            $result = $db->getSingleData('destination', $destination_id);

            $destination =  json_decode($result, true);

            ?>

            <form class="" action="../database/update_destination.php" method="POST" enctype='multipart/form-data'>

                <input type="hidden" name="id" value="<?php echo $destination_id; ?>">

                <!-- UNCOMMENT this if you want to make id visible but readonly
             in input field but comment above line FIRST -->

                <!-- <div class="form-group">
                    <label for="id">Id</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="name-input">*</span>
                        <input type="number" class="form-control" readonly name="id" value="<?php echo $destination_id; ?>">
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="Name">Name</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="name-input">#</span>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $destination['name']; ?>" placeholder="Name" aria-describedby="name-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Location">Location</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="location-input">
                            <i class="fa fa-location-arrow"></i></span>
                        <input type="text" class="form-control" id="location" name="location" value="<?php echo $destination['location']; ?>" placeholder="Location" aria-describedby="location-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea rows="10" class="form-control" style="resize:none;" name="description" id="description"><?php echo $destination['description']; ?></textarea>
                    <!-- <div id="editor" class="editor-container">
                    </div> -->


                </div>

                <div class="form-group">
                    <label for="imageFile">Select Image</label>
                    <!-- MAX_FILE_SIZE must precede the file input field -->
                    <input type="file" name="image" id="imageFile" value="<?php echo $destination['image']; ?>" required />
                </div>
                <div class="modal-footer mx-auto" style="text-align:center;">
                    <a href="./add_destination.php">
                        <button type="button" class="btn btn-secondary">Close</button>
                    </a>
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                </div>
            </form>


        </div>
    </div>
</div>
<!-- Update Destination Form Modal -->
<style>
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
    $(document).ready(function() {


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
    }, function(range, context) {
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
    }, function(range, context) {
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

    quill.on('text-change', function() {

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
