<?php
require_once('../../database/config.php');
require_once('../../database/connect.php');

$id=$_POST['id'];
$id_category = $_POST['id_category'];
$title = $_POST['title'];
$content = $_POST['content'];

// Kiểm tra người dùng bấm submit
if(isset($_POST['upload'])) {
	// Dung lượng cho phép upload lên
	$maxsize = 12000000; // 12MB

	// Lưu vào thư mục trên máy tính
	$linkfolder = ROOTPATH . "../../uploads/images/";
	$addfiles = $linkfolder . $_FILES["file"]["name"];
	$FileType = strtolower(pathinfo($addfiles,PATHINFO_EXTENSION));

	// Định dạng mở rộng
	$extensions_arr = array('png', 'jpg', 'jpeg', 'gif', 'tiff', 'bmp');
	if( in_array($FileType,$extensions_arr) ) {
		// Điều kiện kiểm tra dung lượng file
		if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
			echo "File quá lớn! Vui lòng upload file nhỏ hơn !";
		}
		// Tiếp hành Upload
		else {
			if(move_uploaded_file($_FILES['file']['tmp_name'],$addfiles)) {
				// Ghi dữ liệu vào Database
				$sql="UPDATE post SET id_category='".$id_category."', title='".$title."', content='".$content."', image='".$_FILES["file"]["name"]."' where id=".$id;
				$stmt=$con->prepare($sql);
				$stmt->execute();
				header('location:../user/user-page.php');
			}
			else {
				echo "Có lỗi xảy ra !";
			}
		}
	}
}
?>
