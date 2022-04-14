fetch("https://api.fbits.net/pedidos?dataInicial=2022-02-01&dataFinal=2022-03-01", {
   method: 'GET',
   withCredentials: true,
   credentials: 'include',
   headers: {
      'Accept': 'application/json',
      'Authorization': 'Basic MPoze-a986baee-bed4-4235-8f35-b89b24fae779',
      'Content-Type': 'application/json'
   }
})
   .then(Response => {
      //console.log(Response);
      console.log (Response.json()) 
   });