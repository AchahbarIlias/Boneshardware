<?php 
    include "../authenticate/AuthDependencies.php"; 
    include_once '../dbh.inc.php';
?>

<?php

function getSingleRow($conn, $query) {
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    return $row;
}

function createShoppingCart($conn, int $userId) {
    mysqli_query($conn,"INSERT INTO Carts (User_id) 
    VALUES ($userId)");

    $cartId = mysqli_insert_id($conn); 
    return $cartId;
}

function getShoppingCart($conn, int $userId) { 
    $row = getSingleRow($conn, "SELECT Cart_id FROM Carts WHERE User_id = $userId");
    return (int) $row["Cart_id"];
}


function getOrCreateCart($conn, int $userId) {
    $cartId = getShoppingCart($conn,$userId);
    if ($cartId === 0) $cartId = createShoppingCart($conn,$userId);
    
    return $cartId;
}

function createCartItem($conn, int $cartId, int $productId) {
    mysqli_query($conn,"INSERT INTO Cartitems (Cart_id, IDProducten)
    VALUES ($cartId, $productId)");

    $cartItemId = mysqli_insert_id($conn); 
    return $cartItemId;
}

function getCartItem($conn, int $cartId, int $productId) {
    $row = getSingleRow($conn, "SELECT Cartitem_id FROM Cartitems WHERE Cart_id = $cartId AND IDProducten = $productId");
    return (int) $row["Cartitem_id"];
}


function getOrCreateCartItem($conn, int $cartId, int $productId) {
    $cartItemId = getCartItem($conn,$cartId,$productId);
    if ($cartItemId === 0) $cartItemId = createCartItem($conn,$cartId,$productId);
    
    return $cartItemId;
}

/* UPDATE QUANTITY */

function increaseCartItemQuantityByOne($conn, int $cartItemId) {
    $query = "
        UPDATE Cartitems 
        SET aantal = aantal + 1 
        WHERE Cartitem_id = $cartItemId 
    ";
    
    return mysqli_query($conn, $query);
}


if ($auth->isLoggedIn()) { 
    $userId = $auth->getUserId();
    
    $cartId = getOrCreateCart($conn, $userId);
    $cartItemId = getOrCreateCartItem($conn, $cartId, (int) $_POST['productId'] );
    increaseCartItemQuantityByOne($conn, $cartItemId);
        
    $values = array(
        'cartItemId' => $cartItemId, 
        'cartId' => $cartId, 
        'productId' => (int) $_POST['productId']
    );
    
    echo json_encode($values), "\n";
    exit(1);
} else {
    header('HTTP/1.1 500 Internal Server Error');
    exit(0);
}

mysqli_close($conn);

?>Z