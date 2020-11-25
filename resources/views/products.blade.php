<style>
    .myActive{
        background: #e7ab3c;
    }
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
svg{
    height: 20px;
    width:  20px;
}
.phpActive{
    background-color: #e7ab3c;
    padding: 0 .5rem;
    
    
}
</style>
<x-html-head/>

      <!-- Header Section Begin -->
   <x-header/>
   <nav class="nav-menu mobile-menu">
                    <ul>
                        <li><a href="/">Home</a></li>
                      
                        <li ><a class="myActive" href="#" >Shop</a>
                            <ul class="dropdown">
                            @foreach($services as $service)
                            <li><a
                            @if($service->service == $serviceType)
                   class="myActive"
                 @endif
                            href="/products/{{$service->service}}/All">{{$service->service}}</a></li>
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
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <p class="d-inline-block">Shop ></p> <span>{{$serviceType}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                 <div class="filter-widget">
            <h4 class="fw-title text-center text-lg-left">Collections</h4>
        <ul class="filter-catagories text-center text-lg-left">
             @foreach($services as $service)
            
             <li><a 
             @if($service->service == $serviceType)
             class="phpActive"
             @endif
             href="/products/{{$service->service}}/All">{{$service->service}}</a></li>
             @endforeach
                        
                           
                        </ul>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title text-center text-lg-left">{{$serviceType}} Categories</h4>
                       
                        <ul class="filter-catagories text-center text-lg-left">
                        <li><a
                        @if($serviceCategory == "All")
                        class="phpActive"
                      @endif
                        href="/products/{{$serviceType}}/All">All</a></li>
                            @foreach($productCategories as $productCategory)
                            <li><a
                            @if($productCategory->category == $serviceCategory)
                            class="phpActive"
                            @endif
                            href="/products/{{$serviceType}}/{{$productCategory->category}}">{{$productCategory->category}}</a></li>
                            @endforeach
                          
                           
                        </ul>
                    </div>
                    <!--@@@@@@@@@@@@@ Form @@@@@@@@@@@ -->
                    <h4 class="text-center py-1" style="background-color: #ddd;">Filter Brands and Price Below</h4>
                    <hr class="hrcolor">
                    <form action="/products/{{$serviceType}}/{{$serviceCategory}}" method="GET">
                    <div class="filter-widget">
                     <h4 class="fw-title text-center text-lg-left">{{$serviceCategory}} {{$serviceType}} Brands</h4>
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
                            <a href="/products/{{$serviceType}}/All?tag={{$globalTag->tag}}">{{$globalTag->tag}}</a>
                            @endforeach
                           
                          
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    
                    <div class="product-show-option">
                       <div class="row">
                            <div class="col-md-6">
                                <h5>{{$searchCriteria}}</h5>
                            </div>
                            @if($request !== "nothing")
                            <div class="col-md-6">
                                <a href="/products/{{$serviceType}}/{{$serviceCategory}}" class="btn btn-info">Remove Filter</a>
                            </div>
                            @endif
                         
                            </div>
                            
                    </div>
                    <div class="product-list">
                        <div class="row">
                            @if(count($products) == 0)
<h3 class="text-center">Sorry! No result found </h3>
@endif
                           
                            @foreach($products as $product)
                           
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                    <a   href="/product/{{$product->id}}">
                                        <img style="max-height:200px; max-width:200px" src="{{asset('ProductImages')}}/{{$product->image_1}}" alt="Product Image">
                                         </a>
                                        
                                       
                                        <ul>
                                            
                                            <li class="quick-view"><a  href="/product/{{$product->id}}">+ Quick View</a></li>
                                            
                                        </ul>
                                    </div>
                                    <a  href="/product/{{$product->id}}">
                                    <div class="pi-text">
                                        <div class="catagory-name">
                                            {{$product->category}}
                                        </div>
                                            <h5>{{$product->brand}}</h5>
                                      
                                        <div class="product-price">
                                        {{$product->currentPrice}}&#2547;
                                            @if($product->previousPrice !== -1)
                                            <span>{{$product->previousPrice}}&#2547;</span>
                                            @endif  
                                        </div>
                                       
                                    </div>
                                    </a>
                                </div>
                            </div>
                            
                            @endforeach
                        
                           
                           
                        </div>
              @if($request == "nothing")
            <div class="text-center">  
             {{ $products->links() }}
            </div>  
            @endif  
            
            @if($checkBrandfilters == "nothing" && $request == "yes")
            <div class="text-center">  
             {{ $products->appends(['priceMin' => $priceMin,'priceMax' => $priceMax])->links() }}
            </div>  
            @endif
            @if($checkBrandfilters == "yes" && $request == "yes")
            <div class="text-center">  
             {{ $products->appends(['brandsFilter'=>$brandfilters,'priceMin' => $priceMin,'priceMax' => $priceMax])->links() }}
            </div>   
            @endif
            @if($tagSet == "yes" && $request == "yes")
            <div class="text-center">  
             {{ $products->appends(['tag'=>$tagSearch])->links() }}
            </div>   
            @endif         
                      
                  
   
                       
                        
                       
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

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
</body>

</html>