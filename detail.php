<?php require_once('Connections/conn_sql.php'); ?>
<?php
// 設定資料庫連線
$servername = "127.0.0.1";
$username = "your_username";
$password = "your_password";
$dbname = "mango";

// 添加新的商品細節
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_detail"])) {
    $orderID = $_POST["orderID"];
    $productID = $_POST["productID"];
    $productName = $_POST["productName"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $totalPrice = $price * $quantity;

    $sql = "INSERT INTO list_detail (OrderID, productid, productname, price, quantity, totalprice)
            VALUES ('$orderID', '$productID', '$productName', '$price', '$quantity', '$totalPrice')";

    if ($conn->query($sql) === TRUE) {
        echo "商品細節添加成功";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// 查詢所有商品細節
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["get_details"])) {
    $sql = "SELECT * FROM list_detail";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 將結果轉換為關聯數組並輸出
        $details = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($details);
    } else {
        echo "沒有找到商品細節";
    }
}

// 刪除商品細節
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_detail"])) {
    $detailID = $_POST["detailID"];

    $sql = "DELETE FROM list_detail WHERE detailid='$detailID'";

    if ($conn->query($sql) === TRUE) {
        echo "商品細節刪除成功";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
