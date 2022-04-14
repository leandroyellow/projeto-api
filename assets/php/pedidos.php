<?php

/*
curl -X GET 
--header 'Accept: application/json' 
--header 'Authorization: Basic MPoze-a986baee-bed4-4235-8f35-b89b24fae779' 
'https://api.fbits.net/pedidos?dataInicial=2022-03-01&dataFinal=2022-04-01'
*/

$url = "https://api.fbits.net/pedidos?dataInicial=2022-02-01&dataFinal=2022-03-01";
$headers = [
   "Authorization: Basic MPoze-a986baee-bed4-4235-8f35-b89b24fae779",
   "Accept: application/json"
];
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$resultado = json_decode(curl_exec($ch),true);

//$array = [];
//array_map($resultado, $array);

echo '<pre>';
print_r($resultado); 
//var_dump($resultado);


echo '<hr>';
foreach ($resultado as $usuarioID) {
   echo $usuarioID['usuario']['usuarioId'] . "<br>";
}


?>
