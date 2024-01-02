<?php
include('dbconn.php');
include_once('TrainLineController.php');
$db = new DatabaseConnection;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-start">Edit Train Line</h4>
                    <a href="index.php" class="btn btn-success float-end"><< View</a>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_GET['id']))
                    {
                        $train_line_id = mysqli_real_escape_string($db->conn, $_GET['id']);
                        $train_line = new TrainLineController;
                        $result = $train_line->edit($train_line_id);

                        if ($result)
                        {
                            ?>
                            <form action="action.php" method="POST">
                                <input type="hidden" name="student_id" value="<?=$result['id']?>">

                                <div class="mb-3">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="<?=$result['name']?>" required class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Route</label>
                                    <input type="text" name="route" value="<?=$result['route']?>" required class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Run Number</label>
                                    <input type="text" name="run_number" value="<?=$result['run_number']?>" required class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label for="">Operator ID</label>
                                    <input type="text" name="operator_id" value="<?=$result['operator_id']?>" required class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_record" class="btn btn-primary">Update Record</button>
                                </div>
                            </form>

                            <?php
                        } else {
                            echo "<h4>No Record Found</h4>";
                        }
                    }
                    else {
                        echo "<h4>Something Went Wrong</h4>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>