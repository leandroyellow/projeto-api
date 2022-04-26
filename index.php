<?php
$dataInicio = filter_input(INPUT_POST, 'dataInicio');
$dataFim = filter_input(INPUT_POST, 'dataFim');
$email = filter_input(INPUT_POST, 'email');

function FormaPagamento($x) {
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

   $formaPagamento = $x;
   
   

   foreach ($listaFormaPagamento as $pagamentos) {
      if (in_array($formaPagamento, $pagamentos)) {
         $NomeformaPagamento = $pagamentos['nomeExibicao'];
      } 
   }
   return $NomeformaPagamento;
}

function NumeroParcela($x) {
   if ($x === 1) {
      return "a vista";
   } else {
      return $x . " vezes";
   }
}

$url = "https://api.fbits.net/pedidos?dataInicial=$dataInicio&dataFinal=$dataFim&email=$email";
$headers = [
   "Authorization: Basic MPoze-a986baee-bed4-4235-8f35-b89b24fae779",
   "Accept: application/json"
];
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$resultado = json_decode(curl_exec($ch),true);



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
   
   <header>
      <form action="#" method="post">
         <label>
            data inicio: <br>
            <input type="date" name="dataInicio" required>
         </label>
         <label>
            data fim: <br>
            <input type="date" name="dataFim" required>
         </label>
         <label>
            email: <br>
            <input type="email" name="email">
         </label>

         <button>pesquisar</button>
      </form>
   </header>
   
   <section class="pedidos-lista">
      <h2>Meus Pedidos</h2>
      <table>
         <?php foreach ($resultado as $itens) : ?>
         <tr>
            <td>
               <div class="pedido-desc">
                  <h3>número do pedido</h3>
                  <div class="linha"></div>
                  <div class="pedido-info"><?=$itens['pedidoId'];?></div>
                  <div class="pedido-info-desc"><?=$itens['data'];?></div>
               </div>
            </td>
            <td>
               <div class="pedido-desc">
                  <h3>forma de pagamento</h3>
                  <div class="linha"></div>
                  <div class="pedido-info"><?=FormaPagamento($itens['pagamento'][0]['formaPagamentoId'])?></div>
                  <div class="pedido-info-desc"><?=NumeroParcela($itens['pagamento'][0]['numeroParcelas'])?></div>
               </div>
            </td>
            <td>
               <div class="pedido-desc">
                  <h3>status do pedido</h3>
                  <div class="linha"></div>
                  <div class="pedido-status">12345</div>
               </div>
            </td>
            <td>
               <div class="pedido-desc">
                  <h3>valor total</h3>
                  <div class="linha"></div>
                  <div class="pedido-info">R$ <?=$itens['pagamento'][0]['valorTotal']?></div>
                  <div class="pedido-info-desc"><?=$itens['pagamento'][0]['numeroParcelas']?>x R$ <?=$itens['pagamento'][0]['valorParcela']?></div>
               </div>
            </td>
            <td>
               <div class="pedido-desc">
                  <h3>código de rastreio</h3>
                  <div class="linha"></div>
                  <div class="pedido-info">não enviado</div>
                  <div class="pedido-info-desc">10 dias úteis a partir da data de postagem</div>
               </div>
            </td>
            
         </tr>
         <?php endforeach ?>

   </table>
</section>





<script src="assets/js/main.js"></script>
</body>
</html>