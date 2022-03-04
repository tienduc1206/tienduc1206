<?php
require_once('config.php');

// Insert, update, delete
function execute($sql)
{
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn, "utf8mb4");

    mysqli_query($conn, $sql);

    mysqli_close($conn);
}

// Select -> tra ve ket qua
function executeResult($sql)
{
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn, "utf8mb4");
    $resultset = mysqli_query($conn, $sql);
    $list = [];
    while ($row = mysqli_fetch_array($resultset,1)) {
        $list[] = $row;
    }

    mysqli_close($conn);
    return $list;
}
