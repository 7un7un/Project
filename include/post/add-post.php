<!DOCTYPE html>
<html>
    <head>
        <title>Add Post</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../../assets/style.css">
    </head>
    <body>
        <div class="post-container">
            <a href="../user/user-page.php"><button>Trang chủ</button></a>
            <h2>Tạo mới bài viết</h2>
            <p>Vui lòng điền thông tin bài viết mới vào các trường bên dưới.</p>
            <form action="run-addpost.php" method="post" enctype='multipart/form-data'>
                <input type="hidden" name="id_category" value="<?php echo $_GET['id_category']?>" required>
                <div class="post-input">
                    <label><b>TIÊU ĐỀ</b></label>
                    <input type="text" name="title" placeholder="Tiêu đề.." required>
                </div>
                <div class="post-input">
                    <label><b>NỘI DUNG</b></label>
                    <textarea type="text" rows="5" cols="100%" name="content" placeholder="Nội dung.." required></textarea>
                </div>
                <div class="post-input">
                    <label><b>ẢNH</b></label>
                    <hr>
                    <input type="file" name="file">
                </div>
                <div class="btn-postinput">
                    <button type="submit" name="upload">Thêm mới bài viết</button>
                </div>
            </form>
        </div>
    </body>
</html>
