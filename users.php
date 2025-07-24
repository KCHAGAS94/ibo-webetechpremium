<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
// $IIIIIII1Il11 = 10;
// if (isset($_GET['view'])) {
// $IIIIIII1I1II = $_GET['view'];
// }
// else {
// $IIIIIII1I1II = 1;
// }
// $IIIIIII1I1Il = ($IIIIIII1I1II -1) * $IIIIIII1Il11;
$db = new SQLite3('a/.eggziedb.db');
$IIIIIII1I1lI = $db->query('SELECT COUNT(id) AS total FROM ibo');
$IIIIIII1I1ll = $IIIIIII1I1lI->fetchArray();
$IIIIIII1I1l1 = $IIIIIII1I1ll['total'];
// $IIIIIII1I11I = ceil($IIIIIII1I1ll['total'] / $IIIIIII1Il11);
$IIIIIII1IlII = $db->query('SELECT * FROM ibo ORDER by id ASC');
//$IIIIIII1IlII = $db->query('SELECT * FROM ibo ORDER by id ASC LIMIT '.$IIIIIII1I1Il .', '.$IIIIIII1Il11);
$today = date('Y-m-d');
if (isset($_GET['delete'])) {
$db->exec('DELETE FROM ibo WHERE id='.$_GET['delete']);
header('Location: users.php');
}else if (isset($_GET['delete-expired'])){
    while($row = $IIIIIII1IlII->fetchArray()){
        $active = $row["expire_date"] >= $today;
        if(!$active){
            $db->exec("DELETE FROM ibo WHERE id=" . $row['id']);
            echo "removed " . $row['id'] . "<br>";
        }
    }
    header("Location: users.php");
}
include 'includes/header.php';
echo "\n";
echo "\t\n";
echo '<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'."\n";
echo '    <div class="modal-dialog">'."\n";
echo '        <div class="modal-content">'."\n";
echo '            <div class="modal-header">'."\n";
echo '                <h2>Confirmar</h2>'."\n";
echo '            </div>'."\n";
echo '            <div class="modal-body">'."\n";
echo '                Deseja mesmo deletar ?'."\n";
echo '            </div>'."\n";
echo '            <div class="modal-footer">'."\n";
echo '                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>'."\n";
echo '                <a class="btn btn-danger btn-ok">Deletar</a>'."\n";
echo '            </div>'."\n";
echo '        </div>'."\n";
echo '    </div>'."\n";
echo '</div>'."\n";
echo '<main role="main" class="col-15 pt-4 px-5"><div class="row justify-text-center"><div class="chartjs-size-monitor" style="position:absolute ; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>'."\n";
echo '          <div id="main">'."\n";
echo '          <h1 class=" h3 mb-1 text-gray-800"> Usuários</h1>'."\n";
echo "<div class='input-group'>";
echo '                        <a button class="btn btn-success btn-icon-split" id="button" href="./users_create.php">'."\n";
echo '                        <span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Adicionar</span>'."\n";
echo '                        </button></a>'."\n";

echo "<div class=\"input-group-prepend \">\r\n
        <span class=\"input-group-text \" style=\"font-size:24px;color:#1cc88a\"><i class=\"fas fa-search\"></i></span>
    </div>\r\n
    <input class=\"form-control\" type=\"text\" id=\"search\" placeholder=\"Pesquisar Mac / Nome / Dns / Usuário ...\"  name=\"search_value\"/>\r\n        \r\n          
    <a class=\"btn btn-danger btn-icon-split\" id=\"button\" href='#' data-href=\"users.php?delete-expired\" data-toggle=\"modal\" data-target=\"#confirm-delete\">
        <span class=\"icon text-white-50\">
            <i class=\"fas fa-trash\"></i>
        </span>
        <span class=\"text\">Remover Expirados</span>
    </a>
    </div>
";

echo '          </div>'."\n";
echo "\t\t".'<div class="table-responsive">'."\n";
echo "\t\t\t".'<table class="table table-striped table-sm">'."\n";
echo "\t\t\t".'<thead class= "text-primary">'."\n";
echo "\t\t\t\t".'<tr>'."\n";
echo "\n";
echo '                  <th>Nome</th>'."\n";
echo "\t\t\t\t".'  <th>Endereço MAC</th>'."\n";
echo '                  <th>Usuário</th>'."\n";
echo '                  <th>Data de Expiração</th>'."\n";
echo '                  <th>Expirado?</th>'."\n";
echo '                  <th>DNS</th>'."\n";
echo "\t\t\t\t".'  <th>Editar</th>'."\n";
echo "\t\t\t\t".'  <th>Deletar</th>';
echo "\t\t\t\t".'</tr>'."\n";
echo "\t\t\t".'</thead>'."\n";
while ($IIIIIII1IlIl = $IIIIIII1IlII->fetchArray()) {
$IIIIIII1lI11 = $IIIIIII1IlIl['id'];
$IIIIIII1llII = $IIIIIII1IlIl['mac_address'];
$username = $IIIIIII1IlIl['username'];
$password = $IIIIIII1IlIl['password'];
$expire = $IIIIIII1IlIl['expire_date'];
$expired = $expire < $today;
$url = $IIIIIII1IlIl['url'];
if ($url && !strpos($url, 'username=')) {
    $url .= "/get.php?username=" . $username . "&password=" . $password . "&type=m3u_plus&output=ts";
}


$IIIIIII1llll = $IIIIIII1IlIl['title'];
echo '<tbody>'."\n";
echo '                  <td>'.$IIIIIII1llll .'</td>'."\n";
echo '                  <td>'.$IIIIIII1llII .'</td>'."\n";
echo '                  <td>'.$username .'</td>'."\n";
echo '                  <td>'.$expire .'</td>'."\n";
echo '                  <td>'.($expired ? "Sim" : "Não") .'</td>'."\n";
echo '                  <td>'.$url .'</td>'."\n";
echo '                  <td><a class="btn btn-icon" href="./users_update.php?update='.$IIIIIII1lI11 .'"><span class="icon text-white-50"><i class="fa fa-pencil-square-o" style="font-size:18px;color:blue"></i></span></a></td>'."\n";
echo '                  <td><a class="btn btn-icon" href="#" data-href="./users.php?delete='.$IIIIIII1lI11 .'" data-toggle="modal" data-target="#confirm-delete"><span class="icon text-white-50"><i class="fa fa-trash" style="font-size:18px;color:red"></i></span></a></td>'."\n";
echo "\t\t\t\t".'</tr>'."\n";
echo "\t\t\t".'</tbody>';
}
echo "\t\t\t".'</table>'."\n";
echo "\t\t".'</div>'."\n";
// if ($IIIIIII1Il11 <$IIIIIII1I1l1) {
// for ($IIIIIII1lII1 = 1;$IIIIIII1lII1 <= $IIIIIII1I11I;$IIIIIII1lII1++) {
// echo '<a class="btn btn-icon" href=\'users.php?view='.$IIIIIII1lII1 .'\'';
// if ($IIIIIII1lII1 == $IIIIIII1I1II) {
// echo ' class="active"';
// }
// echo '>Page '.$IIIIIII1lII1 .'</a> ';
// }
// }
echo '</main>'."\n";
echo "\n";
echo '    <br><br><br>';
include 'includes/footer.php';

echo "<script>\r\n\$(\"#search\").keyup(function () {\r\n    var value = this.value.toLowerCase().trim();\r\n\r\n    \$(\"table tr\").each(function (index) {\r\n        if (!index) return;\r\n        \$(this).find(\"td\").each(function () {\r\n            var id = \$(this).text().toLowerCase().trim();\r\n            var not_found = (id.indexOf(value) == -1);\r\n            \$(this).closest('tr').toggle(!not_found);\r\n            return not_found;\r\n        });\r\n    });\r\n});\r\n</script>\n    <script>\n\$('#confirm-delete').on('show.bs.modal', function(e) {\n    \$(this).find('.btn-ok').attr('href', \$(e.relatedTarget).data('href'));\n});\n    </script>";
echo '</body>'."\n";
?>