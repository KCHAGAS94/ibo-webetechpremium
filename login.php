<?php

function real_ip()
{
$ip = 'undefined';
if (isset($_SERVER)) {
$ip = $_SERVER['REMOTE_ADDR'];
if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
$ip = $_SERVER['HTTP_CLIENT_IP'];
}
}
else {
$ip = getenv('REMOTE_ADDR');
if (getenv('HTTP_X_FORWARDED_FOR')) {
$ip = getenv('HTTP_X_FORWARDED_FOR');
}
else if (getenv('HTTP_CLIENT_IP')) {
$ip = getenv('HTTP_CLIENT_IP');
}
}
$ip = htmlspecialchars($ip,ENT_QUOTES,'UTF-8');
return $ip;
}
session_start();
$jsondata111 = file_get_contents('./includes/eggzie.json');
$json111 = json_decode($jsondata111,true);
$col1 = $json111['info'];
$col2 = $col1['aa'];
$db_check1 = new SQLite3('./a/.eggziepanels.db');
$db_check1->exec('CREATE TABLE IF NOT EXISTS USERS(id INT PRIMARY KEY,NAME TEXT,USERNAME TEXT,PASSWORD TEXT,LOGO TEXT)');
$rows = $db_check1->query('SELECT COUNT(*) as count FROM USERS');
$row = $rows->fetchArray();
$numRows = $row['count'];
if ($numRows == 0) {
$db_check1->exec('INSERT INTO USERS(id,NAME,USERNAME,PASSWORD,LOGO) VALUES(\'1\',\'Your Name\',\'admin\',\'admin\',\'img/logo.png\')');
}
$res_login = $db_check1->query('SELECT * '."\n\t\t\t\t".'  FROM USERS '."\n\t\t\t\t".'  WHERE id=\'1\'');
$row_login = $res_login->fetchArray();
$name_login = $row_login['NAME'];
$logo_login = $row_login['LOGO'];
if (isset($_POST['login'])) {
$sql_check = 'SELECT * from USERS where USERNAME="'.$_POST['username'] .'"';
$ret_check = $db_check1->query($sql_check);
while ($row_check = $ret_check->fetchArray()) {
$id_check = $row_check['id'];
$NAME = $row_check['NAME'];
$USERNAME = $row_check['USERNAME'];
$PASSWORD = $row_check['PASSWORD'];
$LOGO_check = $row_check['LOGO'];
}
if (empty($id_check)) {
$message = '<div class="alert alert-danger" id="flash-msg"><h4><i class="icon fa fa-times"></i>Not a Valid User!</h4></div>';
echo $message;
}
else if ($PASSWORD == $_POST['password']) {
$_SESSION['eggzie_iboPlayer'] = true;
$_SESSION['N'] = $id_check;
$_SESSION['id'] = $id_check;
header('Location: users.php');
}
else {
$message = '<div class="alert alert-danger" id="flash-msg"><h4><i class="icon fa fa-times"></i>Wrong Password!</h4></div>';
echo $message;
}
$db_check1->close();
}
$date = date('d-m-Y H:i:s');
$IPADDRESS = real_ip();
// $IIIIIIIl11ll = new SQLite3('./a/.logs.db');
// $IIIIIIIl11ll->exec('CREATE TABLE IF NOT EXISTS logs(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date TEXT, ipaddress TEXT)');
// $IIIIIIIl11ll->exec('INSERT INTO logs(date,ipaddress) VALUES(\''.$date .'\',\''.$IPADDRESS .'\')');
// $IIIIIIIIlIlI = new SQLite3('./a/.eggziedb.db');
// $IIIIIIIIlIlI->exec('CREATE TABLE IF NOT EXISTS ibo(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,mac_address VARCHAR(100),username VARCHAR(100),password VARCHAR(100),expire_date VARCHAR(100),url VARCHAR(100),title VARCHAR(100),created_at VARCHAR(100))');
// $IIIIIIIIlIlI->exec('CREATE TABLE IF NOT EXISTS theme(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,name VARCHAR(100),url VARCHAR(100))');
//====>
// echo '<!DOCTYPE html>'."\n";
// echo '<html>'."\n";
// echo "\n";
// echo '<head>'."\n";
// echo '    <meta charset="utf-8">'."\n";
// echo '    <meta http-equiv="X-UA-Compatible" content="IE=edge">'."\n";
// echo '    <meta name="viewport" content="width=device-width, initial-scale=1">'."\n";
// echo '    <title>Ultra IBO</title>'."\n";
// echo '    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">'."\n";
// echo '    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">'."\n";
// echo '    <link href="css/sb-admin-'.$col2 .'.css" rel="stylesheet">'."\n";
// echo '    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">'."\n";
// echo '    <link rel="icon" href="favicon.ico" type="image/x-icon">'."\n";
// echo '</head>'."\n";
// echo "\t".'<body class="bg-gradient-primary">'."\n";
// echo "\t".'<div class="container">'."\n";
// echo "\t".'<div class="row justify-content-center">'."\n";
// echo "\t".'<center>'."\n";
// echo '<body>'."\n";
// echo '  <div class="wrapper ">'."\n";
// echo '  <br><br><br>'."\n";
// echo "\t".'<div class="container" style="margin-top:30px">'."\n";
// echo "\t".'    <div style="width:400px; margin:0 auto;">'."\n";
// echo "\t\t".'<div class="row">'."\n";
// echo "\t\t\t".'<div class="center">'."\n";
// echo '                          <center><img src="'.$logo_login .'" width="100" height="100" class="center" alt=""></a></center>'."\n";
// echo "\t\t\t\t".'<br>'."\n";
// echo "\t\t\t".'    <h3 class="text-center text-light"><strong>Ultra IBO</strong></h3>'."\n";
// echo "\t\t\t".'    <h3 class="text-center text-light">'.$name_login .'</h3>'."\n";
// echo "\t\t\t\t".'<h5 class="text-center text-light">Welcome</h5>'."\n";
// echo "\t\t\t\t".'<br>'."\n";
// echo "\t\t\t\t".'<div>'."\n";
// echo "\t\t\t\t".'    <div style="width:400px; margin:0 auto;">'."\n";
// echo "\t\t\t\t\t".'<form method="post">'."\n";
// echo "\t\t\t\t\t".'<input type="text" class="form-control text-primary" placeholder="Username" name="username" required autofocus><br>'."\n";
// echo "\t\t\t\t\t".'<input type="password" class="form-control text-primary" placeholder="Password" name="password" required><br>'."\n";
// echo "\t\t\t\t\t".'<button class="btn btn-lg btn btn-primary btn-block" name="login" type="submit">LET ME IN</button>'."\n";
// echo "\t\t\t\t\t".'</form>'."\n";
// echo "\t\t\t\t".'</div>'."\n";
// echo "\t\t\t".'<div class="card-body">'."\n";
// echo "\t\t\t\t".'<div class="panel-body">'."\n";
// echo "\t\t\t\t".'<p class="text-center text-warning">Time Of Arrival: "<i>';
// echo date('d-m-Y H:i:s');
// echo '</i>"</p>'."\n";
// echo "\t\t\t\t".'<p class="text-center text-warning">IP Address: "<i>';
// echo real_ip();
// echo ' </i>"</p>'."\n";
// echo "\t\t\t".'</div>'."\n";
// echo "\t\t\t".'</div>'."\n";
// echo '      <!-- Footer -->'."\n";
// echo '      <footer class="">'."\n";
// echo '        <div class="container">'."\n";
// echo '          <div class="copyright text-center my-auto">'."\n";
// echo '          </div>'."\n";
// echo '        </div>'."\n";
// echo '      </footer>';
// echo "\t".'</div>'."\n";
// echo "\t".'</div>'."\n";
// echo "\t".'</div>'."\n";
// echo "\t".'</div>'."\n";
// echo "\t".'</div>'."\n";
// echo "\t".'</div>'."\n";
// echo "\t".'<script src="vendor/jquery/jquery.min.js"></script>'."\n";
// echo "\t".'<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>'."\n";
// echo "\t".'<script src="vendor/jquery-easing/jquery.easing.min.js"></script>'."\n";
// echo "\t".'<script src="js/sb-admin-2.min.js"></script>'."\n";
// echo "\n";
// include 'includes/functions.php';
// require 'includes/egz.php';
// echo '</body>'."\n";
// echo "\n";
// echo '</html>'."\n";
//==>
echo "<!DOCTYPE html>\n<html>\n\n<head>\n    <meta charset=\"utf-8\">\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n    <title>PAINEL ULTRA</title>\n    <link href=\"vendor/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" type=\"text/css\">\n    <link href=\"https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i\" rel=\"stylesheet\">\n";
echo "    <link href=\"css/sb-admin-" . $col2 . ".css\" rel=\"stylesheet\">" . "\n";
echo "    \n<script src=\"https://code.jquery.com/jquery-3.2.1.min.js\" integrity=\"sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=\" crossorigin=\"anonymous\"></script>\n  <script defer src=\"https://use.fontawesome.com/releases/v5.0.1/js/all.js\"></script>\n\n  <script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.12/jquery.transit.js\" integrity=\"sha256-mkdmXjMvBcpAyyFNCVdbwg4v+ycJho65QLDwVE3ViDs=\" crossorigin=\"anonymous\"></script><link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css\">\n  <link rel=\"stylesheet\" href=\"css/style.css\">\n\n\n    <link rel=\"shortcut icon\" href=\"favicon.ico\" type=\"image/x-icon\">\n    <link rel=\"icon\" href=\"favicon.ico\" type=\"image/x-icon\">\n</head>\n";
echo "\t<body class=\"bg-gradient-primary\">\n\n <div id=\"container\">\n    <div id=\"inviteContainer\">\n      <div class=\"logoContainer\" >\n      \n      <img class=\"logo\" src=\"" . $logo_login . "\"/><br>\n      <p class=\"text\"  style=\"transition-delay: 0.2s\"> " . $name_login . " </p><br>\n      <a href=\"https://lojaapps.playerapps.xyz\" target=\"_blank\">\n   <img class=\"logo\" src=\"img/corp.png\" alt=\"&#169; Matrix STORE\" title=\"&#169; Matrix STORE\"/></a>\n      </div>\n      <div class=\"acceptContainer\">\n        <form method=\"POST\">\n      <p class=\"text\"  style=\"transition-delay: 0.4s\"><br>\n          <h1>PAINEL ULTRA<br>Gerenciamento</h1>\n      Entre com Seus Dados de Acesso</p>\n          <div class=\"formContainer\">\n            <div class=\"formDiv\" style=\"transition-delay: 0.2s\">\n            \n\n              <p>USUÁRIO</p>\n              <input type=\"text\" class=\"form-control text-primary\" name=\"username\" required=\"\" required autofocus/>\n            </div>\n            <div class=\"formDiv\" style=\"transition-delay: 0.4s\">\n              <p>SENHA</p>\n              <input type=\"text\" class=\"form-control text-primary\" name=\"password\" required=\"\"/><br>\n            </div>\n            <div class=\"formDiv\" style=\"transition-delay: 0.6s\">\n              <button class=\"dacceptBtn btn btn-lg btn btn-primary btn-block\"  name=\"login\" type=\"submit\">ENTRAR</button>\n            </div>\n            " . "\n";
echo "\t\t\t\t<p class=\"text-center text-warning\">Time Of Arrival: \"<i>";
echo date("d-m-Y H:i:s");
echo "<br> IP Address: \"<i>";
echo real_ip();
echo " </i>\"</p><br>\n             </div>\n         </form>\n      </div>\n    </div>\n    \n      <!-- Footer -->\n      <footer class=\"\">\n        <div class=\"container\">\n          </div>\n        </div>\n      </footer>\n </div>\n<!-- partial -->\n  <script  src=\"js/script.js\"></script>\n\n";
require "includes/egz.php";
echo "</body>\n\n</html>\n";
?>
