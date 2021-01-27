<?php 
$aPacientes[]=array(
    "dni"=>"33.765.012",   
    "nombre"=>"Ana Acuña",
    "edad"=>45,
    "peso"=>81.50
);
$aPacientes[]=array(
    "dni"=>"23.684.352",   
    "nombre"=>"Gonzalo Bustamante",
    "edad"=>66,
    "peso"=>89
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>ISRAEL GATO</h1>
        <table class="table table-hover">
            <tr>
                <th>DNI</th>
                <th>Nombre y Apellido</th>
                <th>Edad</th>
                <th>Peso</th>            
            </tr>
        <?php foreach ($aPacientes as $i => $valor){?>
            <tr>
                <td><?php echo $aPacientes[$i]["dni"];?></td>
                <td><?php echo $aPacientes[$i]["nombre"];?></td>
                <td><?php echo $aPacientes[$i]["edad"];?></td>
                <td><?php echo $aPacientes[$i]["peso"];?></td>
            </tr>
        <?php }?>        
        </table>
    </div>
</body>
</html>