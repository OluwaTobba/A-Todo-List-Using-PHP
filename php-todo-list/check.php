<?php
if (isset($_POST['id'])) {
    require 'db_connect.php';

    $id = $_POST['id'];

    if (empty($id)) {
        echo 'error';
    } else {
        try {
            $stmt = $conn->prepare("SELECT id, checked FROM todos WHERE id = ?");
            $stmt->execute([$id]);
            $todo = $stmt->fetch();
            
            if ($todo) {
                $checked = $todo['checked'];
                $uChecked = $checked ? 0 : 1;

                $stmt = $conn->prepare("UPDATE todos SET checked = ? WHERE id = ?");
                $res = $stmt->execute([$uChecked, $id]);

                if ($res) {
                    echo $checked;
                } else {
                    echo "error";
                }
            } else {
                echo "error";
            }
        } catch (PDOException $e) {
            echo "error";
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: index.php?mess=error");
}
