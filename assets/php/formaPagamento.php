<?php



$url = "https://api.fbits.net/formasPagamento";
$headers = [
   "Authorization: Basic MPoze-a986baee-bed4-4235-8f35-b89b24fae779",
   "Accept: application/json"
];
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$listaFormaPagamento = json_decode(curl_exec($ch),true);

$formaPagamento = 2;
//$array = [];
//array_map($resultado, $array);

echo '<pre>';
print_r($listaFormaPagamento); 
//var_dump($resultado);

foreach ($listaFormaPagamento as $pagamentos) {
   if (in_array($formaPagamento, $pagamentos)) {
      $NomeformaPagamento = $pagamentos['nomeExibicao'];
   } 
   
}






?>
