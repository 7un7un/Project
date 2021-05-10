<?php require_once("../../database/connect.php");?>
<?php session_start();?>
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
        <title>Home</title>
    </head>
    <body>
        <div class="topnav">
            <a class="active" href="">
            <img src="../../assets/images/logo.png" alt="logo-unicorn-queen">
            <a style='font-size: 30px; color: #33bef5'>NEWS</a>
            </a>
            <a href="#" class='btn-user'>
            Welcome: <?php echo $_SESSION["username"]; ?>
            <a href="run-logout.php" onclick="return confirm('Bạn có muốn đăng xuất <?php echo $_SESSION['username'];?> ?');">
            <button>Logout</button>
            </a>
            </a>
            <div class="search-container">
                <form action="database/search.php" method="get">
                    <input type="text" placeholder="Tìm kiếm.." name="search">
                    <input class='btn-search' type="submit" name="ok" value="Tìm kiếm" />
                </form>
            </div>
        </div>
        <div class="menu">
            <?php
                $stmt=$con->prepare("SELECT * FROM category");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result=$stmt->fetchALL();
                foreach($result as $row) {
                    $id_category=$row['id_category'];
                    $name_category=$row['name_category'];
                    echo "<a href='../post/detail-page.php?id_category=$id_category'>
                    <button>$name_category</button></a>";
                }
                ?>
        </div>
        <div class="content">
            <div id="id01" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <h3>Đăng nhập</h3>
                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                        <form action="include/user/run-login.php">
                            <label for="username">Tên tài khoản</label>
                            <input type="text" placeholder="Tên tài khoản" required>
                            <label for="password">Mật khẩu</label>
                            <input type="password" placeholder="Mật khẩu" required>
                            <button type="submit">Đăng nhập</button><br/><br/>
                            <a href="#">Chưa có tài khoản ? <b>Đăng ký.</b></a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="content-left">
                <?php
                    $stmt=$con->prepare("SELECT * FROM post limit 7");
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result=$stmt->fetchALL();
                    foreach($result as $row)
                    {
                        $title=$row["title"];
                        $image=$row["image"];
                        $quoteimg='../../uploads/images/'.$image;
                        $content=$row["content"];
                        $id=$row["id"];
                        $id_category=$row["id_category"];
                        ?>
                <?php
                    echo <<<EOT
                    <div class="item-content-left">
                        <img src='$quoteimg' alt='$title'>
                        <b>$title</b><br/><br/>
                        <p>$content</p>
                        <hr/>
                    </div>
                    EOT;
                    ?>
                <?php
                    }?>
            </div>
            <div class="content-right">
                <button><i class="fa fa-phone"></i>&nbsp;Liên hệ tư vấn</button>
                <img src="../../assets/images/quangcao.jpg" alt="quang cao">
            </div>
        </div>
        <div class="footer">© by tuntun</div>
    </body>
</html>
