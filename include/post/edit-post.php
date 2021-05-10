<?php require_once('../../database/connect.php')?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sửa bài viết</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../../assets/style.css">
    </head>
    <body>
        <?php
            $id = $_GET['id'];
            $stmt = $con->prepare("SELECT * FROM post WHERE id = '".$id."'");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
            ?>
        <div class="post-container">
            <a href="../user/user-page.php"><button>Trang chủ</button></a>
            <h2>Sửa bài viết</h2>
            <p>Vui lòng chỉnh sửa bài viết vào các trường bên dưới.</p>
            <form action="run-editpost.php" method="post" enctype='multipart/form-data'>
                <input type="hidden" name="id_category" value="<?php echo $result['id_category'];?>" required>
                <input type="hidden" name="id" value="<?php echo $result['id'];?>" required>
                <div class="post-input">
                    <label><b>TIÊU ĐỀ</b></label>
                    <input type="text" name="title" value="<?php echo $result['title'];?>" required>
                </div>
                <div class="post-input">
                    <label><b>NỘI DUNG</b></label>
                    <input type="text" name="content" value="<?php echo $result['content'];?>" required>
                </div>
                <div class="post-input">
                    <label><b>ẢNH</b></label>
                    <input type="file" name="file" value="<?php echo $result['images'];?>" required>
                </div>
                <div class="btn-postinput">
                    <button type="submit" name="upload">Cập nhật</button>
                </div>
            </form>
        </div>
    </body>
</html>
