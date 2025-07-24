<?php

include 'includes/header.php';
?>

	<div class="col-md-12 mx-auto">
	<center>
		<h1 class="colorboard"></i> Teste Automático</h1>
		</center>
	<br>


<?php 
if (isset($_POST['btn-save'])) {
    file_put_contents('trial_mode', isset($_POST['trial']) ? $_POST['trial'] : '');   
    
    if(isset($_POST['app_dns'])){
        file_put_contents("app_dns", $_POST['app_dns']);
        file_put_contents("app_url", $_POST['app_url']);
    }
}



              
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
    echo "<b>Dados do SERVIDOR</b><br><br>
        <label>DNS</label>
        <input class='form-control' type='text' name='app_dns' placeholder='Ex. http://cdn.seupainel.xyz:80' value='$app_dns'/><br>
        <label>URL (link do chat bot do seu painel) </label>
        <input class='form-control' type='text' name='app_url' placeholder='Ex. https://painel.seupainel.xyz/chatbot/?id=1511' value='$app_url' /><br>";
}


        
echo "<button name='btn-save' class='btn btn-success'>Salvar</button>
    </form>
    </div>";
    
    include ('includes/footer.php');?>