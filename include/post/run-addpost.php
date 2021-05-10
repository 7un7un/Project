<?php
require_once('../../database/config.php');
require_once('../../database/connect.php');

$id_category = $_POST['id_category'];
$title       = $_POST['title'];
$content     = $_POST['content'];

if (isset($_POST['upload'])) {
    $maxsize = 12000000; // 12MB
    
    $linkfolder = ROOTPATH . "../../uploads/images/";
    $addfiles   = $linkfolder . $_FILES["file"]["name"];
    $FileType   = strtolower(pathinfo($addfiles, PATHINFO_EXTENSION));
    
    $extensions_arr = array(
        'png',
        'jpg',
        'jpeg',
        'gif',
        'tiff',
        'bmp'
    );
    if (in_array($FileType, $extensions_arr)) {
        if (($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
            echo "File quá lớn! Vui lòng upload file nhỏ hơn!";
        } else {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $addfiles)) {
                $sql  = "INSERT INTO `post` (id_category, title, image, content) VALUES (" . $id_category . "  ,'" . $title . "' ,'" . $_FILES["file"]["name"] . "' ,'" . $content . "')";
                $stmt = $con->prepare($sql);
                $stmt->execute();
                header("location:../user/user-page.php");
            } else {
                echo "Đã có lỗi xảy ra!";
            }
        }
    }
}
?>
