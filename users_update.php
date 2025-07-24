<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Estabelecendo conexão com o banco de dados
$db = new SQLite3('./a/.eggziedb.db');

// Buscando dados no banco de dados
$res = $db->query('SELECT * FROM ibo WHERE id=\'' . $_GET['update'] . '\'');
$row = $res->fetchArray();

// Atribuindo variáveis a partir dos dados obtidos
$id = $row['id'];
$mac_address = $row['mac_address'];
$expire_date = $row['expire_date'];
$username = $row['username'];
$password = $row['password'];
$title = $row['title'];
$url = $row['url'];

// Lidando com a submissão do formulário
if (isset($_POST['submit'])) {
    $expire_date = strtotime($_POST['expire_date']);
    $expire_date = date('Y-m-d', $expire_date);
    $created_at = date('Y-m-d h:m:s');
    $url = $_POST['url'];
    $dns = $url;
    
    // Atualizando dados no banco de dados
    $db->exec('UPDATE ibo SET mac_address=\''.$_POST['mac_address'] .'\',
                                expire_date=\''.$expire_date .'\',
                                username=\''.$_POST['username'] .'\',
                                password=\''.$_POST['password'] .'\',
                                title=\''.$_POST['title'] .'\',
                                url=\''.$dns .'\',
                                created_at=\''.$created_at .'\'
               WHERE id=\''.$_POST['id'] .'\'');

    // Fechando conexão com o banco de dados
    $db->close();

    // Redirecionando após a atualização
    header('Location: users.php');
}

// Incluindo arquivo de cabeçalho
include 'includes/header.php';
?>

<script>
function extract(event) {
  event.preventDefault(); // Evita a atualização da página

  var m3uLink = document.getElementById("m3u_address").value;

  // Extrai o URL do servidor
  var serverUrl = m3uLink.split("/get.php")[0];
  document.getElementById("url").value = serverUrl;

  // Extrai o nome de usuário
  var username = getParameterByName("username", m3uLink);
  document.getElementById("username").value = username;

  // Extrai a senha
  var password = getParameterByName("password", m3uLink);
  document.getElementById("password").value = password;
}

function getParameterByName(name, url) {
  name = name.replace(/[\[\]]/g, "\\$&");
  var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
  if (!results) return "";
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}
</script>

<div class="container-fluid">
    <h1 class="h3 mb-1 text-gray-800">Atualizar Usuário</h1>
    <div class="card border-left-primary shadow h-100 card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> Edição de Usuário</h6>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-group">
                    <label class="control-label" for="mac_address"><strong>Endereço MAC</strong></label>
                    <div class="input-group">
                        <input class="form-control text-primary" name="id" value="<?php echo $id; ?>" type="hidden">
                        <input class="form-control text-primary" id="mac_address" name="mac_address" value="<?php echo $mac_address; ?>" type="text" required/>
                    </div>
                </div><div class="form-group">
                      <label class="control-label" for="title"><strong>Lista M3U</strong></label>
                    <div class="input-group">
                      
                        <input class="form-control text-primary" id="m3u_address" name="m3u_address" placeholder="Digite o link M3U" type="text" />
                        <button class="btn btn-success btn-icon-split" id="extract_button" onclick="extract(event)">
                            <span class="icon text-white-50"><i class="fa fa-save"></i></span><span class="text">Extrair</span>
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title"><strong>Nome</strong></label>
                    <div class="input-group">
                        <input type="text" class="form-control text-primary" name="title" value="<?php echo $title; ?>" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="username"><strong>Username</strong></label>
                    <div class="input-group">
                        <input type="text" class="form-control text-primary" id="username" name="username" value="<?php echo $username; ?>" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="password"><strong>Password</strong></label>
                    <div class="input-group">
                        <input type="text" class="form-control text-primary" id="password" name="password" value="<?php echo $password; ?>" required/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="url"><strong>DNS</strong></label>
                    <div class="input-group">
                        <input type="text" class="form-control text-primary" id="url" name="url" value="<?php echo $url; ?>" required/>
                    </div>
                </div>
                
                <div class="form-group ">
                    <label class="control-label" for="expire_date">
                     <strong>Válidade</strong>
                    </label>
                <div class="input-group">
                   <input type="text" class="form-control text-primary" name="expire_date" placeholder="YYYY-MM-DD" id="datetimepicker" value="<?php echo $expire_date; ?>" /> 
                </div>
                </div>
                
                <div class="form-group">
                    <div>
                        <button class="btn btn-success btn-icon-split" name="submit" type="submit">
                            <span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Salvar</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Incluindo arquivo de rodapé
include 'includes/footer.php';
?>

</body>
</html>
