<?php
session_start();
include('dbconn.php');
include_once('TrainLineController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <style>
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc_disabled:after,
        table.dataTable thead .sorting_asc_disabled:before,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc_disabled:after,
        table.dataTable thead .sorting_desc_disabled:before {
            bottom: .5em;
        }
    </style>

</head>
<body>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <?php
                if (isset($_SESSION['message'])) {
                    $message_type = $_SESSION['message_type'];
                    echo '<div class="'. $message_type .'" role="alert">';
                    echo "<span>".$_SESSION['message']."</span>";
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                }
            ?>
            <div class="card">
                <div class="card-header">
                    <form action="action.php" method="POST" enctype="multipart/form-data">
                        <div class="row align-items-start">
                            <div class="col">
                                <h4 class="float-start">Train Lines</h4>
                            </div>
                            <div class="col">
                                <input type="file" name="file" class="form-control" id="customFile"/>
                            </div>
                            <div class="col">
                                <button type="submit" name="import_data" class="btn btn-primary">Import</button>
                            </div>
                            <div class="col">
                                <a href="add-train-line.php" class="btn btn-success float-end">Add New</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="trainLineTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Route</th>
                                    <th>Run Number</th>
                                    <th>Operator ID</th>
                                    <th>Created At</th>
                                    <th>Last Modified</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $students = new TrainLineController;
                            $result = $students->index();
                            if($result)
                            {
                                foreach($result as $row)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['route'] ?></td>
                                        <td><?= $row['run_number'] ?></td>
                                        <td><?= $row['operator_id'] ?></td>
                                        <td><?= $row['created_at'] ?></td>
                                        <td><?= $row['updated_at'] ?></td>
                                        <td>
                                            <a href="edit-train-line.php?id=<?=$row['id'];?>" class="btn btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <form action="action.php" method="POST">
                                                <button type="submit" name="delete_record" value="<?= $row['id'] ?>" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('#trainLineTable').DataTable({
        "pageLength": 5,
        "aaSorting": [3,'asc']
    });
</script>
</body>
</html>