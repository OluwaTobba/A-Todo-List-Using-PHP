<?php
if (isset($_POST['id'])) {
    require 'db_connect.php';

    $id = $_POST['id'];

    if (empty($id)) {
        echo 0;
    } else {
        try {
            $stmt = $conn->prepare("DELETE FROM todos WHERE id = ?");
            $res = $stmt->execute([$id]);

            if ($res) {
                echo 1;
            } else {
                echo 0;
            }
        } catch (PDOException $e) {
            echo 0;
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: index.php?mess=error");
}