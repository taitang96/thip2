<?php
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Đăng ký - Sharescript.net</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
	require('db.php');
    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']);
		$email = stripslashes($_REQUEST['email']);
		$password = stripslashes($_REQUEST['password']);

		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into [dbo].[users] (username, password, email) VALUES ('$username', '".md5($password)."', '$email')";
		echo $query;
		$result = sqlsrv_query($conn,$query);
		
        if($result){
            echo "<div class='form'><h3>Bạn đã đăng ký thành công</h3><br/>Click để <a href='login.php'>Đăng nhập</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Đăng ký</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Tên đăng nhập" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Mật khẩu" required />
<input type="submit" name="submit" value="Đăng ký" />
</form>
</div>
<?php } ?>
</body>
</html>
