<?php
include "includes/header.php";
?>
<style>
  .custom-button {
    padding: 10px 20px;
  }
</style>
<script disable-devtool-auto src='https://cdn.jsdelivr.net/npm/disable-devtool'></script>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800"> Temas</h1>
    <!-- Custom codes -->
    <div class="card border-left-primary shadow h-100 card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs"></i> Escolha</h6>
        </div>
        <div class="card-body">
  <style>
     .custom-button {
        padding: 10px 20px;
    }

    .image-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .image-container {
        max-width: 300px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 20px;
        cursor: pointer;
    }

    .image-container img {
        max-width: 100%;
        border-radius: 8px;
    }
    label, select, input {
            margin-left: 10px;
        }
    form {
            display: flex;
            justify-content: center;
        }
        
        
  </style>
  
  
 <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedOptionValue = $_POST['options']; // Valor da opção selecionada

    // Array associativo para mapear os valores das opções para seus identificadores
    $optionMappings = [
        '1' => '1td',
        '2' => '2td',
        '3' => '3td',
        '4' => '4td',
        '5' => '6td',
        '6' => '5td'
    ];

    // Obter o identificador correspondente ao valor da opção selecionada
    $selectedOptionId = $optionMappings[$selectedOptionValue];

    // Read existing JSON data from file
    $jsonData = file_get_contents('./a/rtx/Setting.json');
    $data = json_decode($jsonData, true);

    // Update first record in JSON data
    $data[0]["RTXSetting"] = "matrix";
    $data[0]["PanalData"] = $selectedOptionId; // Usar o identificador ao invés do valor da opção

    // Encode the updated data back to JSON
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);

    // Write the updated JSON data to file
    file_put_contents('./a/rtx/Setting.json', $jsonData);
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <select name="options" width="300" id="options">
        <option value="1">TEMA 1</option>
        <option value="2">TEMA 2</option>
        <option value="3">TEMA 3</option>
        <option value="4">TEMA 4</option>
        <option value="5">TEMA 5</option>
        <option value="6">TEMA 6</option>
        <!-- Add more options here if needed -->
    </select>
    <br>
    <br>
    
    <input type="submit" class="horizontal-space btn btn-success btn-icon-split" value="  Enviar  ">
    
    
</form>
    
  
        
        <br>
        <br>
        
       	<div id="main">
            <div class="image-row">
            <div class="image-container">
              <p>TEMA 1</p>
              <img src="./rtx/layout/d.png" width="210" height="119" alt="theme_d">
            </div>
            
            <div class="image-container">
              <p>TEMA 2</p>
              <img src="./rtx/layout/1.png" width="210" height="119" alt="theme_1">
            </div>
                        
	    <div class="image-container">
              <p>TEMA 3</p>
              <img src="./rtx/layout/2.png" width="210" height="119" alt="theme_2">
            </div>          
              <div class="image-container">
              <p>TEMA 4</p>
              <img src="./rtx/layout/3.png" width="210" height="119" alt="theme_3"><br>
            </div>
              <div class="image-container">
              <p>TEMA 5</p>
                            <img src="./rtx/layout/4.png" width="210" height="119" alt="theme_4">
            </div>
              <div class="image-container">
              <p>TEMA 6</p>
              <img src="./rtx/layout/5.png" width="210" height="119" alt="theme_5">
              <p></p>INDICADO PARA<br>BANNER AUTOMÁTICO</p>
            </div>
</div>


        </div>

      </div>
  
  
</div>
</div>
</div>

</body>
</html>
