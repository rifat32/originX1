<x-html-head/>

      <!-- Header Section Begin -->
   <x-header/>
   <nav class="nav-menu mobile-menu">
                    <ul>
                    <li><a href="/">Home</a></li>
                        <li ><a href="#" >Shop</a>
                            <ul class="dropdown">
                            @foreach($services as $service)
                            <li><a href="/products/{{$service->service}}/All">{{$service->service}}</a></li>
                            @endforeach
                        
                            </ul>
                        </li>
                        
                        <li><a href="/contact">Contact</a></li>
                        <li><a href="/faq">Faq</a></li> 
                        
                <x-header-end/>        
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
          
            <form class="checkout-form" action="{{route('place.order.Auth')}}" method="POST">
                <div class="row">
               
                    <div class="col-lg-6">
                       
                        <div class="row">
                            
                       
            @csrf  
                    <input name="userName" id="userName" value="{{ Auth::user()->name }}"  type="hidden" >
                    <input name="productName" id="productName" value="{{$productName}}"  type="hidden" >
                    <input name="productImage" id="productImage" value="{{$productImage}}"  type="hidden" >
                    <input name="productQuantity" id="productQuantity" value="{{$productQuantity}}"  type="hidden" >
                    <input name="productId" id="productId" value="{{$productId}}"  type="hidden" >
                    <input name="productPrice" id="productPrice" value="{{$productPrice}}"  type="hidden" >
                    <input name="productTotalPrice" id="productTotalPrice" value="{{$totalPrice}}"  type="hidden" >
                
                         
                           
                     <div class="col-lg-12">
                                <label for="userAddress">Full Address<span>*</span></label>
                                <input maxlength="250" id="userAddress" required name="userAddress" type="text"  class="street-first" placeholder="Type your address here">
                                
                            </div>
                          
                          
                            <div class="col-lg-6">
                                <label for="userPhone">Phone<span>*</span></label>
                                <input maxlength="16" id="userPhone" required name="userPhone" type="text" placeholder="Type your address here">
                               
                            </div>
                          
                            <div class="col-lg-12">
                                <label for="userMessage">Your Message (Optional)</label><br>
                                <textarea  rows="4" cols="50" id="userMessage" required name="userMessage" placeholder="Type your Message here">
                                    </textarea>
                            </div>
                           
                          
                          
                         
                           
                        </div>
                    </div>
                    <div class="col-lg-6">
                        
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    
                                    <li class="fw-normal">{{$productName}} x {{$productQuantity}} <span>{{$totalPrice}}</span></li>
                                    
                                
                                    <li class="total-price">Total <span>{{$totalPrice}}</span></li>
                                </ul>
                               
                             
                               <button onclick="postData" type="submit" class="site-btn place-btn">Place Order</button>
                               
                                   
                            
                               
                               
                            </div>
                        </div>
                    </div>
                </div>
                </form>
          
        </div>
        </form> 
    </section>
    <!-- Shopping Cart Section End -->

    <!-- Partner Logo Section Begin -->
    <div class="partner-logo">
        <div class="container">
            <div class="logo-carousel owl-carousel">
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-1.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-2.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-3.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-4.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Partner Logo Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello.colorlib@gmail.com</li>
                        </ul>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Serivius</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>My Account</h5>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Shopping Cart</a></li>
                            <li><a href="#">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>Join Our Newsletter Now</h5>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Mail">
                            <button type="button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                        <div class="payment-pic">
                            <img src="img/payment-method.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

      <!-- Js Plugins -->
    
      <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script src="/js/jquery-ui.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha512-NqYds8su6jivy1/WLoW8x1tZMRD7/1ZfhWG/jcRQLOzV1k1rIODCpMgoBnar5QXshKJGV7vi0LXLNXPoFsM5Zg==" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js" integrity="sha512-m5kAjE5cCBN5pwlVFi4ABsZgnLuKPEx0fOnzaH5v64Zi3wKnhesNUYq4yKmHQyTa3gmkR6YeSKW1S+siMvgWtQ==" crossorigin="anonymous"></script>
    <script src="/js/jquery.dd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/jquery.slicknav.min.js" integrity="sha512-FmCXNJaXWw1fc3G8zO3WdwR2N23YTWDFDTM3uretxVIbZ7lvnjHkciW4zy6JGvnrgjkcNEk8UNtdGTLs2GExAw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
    <script src="/js/my.js"></script>
    <!-- toaster js cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
@if(Session::has('order-placed'))
<script>
    toastr.success("{!! Session::get('order-placed') !!}");
</script>
@endif
</body>

</html>