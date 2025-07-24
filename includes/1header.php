<?php
session_start();

if (!isset($_SESSION['eggzie_iboPlayer'])) {
    header('../data/index.php');
    exit();
}

if (isset($_POST['btn-save'])) {
    file_put_contents('trial_mode', isset($_POST['trial']) ? $_POST['trial'] : '');   
    
    if(isset($_POST['app_dns'])){
        file_put_contents("app_dns", $_POST['app_dns']);
        file_put_contents("app_url", $_POST['app_url']);
    }
}

$IIIIIIIlI1lI = $_SESSION['id'];
$IIIIIIIlI1ll = new SQLite3('../a/.eggziepanels.db');
$IIIIIIIlI1l1 = $IIIIIIIlI1ll->query('SELECT * FROM USERS WHERE id=\'1\'');
$IIIIIIIlI11I = $IIIIIIIlI1l1->fetchArray();
$IIIIIIIlI11l = $IIIIIIIlI11I['NAME'];
$IIIIIIIlI111 = $IIIIIIIlI11I['LOGO'];
echo '<!DOCTYPE html>'."\n";
echo '<html lang="en">'."\n";
echo "\n";
echo '<head>'."\n";
echo "\n";
$IIIIIIIllIII = file_get_contents('includes/eggzie.json');
$IIIIIIIllIIl = json_decode($IIIIIIIllIII,true);
$IIIIIIIllII1 = $IIIIIIIllIIl['info'];
$IIIIIIIllIlI = $IIIIIIIllII1['aa'];
echo '  <meta charset="utf-8">'."\n";
echo '  <meta http-equiv="X-UA-Compatible" content="IE=edge">'."\n";
echo '  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">'."\n";
echo '  <meta name="description" content="">'."\n";
echo '  <meta name="author" content="">'."\n";
echo '  <meta name="google" content="notranslate">'."\n";
echo '  <script src="https://kit.fontawesome.com/3794d2f89f.js" crossorigin="anonymous"></script>'."\n";
echo '  <title>PAINEL ULTRA</title>'."\n";
echo '  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">'."\n";
echo '  <link rel="icon" href="favicon.ico" type="image/x-icon">'."\n";
echo '  <!-- Custom styles for this template-->'."\n";
echo '  <link href="css/sb-admin-'.$IIIIIIIllIlI .'.css" rel="stylesheet">'."\n";
echo '  <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.min.css"/>'."\n";
echo '  <!-- Custom fonts for this template-->'."\n";
echo '  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">'."\n";
echo '  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">'."\n";
echo ' '."\n";
echo '</head> '."\n";
echo '<body id="page-top">'."\n";
echo "\n";
echo '  <!-- Page Wrapper -->'."\n";
echo '  <div id="wrapper">'."\n";
echo "\n";
echo '    <!-- Sidebar -->'."\n";
echo '    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">'."\n";
echo "\n";
if ($IIIIIIIlI111 != NULL) {
echo '      <!-- Sidebar - Brand -->'."\n";
echo '      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">'."\n";
echo '        <div class="sidebar-brand-icon">'."\n";
echo '          <img class="img-profile" width="65px" src="'.$IIIIIIIlI111 .'">'."\n";
echo '        </div>'."\n";
}
else {
echo '      <!-- Sidebar - Brand -->'."\n";
echo '      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">'."\n";
echo '        <div class="sidebar-brand-icon">'."\n";
echo '          <img class="img-profile" width="65px" src="img/logo.png">'."\n";
echo '        </div>'."\n";
}
echo "\n";
echo '      </a>'."\n";
echo "\n";
echo '      <!-- Divider -->'."\n";
echo '      <hr class="sidebar-divider my-0">'."\n";
echo "\n";
echo '      <!-- Nav Item -->'."\n";
//echo '      <li class="nav-item">'."\n";
//echo '        <a class="nav-link" href="colour.php">'."\n";
//echo '          <i class="fas fa-fw fa-paint-plus"></i>'."\n";
//echo '          <span>Tema do Painel</span></a>'."\n";
//echo '      </li>'."\n";
echo '      <li class="nav-item">'."\n";
echo '        <a class="nav-link" href="users.php">'."\n";
echo '          <i class="fas fa-fw fa-user-plus"></i>'."\n";
echo '          <span>Users</span></a>'."\n";
echo '      </li>'."\n";
echo '      <li class="nav-item">'."\n";
echo '        <a class="nav-link" href="../config/ads.php">'."\n";
echo '          <i class="fas fa-fw fa-paint-brush"></i>'."\n";
echo '          <span>Personalizar IBO Player</span></a>'."\n";
echo '      </li>'."\n";
echo '      '."\n";
echo '      <li class="nav-item">'."\n";
echo '        <a class="nav-link" href="../config2/ads.php">'."\n";
echo '          <i class="fas fa-fw fa fa-paint-brush"></i>'."\n";
echo '          <span>Personalizar Vu Player</span></a>'."\n";
echo '      </li>'."\n";
echo "\n";
echo '      <li class="nav-item">'."\n";
echo '        <a class="nav-link" href="snoop.php">'."\n";
echo '          <i class="fas fa-fw fa-eye"></i>'."\n";
echo '          <span>Snoop</span></a>'."\n";
echo '      </li>'."\n";
echo '      '."\n";
echo '      <li class="nav-item">'."\n";
echo '        <a class="nav-link" href="profile.php">'."\n";
echo '          <i class="fas fa-fw fa-user"></i>'."\n";
echo '          <span>Profile</span></a>'."\n";
echo '      </li>'."\n";
echo '      '."\n";
echo '    '."\n";
echo '      <li class="nav-item">'."\n";
echo '        <a class="nav-link" href=" " target="_blank">'."\n";
echo '          <i class="fas fa-fw fa fa-dot-circle-o"></i>'."\n";
echo '          <span>Support</span></a>'."\n";
echo '      </li>'."\n";
echo '      '."\n";

echo "\n";
echo '      <li class="nav-item">'."\n";
echo '        <a class="nav-link" href="logout.php">'."\n";
echo '          <i class="fas fa-fw fa fa-sign-out"></i>'."\n";
echo '          <span>Logout</span></a>'."\n";
echo '      </li>'."\n";
echo '      '."\n";
echo '      <!-- Divider -->'."\n";
echo '      <hr class="sidebar-divider d-none d-md-block">'."\n";
echo "\n";
echo '      <!-- Sidebar Toggler (Sidebar) -->'."\n";
echo '      <div class="text-center d-none d-md-inline">'."\n";
echo '        <button class="rounded-circle border-0" id="sidebarToggle"></button>'."\n";
echo '      </div>'."\n";
echo '      </div>'."\n";

$app_dns = file_get_contents('app_dns');
$app_url = file_get_contents('app_url');

$mode = file_get_contents('trial_mode');

$checked = $mode == 'trial' ? "checked" : "";
echo "<div>
    <form method='POST'>
    
    <div class='form-check'>
    <input class='form-check-input' name='trial' type='checkbox' value='trial' id='trial_check' $checked>
      <label class='form-check-label' for='trial_check'>
        Habilitar teste
      </label>
    </div>";
if ($mode == 'trial') {
    echo "<b>Dados do App</b><br><br>
        <label>DNS</label>
        <input class='form-control' type='text' name='app_dns' placeholder='DNS' value='$app_dns'/><br>
        <label>URL</label>
        <input class='form-control' type='text' name='app_url' placeholder='URL' value='$app_url' /><br>";
}
        
echo "<button name='btn-save' class='btn btn-success'>Salvar</button>
    </form>
    </div>";
    

echo "\n";
?>
