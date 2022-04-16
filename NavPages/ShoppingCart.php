<?php
include "../authenticate/AuthDependencies.php"; 
 include_once '../dbh.inc.php';
 
 
 /*
    $userId = $auth->getUserId();
 
    select item.Cartitem_id, item.aantal, product.*
    from Carts cart
    join Cartitems item
    on item.Cart_id = cart.Cart_id
    join products product
    on product.IDProducten = item.IDProducten
    where User_id = $userId
 */
?>



<!DOCTYPE html>
<html>

<title>Bones Tech</title>
<head>
  <link rel="stylesheet" type="text/css" href="../layout.css">
  <script src="JS.js"></script>
  <link rel="stylesheet" type="text/css" href="../Icons/font-awesome.css"/>
</head>


<body>
<?php
include "../authenticate/AuthDependencies.php"; 
 include_once '../Menu.php';
 ?>
 

        
          
      
            
     <div class="ShoppingCart-wrapper">
         <h3 class="ShoppingCart-header"><div class="text">Shopping cart</div></h3>
     <div class="ShoppingCart-Container">
        <!--<div class="thead">-->
        <!--    <div class="tablerow">-->
        <!--         <div class="Product tableheader">-->
        <!--             Productnaam-->
        <!--         </div><div class="Aantal tableheader">-->
        <!--             Aantal-->
        <!--         </div><div class="Prijs-Stuk tableheader">-->
        <!--                 Prijs/stuk-->
        <!--         </div><div class="Totaal tableheader">-->
        <!--             Totaal-->
        <!--         </div>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="tbody">
        <?php
        $userId = $auth->getUserId();//$_POST['userId'] ?? '';
    	
    	$sql = "select item.Cartitem_id, item.aantal, product.*, ROUND(product.Prijs * item.aantal, 2) Total
                    from Carts cart
                    join Cartitems item
                    on item.Cart_id = cart.Cart_id
                    join products product
                    on product.IDProducten = item.IDProducten
                    where User_id = $userId";
    
        if ($result=mysqli_query($conn,$sql))
          {
              $grandTotal = 0;
          // Fetch one and one row
          while ($row=mysqli_fetch_assoc($result))
            {
            //printf ("%s (%s)\n",$row[0],$row[1]);
            
            $grandTotal += (double) $row["Total"];
            ?>
        
        
            <div class="tablerow">
                <div class="Product tablecell">
                <img src="<?php echo $row["Images"] ?>" class="product-imageCart">
                    <h2><?php echo $row["ProductNaam"]; ?></h2>
                    <p style="font-weight: bold"><?php echo "€ " . $row["Prijs"]; ?></p>
                </div>
                <div class="Aantal tablecell">
                    <input type="number" style="width: 35px;text-align: right;" value="<?php echo $row["aantal"]; ?>" disabled/>
                </div>
                <div class="Totaal tablecell"><?php echo "€ " . $row["Total"]; ?></div>
            </div>
            
            
        

 <?php
        }
        
        
      // Free result set
      mysqli_free_result($result);
    }
    
?>      </div>
     </div>
 </div>
 
 
 <div class="Afrekenen-container">
 <div class="Afrekenen">
        <div><?php  echo "<h1>€$grandTotal</h1>";?></div>        
            </div>
 


  <script src="checkout.js"></script>


  <div id="paypal-button"></div>

  <script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                production: '<insert production client id>'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '0.01', currency: 'USD' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                    window.alert('Payment Complete!');
                });
            }

        }, '#paypal-button');

    </script>

</div>   
 


</body>

</html>