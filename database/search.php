<?php
if (isset($_REQUEST['ok'])) {
    $search = addslashes($_GET['search']);
    if (empty($search)) {
        echo "Yeu cau nhap du lieu vao o trong !";
    } else {
        $link = new mysqli('localhost', 'root', '', 'bytesoft') or die('Ket noi that bai !');
        $query = "SELECT * FROM post WHERE name LIKE '%$search%'";
        $sql   = mysqli_query($link, $query);
        $num   = mysqli_num_rows($sql);
        if ($num > 0 && $search != "") {
            echo "<br> <br> <br>";
            echo "$num KẾT QUẢ TRẢ VỚI TỪ KHÓA <b>$search</b> LÀ:";
            echo "<br> <br> <br>";
            echo '<table border="1" cellspacing="0" cellpadding="10" width="50%">';
            echo '<tr>';
            echo '<th> ID_category </th>';
            echo '<th> Title </th>';
            echo '<th> Content </th>';
            echo '</tr>';
            while ($row = mysqli_fetch_assoc($sql)) {
                echo '<tr>';
                echo "<td>{$row['id_category']}</td>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['content']}</td>";
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "Khong tim thay ket qua !";
        }
    }
}
?>
