

<table class="table table-bordered my-5">
	<thead>
		<tr>
			<th scope="col">Order #</th>
			<th scope="col">Email Address</th>
			<th scope="col">Company Name</th>
			<th scope="col">Total Sale</th>
		</tr>
	</thead>
	<tbody>
		<?php
			include_once('header.php');
			include_once('inc/db.php');
			
			//echo $token;
			$shopName = trim($shop_url,"-myshopify.com");
			//echo $shopName;
		
			

$orders = curl_init("https://a7c27e8f9be9114a91383bc3aac70e28:".$token."@".$shop_url."/admin/api/2020-10/orders.json");

curl_setopt($orders, CURLOPT_FAILONERROR, true);
curl_setopt($orders, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($orders, CURLOPT_RETURNTRANSFER, true);
curl_setopt($orders, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($orders, CURLOPT_SSL_VERIFYPEER, false);  
$response = curl_exec($orders);

$list = json_decode($response);

 $allOrders = $list->orders;  
 
 
 
 //print_r($allOrders);
 foreach($allOrders as $odersKey)
 {
	echo "<tr>
	<td> <a href='#' data-toggle='modal' data-target='#printOrder".$odersKey->id."'>".$odersKey->id."</a> </td>
	<td>".$odersKey->email."</td>
	<td>".$odersKey->billing_address->company."</td>
	<td>".$odersKey->total_price."</td>
	


<div class='modal fade' id='printOrder".$odersKey->id."' tabindex='-1' aria-labelledby='printOrderLabel' aria-hidden='true'>
<div class='modal-dialog modal-lg' style='max-width: 80% !important;'>
	<div class='modal-content'>
		<div class='modal-header'>
			<h5 class='modal-title' id='printOrderLabel'>Print Order #".$odersKey->id."</h5>
			<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
			<span aria-hidden='true'>&times;</span>
			</button>
		</div>
		<div class='modal-body'>
			<div class='card border-0' id='printThisInvoice'>
				<div class='card-body'>
					<div class='row p-2'>
						<div class='col-md-6'><h4>";echo strtoupper($shopName);echo"</h4></div>
						<div class='col-md-6 text-right'><p class='font-weight-bold mb-1'>Invoice</p></div>
					</div>
					<hr class='my-3'>
					<div class='row p-2'>
						<div class='col-md-6'>
							<p class='font-weight-bold mb-4'>Customer Information</p>
                            <p class='mb-1'>".$odersKey->billing_address->company."</p>
                            <p class='mb-1'>".$odersKey->billing_address->address1."</p>
                            <p class='mb-1'>".$odersKey->billing_address->city."</p>
                            <p class='mb-1'>".$odersKey->billing_address->zip."</p></div>
						
					</div>
					<div class='row p-2'>
                        <div class='col-md-12'>
                        	<div class='row'>
                        		<div class='col-3 border'>Item</div>
                        		<div class='col-3 border'>Description</div>
                        		<div class='col-2 border'>Quantity</div>
                        		<div class='col-2 border'>Unit Cost(".$odersKey->currency.")</div>
                        		<div class='col-2 border'>Total(".$odersKey->currency.")</div>
                        	</div>";
								                        	
$totalPrice = 0;
 foreach ($odersKey->line_items as $index => $item) {
          $totalPrice += $item->price;
          
                       echo"<div class='row'>
		               <div class='col-3 border'>".$item->title."</div>
		               <div class='col-3 border'>".$item->name."</div>
		               <div class='col-2 border'>".$item->quantity."</div>
		               <div class='col-2 border'>".$item->price."</div>
		               <div class='col-2 border'>".($item->price)*($item->quantity)."</div>
	                        </div>";
									                        		
			}
									                        
	          echo"</div>
	      </div>
	      <div class='row p-2'>
			<div class='col-md-6'>
				<p class='font-weight-bold mb-4'>Other information</p>
	              <p class='mb-1'>Note:".$odersKey->note."</p>
	          </div>
			<div class='col-md-6 text-right'>
			<p class='font-weight-bold mb-4'>TAX AMOUNT:</p>
			<p class='mb-1'>".$odersKey->total_tax."<small>".$odersKey->currency."</small></p>
				<p class='font-weight-bold mb-4'>TOTAL AMOUNT:</p>
	              <p class='mb-1'>".$odersKey->total_price."<small>".$odersKey->currency."</small></p>
			</div>
		</div>
	</div>
					</div>
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
					<button type='button' class='btn btn-primary' id='printBtn'>Print</button>
				</div>
			</div>
		</div>
	</div>	</tr>";
		}
		
		?>

	</tbody>
</table>
	
	