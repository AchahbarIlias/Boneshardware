var ajax = (function(){
    function doPost(url, successCallback, errorCallback, bodyParams){
        var xhr = new XMLHttpRequest();
        
        xhr.open('POST', url);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                successCallback(xhr.responseText);
            }
            else if (xhr.status !== 200) {
                errorCallback('Request failed.  Returned status of ' + xhr.status);
            }
        };
        xhr.send(encodeURI(bodyParams));
    }
    
    return {
        doPost: doPost
    };
})();

(function(doPost) {
    function addToShoppingCart(productId, onSuccessCallback, onErrorCallback){
        var onSuccess = function(response){
            onSuccessCallback();
        };
        var onFailure = function(response){
            onErrorCallback();
        };
        
        doPost('/ShoppingCart/addToCart.php', onSuccess, onFailure, 'productId=' + productId);
    }
    
    function onClickAddButton(productId){
        var productDetails = this.getElementsByClassName('product-details')[0];
        
        var startLoading = function() {
            productDetails.className += ' loading';
        };
        
        var stopLoading = function() {
            productDetails.className = productDetails.className.substr(0, productDetails.className.indexOf(' loading'));
        };
        
        var startSuccess = function() {
            productDetails.className += ' success';
        };
        
        var endSuccess = function() {
            productDetails.className = productDetails.className.substr(0, productDetails.className.indexOf(' success'));
        };
        
        var showLoggedInFirstDialog = function() {
             alert('You must be logged in to add products');
             //document.body.className += 'show-logged-in-first'
             /* position fixed width 100% height 100% rgba(0,0,0,0.2)
             <div class="modal logged-in-first" onClick="javascript: document.body.className = ''">
                <div class="dialog">Whatever</div>
             </div>
             */
        };
        
        startLoading();
        addToShoppingCart(productId, function(){
            stopLoading();
            startSuccess();
            setTimeout(endSuccess, 3000);
        }, function() {
            stopLoading();
            showLoggedInFirstDialog();
        });
    }
    
    function bindAddToCartButtons(){
        var productsContainer = document.getElementsByClassName('products')[0];
        var products = productsContainer.getElementsByClassName("product");
        
        for(var i = 0; i < products.length; i++)
        {
            var product = products[i];
            var productId = product.getElementsByClassName('product-id')[0].value;
            var addToCartButton = product.getElementsByClassName('btn-add-to-cart')[0];
            
            addToCartButton.addEventListener("click", onClickAddButton.bind(product, productId));
        }
    }
    
    function init(){
        bindAddToCartButtons();
    }
    
    init();
})(ajax.doPost);