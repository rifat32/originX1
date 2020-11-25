<style>
  
    ::placeholder {
  font-size: 1rem;
}
.hrcolor{
    background: #e7ab3c;
    height: .4rem;
   margin-bottom: 1rem;
}
.brandOver{
    padding-left: 20px;
    border: 2px solid #17a2b8;
    background-color: #fff;
    height: 10rem;
    overflow-y: scroll;
}

.phpActive{
    background-color: #e7ab3c;
    padding: 0 .5rem;

}
.colors{
    padding: 1.1px;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    cursor: pointer;
    margin-bottom: 0;
    position: relative; 
    right:5px;
}
.customColor{
    font-size: 16px;
    
    
    font-weight: 700;
    border-radius: 50%;
    height: 40px;
    width: 47px;
    border: 1px solid #ebebeb;
    text-align: center;
    line-height: 40px;
    text-transform: uppercase;
    cursor: pointer;
}


</style>
<x-html-head/>

     <!-- Header Section Begin -->
     <x-header/>
   <nav class="nav-menu mobile-menu">
                    <ul>
                    <li><a href="/">Home</a></li>
                      
                      <li ><a href="#" >Shop</a>
                          <ul class="dropdown">
                          @foreach($services as $service)
                          <li><a
                        href="/products/{{$service->service}}/All">{{$service->service}}</a></li>
                          @endforeach
                      
                          </ul>
                      </li>
                     
                      <li><a href="/contact">Contact</a></li>
                      <li ><a href="/faq">Faq</a></li>
                       
                <x-header-end/>        
    <!-- Header End -->
    @foreach($product as $product)

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./home.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>{{$product->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                    <div class="filter-widget">
                    <h4 class="fw-title text-center text-lg-left">Services</h4>
                    <ul class="filter-catagories text-center text-lg-left">
             @foreach($services as $service)
            
             <li><a 
             @if($service->service == $product->service)
             class="phpActive"
             @endif
             href="/products/{{$service->service}}/All">{{$service->service}}</a></li>
             @endforeach
                        
                           
                        </ul>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title text-center text-lg-left">{{$product->service}} Categories</h4>
                       
                        <ul class="filter-catagories text-center text-lg-left">
                        <li><a
                        
                        href="/products/{{$product->service}}/All">All</a></li>
                            @foreach($productCategories as $productCategory)
                            <li><a
                            @if($productCategory->category == $product->category)
                            class="phpActive"
                            @endif
                            href="/products/{{$product->service}}/{{$productCategory->category}}">{{$productCategory->category}}</a></li>
                            @endforeach
                          
                           
                        </ul>
                    </div>
                    <h4 class="text-center py-1" style="background-color: #ddd;">Filter Brands and Price Below</h4>
                    <hr class="hrcolor">
                    <form action="/products/{{$product->service}}/All" method="GET">
                    <div class="filter-widget">
                     <h4 class="fw-title text-center text-lg-left">{{$product->category}} {{$product->service}} Brands</h4>
                        <div class="fw-brand-check brandOver">
                        @foreach($productBrands as $productBrand)
 <div class="bc-item ">   
     <label for="brand{{$productBrand->id}}">
     {{$productBrand->brand}}
         <input  type="checkbox" id="brand{{$productBrand->id}}" name="brandsFilter[]" value="{{$productBrand->brand}}">
         <span class="checkmark"></span>
     </label>
   
 </div>
 @endforeach 
                        </div>
                    </div>

                    <div class="filter-widget" style = "position:relative; top:-20px;">
                        <h4 class="fw-title text-center text-lg-left">Price</h4>
                        <div class="filter-range-wrap text-center text-lg-left">
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" name="priceMin" placeholder="100&#2547;">
                                   <span class="mr-4">To</span>
                                    <input type="text" name="priceMax" placeholder="200&#2547;">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-warning btn-block ">Filter</button>
                        </div>
                        <hr class="hrcolor">
                    </div>
                    </form>
                    
                    
                   
                    <div class="filter-widget">
                        <h4 class="fw-title text-center text-lg-left">Tags</h4>
                        <div class="fw-tags">
                            @foreach($globalTags as $globalTag)
                            <a href="/products/{{$product->service}}/All?tag={{$globalTag->tag}}">{{$globalTag->tag}}</a>
                            @endforeach
                           
                          
                        </div>
                    </div>
                </div>
  
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="{{asset('ProductImages')}}/{{$product->image_1}}" alt="Product Image">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    <div class="pt active" data-imgbigurl="{{asset('ProductImages')}}/{{$product->image_1}}"><img
                                            src="{{asset('ProductImages')}}/{{$product->image_1}}" alt=""></div>
                                    <div class="pt" data-imgbigurl="{{asset('ProductImages')}}/{{$product->image_2}}"><img
                                            src="{{asset('ProductImages')}}/{{$product->image_2}}" alt=""></div>
                                    <div class="pt" data-imgbigurl="{{asset('ProductImages')}}/{{$product->image_3}}"><img
                                            src="{{asset('ProductImages')}}/{{$product->image_3}}" alt="Product Image"></div>
                                  
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{$product->service}}</span>
                                    <h3>{{$product->name}}</h3>
                                   
                                </div>
                                <!-- <div class="pd-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span>(5)</span>
                                </div> -->
                                <div class="pd-desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur ing elit, sed do eiusmod tempor sum dolor
                                        sit amet, consectetur adipisicing elit, sed do mod tempor</p>
                                    <h4>{{$product->currentPrice}}&#2547;
                                        @if($product->previousPrice !== -1)
                                            <span>${{$product->previousPrice}}&#2547;</span>
                                            @endif</h4>
                                </div>
                                
                                @if($colorsArray !== "-1")
                                <div class="pd-color">
                                    <h6>Color</h6>
         
                      <div class="bc-item  "> 
                          
                          @foreach($colorsArray as $color)
                     <span style="background: #{{$color}}; color:#{{$color}};" class="colors" >col</span>
                     @endforeach
                         
                    
                    
                   
                  
                </div>
         </div>
         @endif  
         
          <!-- Choose Size  -->
        
                                <div class="pd-size-choose" >
                                @if($sizesArray !== "-1")
                          @foreach($sizesArray as $size)
                          <div class="sc-item">
                                        <input type="radio"  id="{{$size}}" >
                                        <label for="{{$size}}">{{$size}}</label>
                                    </div>
                     @endforeach
                          @endif  
          
                                </div>
           <!-- Choose Size End  -->
          
                              
                                <div class="quantity">
                                    <!--  If In Cart -->
                                @if($inCart == 'yes')
                                <div class="pro-qty">
                                    <span class="dec qtybtn">-</span>
                                        <input id="inCartQuantity" name="productQuantity" type="text" value="1">
                                    <span class="inc qtybtn">+</span>
                                    </div>
                                <a href="/shopping-cart" style="padding-top: 10px;"  class="btn btn-warning">View Cart</a>
                                <span class="mx-2" style="position: relative; top:12px"> or </span>
                                    
                                    <a id="inCartOrderThis"  style="padding-top: 10px;"  class="btn btn-warning">Order This Now</a>
                                    <script>
document.querySelector('#inCartOrderThis').addEventListener('click',()=>{
   let quantity = document.querySelector('#inCartQuantity').value;
   location.replace("/order-this-auth?" + "productId=" + {{$product->id}} + "&productQuantity=" + quantity );
   
})
                                    </script>
                                    <!-- If not In Cart -->
                                @else
                                <form action="{{route('addCart')}}" method="POST">
                               @csrf 
                                <input type="hidden" name="orderStatus" value="inCart">
                                <input type="hidden" name="orderId" value="-1">
                                <input type="hidden" name="productId" value="{{$product->id}}">
                                    <input type="hidden" name="productImage" value="{{$product->image_1}}">
                                    <input type="hidden" name="productName" value="{{$product->name}}">
                                    <input type="hidden" name="productPrice" value="{{$product->currentPrice}}">
                                    <div class="pro-qty">
                                    <span class="dec qtybtn">-</span>
                                        <input id="bothQuantity" name="productQuantity" type="text" value="1">
                                    <span class="inc qtybtn">+</span>
                                    </div>
                                    
                                    @auth
                                    <button type="submit" id="addToCart" onclick="addToCart()" class="btn btn-warning">Add To Cart</button>
                                    <span class="mx-2" style="position: relative; top:12px"> or </span>
                                    
                                    <a id="notInCartOrderThis"  style="padding-top: 10px;"  class="btn btn-warning">Order This Now</a>
                                    <script>
document.querySelector('#notInCartOrderThis').addEventListener('click',()=>{
   let quantity = document.querySelector('#bothQuantity').value;
   location.replace("/order-this-auth?" + "productId=" + {{$product->id}} + "&productQuantity=" + quantity );
   
})
                                    </script>
                                    @else
                                    <a href="/login" style="padding-top: 10px;"  class="btn btn-warning">Add To Cart</a>
                                    <span class="mx-2" style="position: relative; top:12px"> or </span>
                                    
                                    <a id="guest" style="padding-top: 10px;"  class="btn btn-warning">Order This Now</a>
                                    <script>
document.querySelector('#guest').addEventListener('click',()=>{
   let quantity = document.querySelector('#bothQuantity').value;
   location.replace("/order-this-guest?" + "productId=" + {{$product->id}} + "&productQuantity=" + quantity );
   
})
                                    </script>
                                    @endif

                                   
                                    @endif
                                    
                                    
                                </div>
                                </form>
                               
                               
                                <ul class="pd-tags">
                                    <li><span>CATEGORY</span>: {{$product->category}}</li>
                                    
                                </ul>
                                <div class="pd-share">
                                   
                                    <div class="p-code"><span class="font-weight-bold">Model: </span>{{$product->brand}}</div>
                                    <!-- <div class="pd-social">
                                        <a href="#"><i class="ti-facebook"></i></a>
                                        <a href="#"><i class="ti-twitter-alt"></i></a>
                                        <a href="#"><i class="ti-linkedin"></i></a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-3" role="tab">Comments </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-7 ">
                                                <!-- Description -->
                                                <h5>Introduction</h5>
                                                <p>{{$product->descriptionIntroduction}}</p>
                                                <h5>Features</h5>
                                                <p>{{$product->descriptionFeatures}}</p>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>
                                   <thead>
                                      
                                  
                                          
                                            <tr>
                                                <td class="p-catagory">Price</td>
                                                <td>
                                                    <div class="p-price">{{$product->currentPrice}}&#2547;</div>
                                                </td>
                                            </tr>
                                        
                                            @if($product->stock !== "-1")
                                            <tr>
                                                <td class="p-catagory">Availability</td>
                                                <td>
                                                    <div class="p-stock">{{$product->stock}} in stock</div>
                                                </td>
                                            </tr>
                                            @endif
                                          
                                            @if($sizesArray !== "-1")
                         
                         
                                    <tr>
                                                <td class="p-catagory">Size</td>
                                                <td>  <div class="p-size">
                                                @foreach($sizesArray as $size)
      <span>{{$size}}</span>
       @endforeach </div>
                                                </td>
                                            </tr>
                    
                          @endif  
                                          
                                           
                                            @if($colorsArray !== "-1")
                         
                     <tr>
                    <td class="p-catagory">Color</td>
                              <td>
                                                @foreach($colorsArray as $color)
                     <span style="background: #{{$color}}; color:#{{$color}};" class="colors" >col</span>
                     @endforeach
                              </td>
                    </tr>
                          @endif  
                                            
                                            <tr>
                                                <td class="p-catagory">Brand</td>
                                                <td>
                                                    <div class="p-code">{{$product->brand}}</div>
                                                </td>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                        <h4> Comments</h4>
                                        <input id="commentGetProductId" type="hidden" value="{{$product->id}}">
                                        <div class="comment-option">
                                            <div class="co-item">
                                                
                                                <div id="commentShow" class="avatar-text">
                                                   
                                                    <!-- <h5>Brandon Kelley <span>27 Aug 2019</span></h5>
                                                    <div class="at-reply">Nice !</div> -->
                                                </div>
                                            </div>
                                          
                                        </div>
                                       @auth
                                        <div class="leave-comment">
                                            <h4>Leave A Comment</h4>

                                            <form class="comment-form">
                                                
                                                <div class="row">
                                                <input type="hidden" id="commentProductId" value="{{$product->id}}">
                                                   <input type="hidden" id="commentName" value="{{ Auth::user()->name }}">
                                                    <div class="col-lg-12">
                                                        <textarea 
                                                        
                                                        required
                                                        id="commentComment" placeholder="Type your Comment"></textarea>
                                                        <a onclick="postComment()" class="site-btn">Comment</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        @endif
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
    @endforeach

    <!-- Related Products Section End -->
    @if($finalRelatedProducts[0] !== -1)
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
           
                @foreach($finalRelatedProducts as $relatedProduct)
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                        <a  href="/product/{{$relatedProduct['id']}}">
                            <img style="max-height:200px; max-width:200px" src="{{asset('ProductImages')}}/{{$relatedProduct['image_1']}}" alt="">
                            </a>
                            
                           
                            <ul>
                                
                                <li class="quick-view"><a href="/product/{{$relatedProduct['id']}}">+ Quick View</a></li>
                                <li class="w-icon">
                            </ul>
                        </div>
                        <a href="/product/{{$relatedProduct['id']}}">
                        <div class="pi-text">
                            <div class="catagory-name">{{$relatedProduct['category']}}</div>
                           
                                <h5>{{$relatedProduct['brand']}}</h5>
                            
                            <div class="product-price">
                                        {{$relatedProduct['currentPrice']}}&#2547;
                                            @if($relatedProduct['previousPrice'] !== -1)
                                            <span>{{$relatedProduct['previousPrice']}}&#2547;</span>
                                            @endif
                                           
                                        </div>
                        </div>
                        </a>
                    </div>
                </div>
                @endforeach
                @endif
               
              
            </div>
        </div>
    </div>
    <!-- Related Products Section End -->

    <!-- Partner Logo Section Begin -->
    <div class="partner-logo">
        <div class="container">
            <div class="logo-carousel owl-carousel">
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="/img/logo-carousel/logo-1.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="/img/logo-carousel/logo-2.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="/img/logo-carousel/logo-3.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="/img/logo-carousel/logo-4.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="/img/logo-carousel/logo-5.png" alt="">
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
                            <a href="#"><img src="/img/footer-logo.png" alt=""></a>
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
                            <img src="/img/payment-method.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

     <!-- Js Plugins -->
     <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/jquery.countdown.min.js"></script>
    <script src="/js/jquery.nice-select.min.js"></script>
    <script src="/js/jquery.zoom.min.js"></script>
    <script src="/js/jquery.dd.min.js"></script>
    <script src="/js/jquery.slicknav.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/my.js"></script>
    <!-- toaster cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
@if(Session::has('cart-added'))
<script>
    toastr.success("{!! Session::get('cart-added') !!}");
</script>
@endif
<script>
     
   
                                        </script>
   
</body>

</html>