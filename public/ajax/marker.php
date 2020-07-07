<?php
session_start();
if ($_SESSION['auth'] !== true){
    header('Location: login.php');
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/db.connect.php');

$sub = array();
if ($_POST['pokaz_op'] == "1") {
    $icon_map_op = '{ iconUrl: "img/marker-icon.png",
                                            iconRetinaUrl:"img/marker-icon-2x.png",
                                            shadowUrl:"img/marker-shadow.png",
                                            iconSize:[25,41],
                                            iconAnchor:[12,41],
                                            popupAnchor:[1,-34],
                                            tooltipAnchor:[16,-28],
                                            shadowSize:[41,41]}';
    $stmt = $db->prepare('SELECT * FROM data_krt WHERE zavod = ? AND vid_objekta = ?');
    $stmt->execute(array($_POST['zavod_objekt'], 'op'));
    foreach ($stmt->fetchAll() as $row) {
        $objekt = $row['objekt'];
        $pos_x = $row['pos_x'];
        $pos_y = $row['pos_y'];
        $file = $row['file'];
        $sub[] = "{x: \"$pos_x\", y:\"$pos_y\", note: '<center><b>$objekt</b><br/></center><a href=\"$file\">Оперативный план</a>', iconog:$icon_map_op}";
    }
}
if ($_POST['pokaz_pg'] == "1") {
    $icon_map_pg = '{ iconUrl: "img/marker-icon_pg.png",
                                            iconRetinaUrl:"img/marker-icon_pg-2x.png",
                                            shadowUrl:"img/marker-shadow.png",
                                            iconSize:[25,41],
                                            iconAnchor:[12,20],
                                            popupAnchor:[1,-34],
                                            tooltipAnchor:[16,-28],
                                            shadowSize:[41,41]}';
    $stmt = $db->prepare('SELECT * FROM data_krt WHERE zavod = ? AND vid_objekta = ?');
    $stmt->execute(array($_POST['zavod_objekt'], 'pg'));
    foreach ($stmt->fetchAll() as $row) {
        $objekt = $row['objekt'];
        $pos_x = $row['pos_x'];
        $pos_y = $row['pos_y'];
        $file = $row['file'];
        $sub[] = "{x: \"$pos_x\", y:\"$pos_y\", note: '<center><b>$objekt</b><br/></center><a href=\"$file\">Пожарный гидрант</a>', iconog:$icon_map_pg}";
    }
}

$datamap_vse = implode(',', array_filter($sub));
echo json_encode($sub);