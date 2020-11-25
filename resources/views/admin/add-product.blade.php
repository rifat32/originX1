<style>
    .myActive{
        background: #e7ab3c;
    }
   
</style>
<x-html-head/>

  <!-- Header Section Begin -->
  <header class="header-section">
 
        <div id="navbar" class="nav-item">
            <div class="container">
              
            
              
   <nav class="nav-menu mobile-menu">
   <ul class="d-flex flex-wrap">
                    <li ><a href="/admin-panel">Admin Panel</a></li>
                    <li><a href="/admin-panel/add-service">Add Service</a> 
                        </li>
                 <li><a href="/admin-panel/admin-view-services">View Services</a> 
                        </li>
                        <li><a href="/admin-panel/add-product-category">Add Product Category</a>
                    
                    </li>
                    <li><a href="#">View Product Categories</a>
                    <ul class="dropdown">
                            @foreach($services as $service)
                            <li><a href="/admin-panel/admin-view-categories/{{$service->service}}">{{$service->service}}</a></li>
                            @endforeach
                        
                            </ul>
                </li>
                    
                 
                     <li><a class="myActive" href="#">Add Product</a>
                     <ul class="dropdown">
                            @foreach($services as $service)
                            <li><a
                            @if($service->service == $serviceType)
                   class="myActive"
                 @endif
                            href="/admin-panel/add-product/{{$service->service}}">{{$service->service}}</a></li>
                            @endforeach
                        
                            </ul>
                    </li>
                    <li><a href="#">View Products</a>
                     <ul class="dropdown">
                            @foreach($services as $service)
                            <li><a href="/admin-panel/view-products/{{$service->service}}">{{$service->service}}</a></li>
                            @endforeach
                        
                            </ul>
                    </li>
                    <li><a href="/admin-panel/all-products">All Products</a>  
                        </li>
                    
                     <li><a href="/admin-panel/add-global-tags">Add Global Tag</a>  
                        </li>
                        <li><a href="#">View Global Tags</a>  
                        <ul class="dropdown">
                            @foreach($services as $service)
                            <li><a href="/admin-panel/admin-view-tags/{{$service->service}}">{{$service->service}}</a></li>
                            @endforeach
                        
                            </ul>
                        </li>
                       
                        <li><a href="/admin-panel/active-orders">Active Orders </a>  
                        </li>
                        <li><a href="/admin-panel/completed-orders">Completed Orders </a>  
                        </li>
                        <li><a href="/admin-panel/messages">Messages</a>  
                        </li>
                   
                     <li>
                 <form method="POST" action="{{ route('admin.logout') }}">
                         @csrf
                         <li>
<a href="{{ route('admin.logout') }}"onclick="event.preventDefault();this.closest('form').submit();">Admin Logout</a>
                         </li>
                     </form>
                  </li>
                </ul>
           
                </nav>
<div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>    
    <!-- Header End -->


       
     
 <!-- Admin Header End -->
    <section style="margin-top: 13rem;">
        <div class="container">
            <div class="row">
                <div class=" col-md-6 offset-md-3">
<div class="card">
    <div class="card-header text-center">
     <h3>  Add {{$serviceType}} Product </h3>  
    </div>

    <div class="card-body">
        @if(Session::has('product-added'))
        <div class="alert alert-success" role="alert">{{Session::get('product-added')}}</div>
        @endif
      
        <form action="{{route('product.store')}}" method="POST"  enctype="multipart/form-data">
    @csrf 
    <input  type="hidden" name="service" value="{{$serviceType}}"> 
    <div class="form-group">
        <lebel for="name">Product Name (Required)</lebel>
        <input required type="text" id="name" name="name" class="form-control">
    </div>
    <div class="form-group">
        <lebel for="descriptionIntroduction">Product Description Introduction (Required)</lebel>
        <textarea required name="descriptionIntroduction" class="form-control" id="descriptionIntroduction"  rows="4"></textarea>
    </div>
    <div class="form-group">
        <lebel for="descriptionIntroduction">Product Description Features (Required)</lebel>
        <textarea required name="descriptionFeatures" class="form-control" id="descriptionFeatures"  rows="4"></textarea>
    </div>
    <div class="form-group">
        <lebel for="currentPrice">Current Price (Required)</lebel>
        <input required type="text" name="currentPrice" id="currentPrice"  class="form-control">
    </div>
    <div class="form-group">
        <lebel for="previousPrice">Previous Price (Optional only if exists)</lebel>
        <input type="text" name="previousPrice" id="previousPrice"  class="form-control">
    </div>
    <div class="form-group">
        <lebel for="img1">Image 1 (Required)</lebel>
        <input required type="file" name="img1" class="form-control">
    
    </div>
    <div class="form-group">
        <lebel for="img2">Image 2 (Required)</lebel>
        <input required type="file" name="img2" class="form-control">
    </div>
    <div class="form-group">
        <lebel for="img3">Image 3 (Required)</lebel>
        <input required type="file" name="img3" class="form-control">
    </div>
    
     
    <div class="form-group">
        <lebel for="productCategory">Choose Product Category Default is now {{$productCategories[0]->category}}</lebel> 
        <select id="productCategory" name="productCategory" class="form-control">
            @foreach($productCategories as $productCategory)
            <option value="{{$productCategory->category}}">{{$productCategory->category}}</option>
            @endforeach       
</select>
    </div>
    <div class="form-group">
        <lebel for="productBrand">Choose Product Brand (Required)</lebel> 
        <input required type="text" name="productBrand" id="productBrand"  class="form-control">
    </div>
    <div class="form-group">
        <lebel for="tags">Product Tags (Required) </lebel>
        <textarea required name="tags" class="form-control" id="tags"  rows="2"></textarea>
    </div>
    <div class="form-group">
        <lebel for="stock">Stock (Optional)</lebel>
        <input type="text" name="stock" id="stock"  class="form-control">
    </div>
    <div class="form-group">
        <lebel for="sizes">Sizes (Optional) Write with space in between</lebel>
        <input type="text" name="sizes" id="sizes"  class="form-control">
    </div>
    <div class="form-group">
        <lebel for="colors">Colors (Optional) Write with space in between and hex color without #</lebel>
        <input type="text" name="colors" id="colors"  class="form-control">
    </div>
    <div class="form-group">
        <lebel for="ids">choose custom id. (heigher ids will be displayed first) Required</lebel> 
        <input required type="text" name="ids" id="ids"  class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
</div>

            </div>
            </div>
        </div>
    </section>


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

</body>

</html>