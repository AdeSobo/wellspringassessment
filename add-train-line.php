<?php session_start(); ?>
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
                    <h4 class="float-start">Add New</h4>
                    <a href="index.php" class="btn btn-success float-end">View Train Lines</a>
                </div>
                <div class="card-body">

                    <form action="action.php" method="POST">
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" required class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Route</label>
                            <input type="text" name="route" required class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Run Number</label>
                            <input type="text" name="run_number" required class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Operator ID</label>
                            <input type="text" name="operator_id" required class="form-control" />
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="save_record" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>