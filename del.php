<?php require_once('Connections/conn_sql.php'); ?>
<?php
// 資料庫連線設定
$servername = "127.0.0.1";
$username = "your_username";
$password = "your_password";
$dbname = "mango";

// 建立連線
//$conn = new mysqli($servername, $username, $password, $dbname);

// 確認連線是否成功
// if ($conn->connect_error) {
//     die("連線失敗：" . $conn->connect_error);
// }

// 刪除訂單細節
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete_detail"])) {
    $detailID = $_GET["detail_id"];

    $sql_delete_detail = "DELETE FROM list_detail WHERE detailid='$detailID'";

    if ($conn->query($sql_delete_detail) === TRUE) {
        echo "訂單細節刪除成功";
    } else {
        echo "Error: " . $sql_delete_detail . "<br>" . $conn->error;
    }
}

// 查詢所有訂單細節資訊
$sql_list_detail = "SELECT * FROM list_detail";
//$result_list_detail = $conn->query($sql_list_detail);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>訂單細節管理</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>訂單細節管理</h1>
    <?php
    if ($result_list_detail->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>訂單細節編號</th><th>訂單編號</th><th>產品編號</th><th>產品圖片</th><th>產品名稱</th><th>價格</th><th>數量</th><th>總價</th><th>操作</th></tr>';
        while ($row_list_detail = $result_list_detail->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row_list_detail['detailid'] . '</td>';
            echo '<td>' . $row_list_detail['OrderID'] . '</td>';
            echo '<td>' . $row_list_detail['productid'] . '</td>';
            echo '<td><img src="productimages/' . $row_list_detail['productimage'] . '" alt="' . $row_list_detail['productname'] . '" width="50" height="50"></td>';
            echo '<td>' . $row_list_detail['productname'] . '</td>';
            echo '<td>' . $row_list_detail['price'] . '</td>';
            echo '<td>' . $row_list_detail['quantity'] . '</td>';
            echo '<td>' . $row_list_detail['totalprice'] . '</td>';
            echo '<td><a href="?delete_detail=true&detail_id=' . $row_list_detail['detailid'] . '">刪除</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '沒有找到訂單細節';
    }

    // 釋放結果集及關閉資料庫連線
    $result_list_detail->free_result();
    ?>
</body>
</html>
