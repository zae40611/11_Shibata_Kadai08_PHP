<body>
    
<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['longin'])==false){
    echo 'ログインされていません。<br />';
    echo '<a href="./staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
}else{
    echo $_SESSION['staffname'];
    echo 'さんログイン中<br />';
    echo '<br />';
}


//funcs.phpを読み込む
require_once('funcs.php');

// 1. POSTデータ取得
$staffcode = $_GET['staffcode'];


// 2. DB接続
try {
  //Password:MAMP='root',XAMPP=''
  $dbh = new PDO('mysql:dbname=kadai08;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//3．SQL文を用意(データ取得：SELECT)
$stmt = $dbh->prepare("SELECT staffname FROM staff WHERE staffcode = $staffcode");

//4. 実行
$status = $stmt->execute();

//5．データ表示
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$staffname = $result['staffname'];

?>

スタッフ<br />
<br />
スタッフコード<br />
<?php echo $staffcode;?>
<br />
スタッフ名<br />
<?php echo $staffname;?>
<br />
このスタッフを削除してよろしいですか？<br />
<br />
<form method="POST" action="staff_delete_done.php">
<input type="hidden" name="staffcode" value="<?php echo $staffcode; ?>">

<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>


</body>

