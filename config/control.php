<?php
include 'conn.php';

function tampil($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    if (!$result) {
        return [];
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
$todo = tampil("SELECT * FROM todos");

function tambah ($post) {
    global $db;

    $title = $post['title'];
    $description = $post['description'];

    $query = "INSERT INTO todos VALUES(null, '$title', '$description')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
