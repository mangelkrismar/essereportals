<?php 
?>
<!DOCTYPE html>
<html>
<head>
  <style>img{ height: 100px; float: left; }</style>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<script>
function get_jsonp_cross_domain() {
    $.ajax({
        url: 'http://www.krismar-educa.com.mx/regDispositivo/new/cros.php',//esto con un archivo php
        //url : 'http://miservidorremoto.com/clase/metodo',//esto con codeigniter :D
		data: {nombre:"hi"},
        type: 'GET',//tipo de petición
		
        dataType: 'jsonp',//tipo de datos
        jsonp: 'callback',//nombre de la variable get para reconocer la petición
        error: function(xhr, status, error) {
            alert("error");
        },
        success: function(data) {
			$(".data").html(data);
		}
   });
}
</script>
 <button onclick="get_jsonp_cross_domain()">pulsa</button>
 <div class="data"></div>
</body>
</html>