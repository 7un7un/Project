<?php session_start();?>
<?php require_once('../../database/connect.php')?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../assets/style.css">
        <title>Detail</title>
    </head>
    <body>
        <div class="topnav">
            <a class="active" href="#home">
            <img src="../../assets/images/logo.png" alt="logo-unicorn-queen">
            <a style='font-size: 30px; color: #33bef5'>NEWS</a>
            </a>
            <div class="search-container">
                <form action="database/search.php" method="get">
                    <input type="text" placeholder="Tìm kiếm.." name="search">
                    <input class='btn-search' type="submit" name="ok" value="Tìm kiếm" />
                </form>
            </div>
        </div>
        <div class="menu">
            <?php if($_SESSION["power"]!='1' && $_SESSION["power"]!='2') { ?>
            <a href="../../index.php"><button>Trang chủ</button></a>
            <?php } ?>
            <?php if(isset($_SESSION["power"])) { ?>
            <a href="../user/user-page.php"><button>Trang chủ</button></a>
            <a>
            <?php if(isset($_SESSION["username"]))
                echo "<button>".$_SESSION["username"]."</button>";
                ?>
            </a>
            <?php } ?>
            <?php $id_category=$_GET['id_category']; if($_SESSION["power"]=='1') {
                echo "<a href='../post/add-post.php?id_category=$id_category'>
                <button>Thêm bài viết</button></a>";
                } ?>
        </div>
        <div class="content">
            <div id="id01" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <h3>Đăng nhập</h3>
                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                        <form action="include/user/run-login.php" method='post'>
                            <label>Tên tài khoản</label>
                            <input type="text" name='username' placeholder="Tên tài khoản" required>
                            <label>Mật khẩu</label>
                            <input type="password" name='password' placeholder="Mật khẩu" required>
                            <button type="submit">Đăng nhập</button><br/><br/>
                            <a href="include/user/register.php">Chưa có tài khoản ? <b>Đăng ký.</b></a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="content-left">
                <?php
                    $id_category=$_GET['id_category'];
                    $stmt=$con->prepare("SELECT * FROM post WHERE id_category=$id_category limit 7");
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result=$stmt->fetchALL();
                    foreach($result as $row){
                        $id=$row['id'];
                        $image=$row['image'];
                        $quoteimg='../../uploads/images/'.$image;
                        $title=$row['title'];
                        $content=$row['content'];
                        if ($_SESSION["power"]=='1') {
                            echo <<<EOT
                            <div class="item-content-left">
                                <div>
                                    <button><a href='edit-post.php?id=$id'>Sửa bài viết</a></button>
                                    <button><a href='deletepost.php?id=$id' onclick="return confirm('Bạn có chắc muốn xoá bài viết này?');">Xoá bài viết</a></button>
                                </div>
                                <img src='$quoteimg' alt='$title'>
                                <b>$title</b><br/><br/>
                                <p>$content</p>
                                <hr/>
                            </div>
                            EOT;
                        }
                        else if($_SESSION["power"]!='1') {
                            echo <<<EOT
                            <div class="item-content-left">
                                <img src='$quoteimg' alt='$title'>
                                <b>$title</b><br/><br/>
                                <p>$content</p>
                                <hr/>
                            </div>
                            EOT;
                        } 
                    } ?>
            </div>
            <div class="content-right">
                <button><i class="fa fa-phone"></i>&nbsp;Liên hệ tư vấn</button>
                <img src="../../assets/images/quangcao.jpg" alt="quang cao">
            </div>
        </div>
        <?php
            if($_SESSION["power"]!='1' && $_SESSION["power"]!='2'){
            ?>
        <div class="sticky" id="sticky">
            <div class='sticky-close'>
                <button onClick='closesticky()'>&#x2715;</button>
            </div>
            <div class='sticky-content'>
                <a onclick="document.getElementById('id01').style.display='block'"><button class="big-button">Login / Register</button></a>
            </div>
        </div>
        <?php
            }
            ?>
        <div class="footer">© by tuntun</div>
    </body>
    <script>
        function closesticky() {
                var sticky = document.getElementById('sticky');
                sticky.style.display = 'none';
            }
    </script>
</html>
