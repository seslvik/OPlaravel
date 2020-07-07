<?php
session_start();
if (($_SESSION['auth'] == true) AND ($_SESSION['admin'] == 1)){
    require_once ( '../db.connect.php');

    if (isset($_POST['id_no'])) { //проверяем, есть ли переменная
        //удаляем строку из таблицы
        $id = $_POST['id_no'];
        $sql = "UPDATE users SET admin = null WHERE id_user = :userID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userID', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}