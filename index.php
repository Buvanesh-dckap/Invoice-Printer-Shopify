<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Invoice Printer App</title>
  </head>
  <body class="bg-light">
	<div class="container py-5">
  
    <?php
    
		include_once("inc/functions.php");
    include_once("inc/db.php");
		include_once("header.php");
    include_once("orders.php");

    
echo "<form action='inc/insert.php' method='post'>
<input type='hidden' name='shop' id='' value=".$shop_url.">
<input type='hidden' name='token' id='' value=".$token.">
  <button class='btn btn-primary' type='submit' name='submit'>Refresh</button>
</form>";
    
        
    ?>
        
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
    <script>
      $('#printBtn').on('click', function(e) {
        $('#printThisInvoice').printThis();
      });

      

    </script>
  </body>
</html>