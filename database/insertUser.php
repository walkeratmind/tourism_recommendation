<?php

    require_once dirname(__FILE__) . '/dbconnect.php';

    $errors         = array();  	// array to hold validation errors
    $data 			= array(); 		// array to pass back data
    // validate the variables ======================================================
        // if any of these variables don't exist, add an error to our $errors array
        if (empty($_POST['firstName']))
            $errors['firstName'] = 'First name is required.';
        if (empty($_POST['lastName']))
            $errors['lastName'] = 'Last name is required.';
        if (empty($_POST['username']))
            $errors['username'] = 'user name is required.';
        if (empty($_POST['email']))
            $errors['email'] = 'Email is required.';
        if (empty($_POST['password']))
            $errors['password'] = 'Password is required.';
        if (empty($_POST['gender']))
            $errors['gender'] = 'Gender is required.';
    // return a response
        // if there are any errors in our errors array, return a success boolean of false

        if ( ! empty($errors)) {
            // if there are items in our errors array, return those errors
            $data['success'] = false;
            $data['errors']  = $errors;
        } else {
            // if there are no errors process our form, then return a message
            // DO ALL YOUR FORM PROCESSING HERE
            // THIS CAN BE WHATEVER YOU WANT TO DO (LOGIN, SAVE, UPDATE, WHATEVER)
            // show a message of success and provide a true success variable

            // inserting into database

            $database = new dbconnect();
            $mysqli = $database->connect();

            $query = "INSERT  INTO `admin`(`id`, `firstName`, `lastName`, `username`, `email`, `password`, `gender`)
                VALUES (NULL, ?, ? , ? , ? , ? , ?) ;";

            $stmt = $mysqli -> prepare($query);
            $stmt -> bind_param('ssssss',$_POST['firstName'], $_POST['lastName'], $_POST['username'], 
                $_POST['email'], $_POST['password'], $_POST['gender']);

            if ($stmt -> execute()) {
                $data['success'] = true;
                $data['message'] = "Registeration Successful";
            } else {
                $data['success'] = false;
                $errors['server'] = $stmt->error;
                $data['errors']  = $errors;
            }

            // $stmt->close();
        }
        // return all our data to an AJAX call
        echo json_encode($data);