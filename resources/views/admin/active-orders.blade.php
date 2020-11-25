<style>
     svg{
    height: 20px;
    width:  20px;
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
                    
                 
                     <li><a href="#">Add Product</a>
                     <ul class="dropdown">
                            @foreach($services as $service)
                            <li><a href="/admin-panel/add-product/{{$service->service}}">{{$service->service}}</a></li>
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
                       
                        <li class="active"><a href="/admin-panel/active-orders">Active Orders </a>  
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



 
    <!-- Section for brand -->
    <section style="margin-top: 13rem;">
        <div class="container">
            <div class="row">
                <div class="col-12">
<div class="card">
    <div class="card-header text-center">
        <h3>Active Orders</h3>
     
    </div>

    <div class="card-body">
    @if(Session::has('order-completed'))
        <div class="alert alert-success" role="alert">{{Session::get('order-completed')}}</div>
        @endif
    @if(Session::has('order-canceled'))
        <div class="alert alert-success" role="alert">{{Session::get('order-canceled')}}</div>
        @endif
        <div class="table-responsive">
     <table class="table table-striped">
         <thead>
             <tr>
                 <th>Id</th>
                 <th>Name</th>
                 <th>Phone</th>
                 <th>Address</th>
                 <th>Message</th>
                 <th>Time</th>
                 <th>Actions</th>

             </tr>
         </thead>
         <tbody>
             @foreach($orders as $order)
<tr>
<td style="width:1px;">{{$order->id}}</td>
    <td style="width:1px;">{{$order->userName}}</td>
    <td style="width:1px;">{{$order->userPhone}}</td>
    <td>{{$order->userAddress}}</td>
    <td style="width:360px;">{{$order->userMessage}}</td>
    <td>{{$order->created_at}}</td>
  
   
    <td style="width:1px;">
    <a href="/admin-panel/view-order/{{$order->id}}" class="btn btn-info">View</a> <br>
        <a href="/admin-panel/complete-order/{{$order->id}}" class="btn btn-success">Complete</a> <br>
        <a href="/admin-panel/cancel-order/{{$order->id}}" class="btn btn-danger">Cancel</a>
        </td>
  
</tr>
             @endforeach
         </tbody>
     </table>
     </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-8 text-center mx-auto  my-3">
        {{$orders->links()}}
        </div>
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