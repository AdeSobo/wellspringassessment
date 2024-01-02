<?php
session_start();
include('dbconn.php');
include_once('TrainLineController.php');

$db = new DatabaseConnection;

if (isset($_POST['update_record']))
{
    $id = mysqli_real_escape_string($db->conn, $_POST['student_id']);
    $input_data = [
        'name'        => mysqli_real_escape_string($db->conn,$_POST['name']),
        'route'       => mysqli_real_escape_string($db->conn,$_POST['route']),
        'run_number'  => mysqli_real_escape_string($db->conn,$_POST['run_number']),
        'operator_id' => mysqli_real_escape_string($db->conn,$_POST['operator_id']),
    ];
    $train_line = new TrainLineController;
    $result = $train_line->updateById($input_data, $id);

    if ($result) {
        $_SESSION['message']      = "Record updated successfully";
        $_SESSION['message_type'] = "alert alert-success alert-dismissible fade show";
    } else {
        $_SESSION['message']      = "Unable to update record";
        $_SESSION['message_type'] = "alert alert-danger alert-dismissible fade show";
    }
    header("Location: index.php");
    exit(0);
}

if (isset($_POST['save_record']))
{
    $inputData = [
        'name'        => mysqli_real_escape_string($db->conn,$_POST['name']),
        'route'       => mysqli_real_escape_string($db->conn,$_POST['route']),
        'run_number'  => mysqli_real_escape_string($db->conn,$_POST['run_number']),
        'operator_id' => mysqli_real_escape_string($db->conn,$_POST['operator_id']),
    ];

    $train_line = new TrainLineController;
    $result = $train_line->addTrainLine($inputData);

    if ($result) {
        $_SESSION['message'] = "Record Added Successfully";
        $_SESSION['message_type'] = "alert alert-success alert-dismissible fade show";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Record Not Inserted";
        $_SESSION['message_type'] = "alert alert-danger alert-dismissible fade show";
        header("Location: add-train-line.php");
        exit(0);
    }
}

if (isset($_POST['delete_record']))
{
    $id = mysqli_real_escape_string($db->conn, $_POST['delete_record']);
    $train_line = new TrainLineController;
    $result = $train_line->delete($id);
    if ($result) {
        $_SESSION['message'] = "Record deleted successfully";
        $_SESSION['message_type'] = "alert alert-success alert-dismissible fade show";
    } else {
        $_SESSION['message'] = "Unable to delete record";
        $_SESSION['message_type'] = "alert alert-danger alert-dismissible fade show";
    }
    header("Location: index.php");
    exit(0);
}

if (isset($_POST['import_data']))
{
    $file_mines = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );

    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mines))
    {
        $train_line = new TrainLineController;
        $csv_file = fopen($_FILES['file']['tmp_name'], 'r');
        fgetcsv($csv_file);

        $result = null;

        while (($get_data = fgetcsv($csv_file)) !== FALSE)
        {
            $run_number = mysqli_real_escape_string($db->conn,$get_data[2]);
            $input_data = [
                'name' => mysqli_real_escape_string($db->conn,$get_data[0]),
                'route' => mysqli_real_escape_string($db->conn,$get_data[1]),
                'run_number' => mysqli_real_escape_string($db->conn,$get_data[2]),
                'operator_id' => mysqli_real_escape_string($db->conn,$get_data[3]),
            ];

            $query = "SELECT * FROM train_lines WHERE run_number = '" . $run_number . "'";
            $check = mysqli_query($db->conn, $query);
            if ($check->num_rows > 0) {
                $result = $train_line->updateByRunNumber($input_data);
            } else {
                $result = $train_line->addTrainLine($input_data);
            }
        }

        fclose($csv_file);

        if ($result) {
            $_SESSION['message']      = "File Processed Successfully";
            $_SESSION['message_type'] = "alert alert-success alert-dismissible fade show";
        } else {
            $_SESSION['message']      = "File Not Processed Added";
            $_SESSION['message_type'] = "alert alert-danger alert-dismissible fade show";
        }
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['message']      = "Please select a valid file (only csv or xlxs allowed)";
        $_SESSION['message_type'] = "alert alert-danger alert-dismissible fade show";
        header("Location: index.php");
        exit(0);
    }
}

?>