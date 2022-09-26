<?php 
// Header
include('../assets/template/admin/header.php');
?>
<!-- Links -->
<!-- CSS -->
<link rel="stylesheet" href="../assets/CSS/adminCSS/newcourier.css">
<!-- JS -->
<script src="../assets/JS/adminJS/newcourier.js"></script>
<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>

<!-- Main Content Starts Here -->
<div class="wrapper">
    <form method="POST">
        <div id="wizard">
            <!-- SECTION 1 -->
            <h4></h4>
            <section>
                <div class="form-row"> <input type="text" class="form-control" placeholder="Name"> </div>
                <div class="form-row"> <input type="text" class="form-control" placeholder="Email"> </div>
                <div class="form-row"> <input type="text" class="form-control" placeholder="Phone number"> </div>
                <div class="form-row"> <input type="text" class="form-control" placeholder="Street address"> </div>
            </section> <!-- SECTION 2 -->
            <h4></h4>
            <section>
                <div class="form-row"> <input type="text" class="form-control" placeholder="country"> </div>
                <div class="form-row"> <input type="text" class="form-control" placeholder="zip code"> </div>
                <div class="form-row" style="margin-bottom: 18px"> <textarea name="" id="" class="form-control" placeholder="Any order note about delivery or special offer" style="height: 108px"></textarea> </div>
            </section> <!-- SECTION 3 -->
            <h4></h4>
            <section>
                <div class="product">
                    <div class="item">
                        <div class="left"> <a href="#" class="thumb"> <img src="https://i.imgur.com/yYu3Hbl.jpg" alt=""> </a>
                            <div class="purchase">
                                <h6> <a href="#">Macbook Air Laptop</a> </h6> <span>x1</span>
                            </div>
                        </div> <span class="price">$290</span>
                    </div>
                    <div class="item">
                        <div class="left"> <a href="#" class="thumb"> <img src="https://www.businessinsider.in/thumb/msid-70101317,width-600,resizemode-4,imgsize-87580/tech/ways-to-increase-mobile-phone-speed/13d0e0722dbca5aa91e16a8ae2a744e5.jpg" alt=""> </a>
                            <div class="purchase">
                                <h6> <a href="#">Mobile Phone Mi</a> </h6> <span>x1</span>
                            </div>
                        </div> <span class="price">$124</span>
                    </div>
                </div>
                <div class="checkout">
                    <div class="subtotal"> <span class="heading">Subtotal</span> <span class="total">$364</span> </div>
                </div>
            </section> <!-- SECTION 4 -->
            <h4></h4>
            <section>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                    <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                </svg>
                <p class="success">Order placed successfully. Your order will be dispacted soon. meanwhile you can track your order in my order section.</p>
            </section>
        </div>
    </form>
</div>
<?php 
// Footer
include('../assets/template/admin/footer.php');
?>