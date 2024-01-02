<?php

class TrainLineController
{
    private $conn;

    private $db;

    public function __construct()
    {
        $this->db   = new DatabaseConnection;
        $this->conn = $this->db->conn;
    }

    public function index()
    {
        $tlQuery = "SELECT * FROM train_lines";
        $result = $this->conn->query($tlQuery);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function edit($id)
    {
        $train_line_id = mysqli_real_escape_string($this->conn, $id);
        $tlQuery = "SELECT * FROM train_lines WHERE id='$train_line_id' LIMIT 1";
        $result = $this->conn->query($tlQuery);
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function updateById($inputData, $id)
    {
        $train_line_id  = mysqli_real_escape_string($this->conn, $id);
        $name           = $inputData['name'];
        $route          = $inputData['route'];
        $run_number     = $inputData['run_number'];
        $operator_id    = $inputData['operator_id'];

        $tlQuery = "UPDATE train_lines SET 
                       name='$name', 
                       route='$route', 
                       run_number='$run_number', 
                       operator_id='$operator_id',
                       updated_at=NOW() 
                    WHERE id='$train_line_id' LIMIT 1";
        $result = $this->conn->query($tlQuery);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $train_line_id = mysqli_real_escape_string($this->conn,$id);
        $tlQuery = "DELETE FROM train_lines WHERE id='$train_line_id' LIMIT 1";
        $result = $this->conn->query($tlQuery);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateByRunNumber($inputData)
    {
        $name          = $inputData['name'];
        $route         = $inputData['route'];
        $run_number    = $inputData['run_number'];
        $operator_id   = $inputData['operator_id'];

        $result = mysqli_query($this->conn,
            "UPDATE train_lines SET 
                       name = '" . $name . "',
                       route = '" . $route . "', 
                       operator_id = '" . $operator_id . "',
                       updated_at = NOW() 
                       WHERE run_number = '" . $run_number . "'"
        );
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function addTrainLine($inputData)
    {
        $name        = $inputData['name'];
        $route       = $inputData['route'];
        $run_number  = $inputData['run_number'];
        $operator_id = $inputData['operator_id'];

        $result = mysqli_query($this->conn,
            "INSERT INTO train_lines (
                         name, 
                         route, 
                         run_number, 
                         operator_id, 
                         created_at, 
                         updated_at
                    ) VALUES (
                           '" . $name . "', 
                           '" . $route . "', 
                           '" . $run_number . "', 
                           '" . $operator_id . "', 
                           NOW(), 
                           NOW())"
                    );
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

?>
