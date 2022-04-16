<?php
 include_once 'dbh.inc.php';
?>
<?php header("Content-type: text/html; charset=UTF-8"); ?>
<!DOCTYPE html>
<html>

<title>Bones Tech</title>
<head>
  <link rel="stylesheet" type="text/css" href="../../layout.css">
  <script src="JS.js"></script>
  <link rel="stylesheet" type="text/css" href="../Icons/font-awesome.css"/>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<?php
 include_once 'Menu.php';
?>

<div class="product-container">
    <div class="filters">
        <ul class="brand-filter">
            <?php 
                $sql = "SELECT DISTINCT(Merk) brand FROM products WHERE category_id = " . $_GET["categoryId"] . ";";
                $result = mysqli_query($conn, $sql);
    	        $resultCheck = mysqli_num_rows($result);
    	        
                if($resultCheck > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        
                        <li class="brand">
                            <input type="checkbox" class="check-brand" checked="true" />
                            <span class="brand-name"><?php echo $row["brand"] ?></span>
                        </li>
                        
                        <?php
                    }
                }
            
            ?>
        </ul>
        
        
        <?php
            $sql = "SELECT MAX(Prijs) max, MIN(Prijs) min FROM products WHERE category_id = " . $_GET["categoryId"] . ";";
            $result = mysqli_query($conn, $sql);
	        $resultCheck = mysqli_num_rows($result);
	        
            if($resultCheck > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    
                    echo $row["min"];
                    echo "-";
                    echo $row["max"];
                    
                }
            }
        ?>
        
            <div class="slidecontainer">
  <input type="range" min="<?php
            $sql = "SELECT MAX(Prijs) max, MIN(Prijs) min FROM products WHERE category_id = " . $_GET["categoryId"] . ";";
            $result = mysqli_query($conn, $sql);
	        $resultCheck = mysqli_num_rows($result);
	        
            if($resultCheck > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    
                    
                    echo $row["min"];
                }
            }
        ?>" max="<?php
            $sql = "SELECT MAX(Prijs) max, MIN(Prijs) min FROM products WHERE category_id = " . $_GET["categoryId"] . ";";
            $result = mysqli_query($conn, $sql);
	        $resultCheck = mysqli_num_rows($result);
	        
            if($resultCheck > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    
                    echo $row["max"];
                    
                }
            }
        ?>" value="0" class="slider" id="myRange">
            </div>
    </div>


    <div class="products">
<?php
	$sql = "SELECT * FROM products WHERE category_id = " . $_GET["categoryId"] . ";"; 

    if ($result=mysqli_query($conn,$sql))
      {
      // Fetch one and one row
      while ($row=mysqli_fetch_assoc($result))
        {
        //printf ("%s (%s)\n",$row[0],$row[1]);
        ?>
        
        <div class="product">
            <img src="<?php echo $row["Images"] ?>" class="product-image">
            <div class="product-details">
                <div class="price">€ <?php echo $row["Prijs"]; ?></div>
                <h2 class="brand"><?php echo $row["Merk"]; ?></h2>
                <h3 class="product-name"><?php echo $row["ProductNaam"]; ?></h3>
                <input type="button" value="Toevoegen" class="btn-add-to-cart">
                <div class="loader"><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i></div>
                <div class="success"><i class="fa fa-check fa-1x"></i></div>
                <p class="product-description">
                    <?php echo $row["Product_beschrijving"]; ?>
                </p>
                <input type="hidden" class="product-id" value="<?php echo $row["IDProducten"]; ?>" />
            </div>
        </div>
        <?php
        }
      // Free result set
      mysqli_free_result($result);
    }
	
		
?>
    </div>
</div>


<div class="AchtergrondVideo">
 <video autoplay loop height="902" width="100%">
 <source src="Images/AGVideo.webm" type="video/webm">
 </video>	
</div>


<script type="text/javascript" src="products.js"></script>
</body>
</html>