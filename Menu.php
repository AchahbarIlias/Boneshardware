<?php include "authenticate/AuthDependencies.php"; ?>


<!--LOGO-->
  
<div id="wrapperHeader">
 <div id="header">
     <a href="http://www.boneshardware.be">  
        <img  src="../NavPages/Images/HeaderIMG.png" alt="logo" />
     </a>
 </div> 
</div>

<!--Navigatie bar-->

  
    <ul class="menu">
      <div class="navbar">
    <li  class="menu-item">
      <a href="/../../NavPages/Samenstellen.php">Desktop Samenstellen<div class="hovereffect"></div></a>
    </li>


    <li class="menu-item dropdown">
      <a  href="#">PC Onderdelen
      <div class="hovereffect"></div>
        <i class="fa fa-caret-down"></i>
        
      </a>
      <div class="dropdown-content">
        <div class="header">
          <h2>PC Onderdelen</h2>
        </div>
    
        <div class="row">

  <?php 
    $sqlMainCategories = "SELECT category_id, category_name FROM categories WHERE category_parent_id = 0;";
    $resultMainCategories = mysqli_query($conn, $sqlMainCategories);
    $resultCheckMainCategories = mysqli_num_rows($resultMainCategories);
  
    if($resultCheckMainCategories > 0) {
        while($rowMainCategory = mysqli_fetch_assoc($resultMainCategories)) {
            ?>

            <!-- HTML HERE -->
            <div class="column">
              <h3><?php echo $rowMainCategory["category_name"]; ?></h3>
            

            <?php               
              $sqlSubCategories = "SELECT category_id, category_name FROM categories WHERE category_parent_id = " . $rowMainCategory["category_id"] . ";";
              $resultSubCategories = mysqli_query($conn, $sqlSubCategories);
              $resultCheckSubCategories = mysqli_num_rows($resultSubCategories);

              if($resultCheckSubCategories > 0) {
                while($rowSubCategory = mysqli_fetch_assoc($resultSubCategories)) {
                    ?>

                    <!-- HTML HERE -->

                    <a href="/products.php?categoryId=<?php echo $rowSubCategory["category_id"]; ?>">
                      <?php echo $rowSubCategory["category_name"]; ?>
                    </a>

                    <?php
                    }
                }
                ?>

              </div>

          <?php
        }
    }

    ?>
        </div>
      </div>
    </li>
    <li class="menu-item">
      <a href="/NavPages/Contact.php">Contact<div class="hovereffect"></div></a>
    </li>
    
        <li  class="menu-item">
      <a href="/NavPages/OverOns.php">Over Ons<div class="hovereffect"></div> </a>
    </li>
    
    <li>
        <?php
        if ($auth->hasRole(\Delight\Auth\Role::ADMIN)) 
            {
                echo "<button>PRODUCT TOEVOEGEN</button>";
            }
        else
        {
         echo "";
        }
        ?>
    </li>
    
    
    
    <li>
         <a style="cursor: pointer;"><?php echo $auth->getEmail(); ?></a>
    </li>
            <li  class="menu-item">
      <a href="/NavPages/ShoppingCart.php"><i class="fa fa-shopping-cart"></i><div class="hovereffect"></div> </a>
    </li>
    
<?php 
    if ($auth->isLoggedIn()) {
?>

<style type="text/css">#dropdown2
{
display:none;
}</style>

<?php
    }
?>


    
    
    
    <?php 
    if ($auth->isLoggedIn()) {
      echo "<a style='background-color: #2E9AFE;' href='http://boneshardware.be/authenticate/logout.php'>Logout</a>";
    }
    else {
      
    }
    ?>
    
        
    </li>
    


    <li>
        
        <?php
            
        
            $loginErrorType = '';
            
            if (isset($_GET['login_error'])) {
                $loginErrorType = $_GET['login_error'];
            }
            
            $hasLoginError = $loginErrorType != '';
            $showLoginDropdownClass = '';
            
            if ($hasLoginError) {
                $showLoginDropdownClass = 'show2';
            }
        ?>
           <div id="dropdown2">
               
                     <button onclick="myFunction()" class="dropbtn2"><i class="fa fa-user-circle-o" aria-hidden="true"></i></button>
            <div id="myDropdown2" class="dropdown-content2 <?php echo($showLoginDropdownClass); ?>">
                <form action="/authenticate/login.php?from=<?php echo(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));?>" method="post">
                  <span class="login-title" href="#">Log hier in</span>
                  <div class="inputtitle">E-mail adres:</div>
                  <input type="text" name="email" placeholder="">
                   <div class="inputtitle">Wachtwoord:</div>
                  <input type="password" name="password" placeholder="">
                  <input type="submit" value="login"/>
                  <?php
                    if ($hasLoginError) {
                        echo '<div class="login-error">';
                        switch ($loginErrorType) {
                            case "WRONG_EMAIL":
                                echo('Fout email of wachtwoord');
                                break;
                            default:
                                echo('Onbekende fout');
                        }
                        echo '</div>';
                    }
                  ?>
                  <a href="/NavPages/LOGSIG.php">Nog geen account klik hier!</a>
                  
                </form>
            </div>
            
  
  <script>
      function myFunction() {
    document.getElementById("myDropdown2").classList.toggle("show2");
}

  </script>
</div>
    </li>
    
    

    
    
</ul>



<!--Navigatie bar Einde-->