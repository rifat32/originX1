               
  <x-html-head/>
  

    <!-- Header Section Begin -->
   <x-header/>
   <nav  class="nav-menu mobile-menu">
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

    <!-- Hero Section Begin -->
  <x-hero/>
    <!-- Hero Section End -->
    <div class="container">
  <div class="row">
  <div class="col-12">
  <h2 class="text-center">See our products  </h2>
  <div class="d-flex justify-content-center my-3">
  @foreach($services as $service)
    <a class="btn btn-warning mr-2" href="/products/{{$service->service}}/All">{{$service->service}}</a>
                            @endforeach
  </div>
  
  </div>
  </div>


  <div class="row" id="post-data">
  @include('infiniteProducts')
  </div>
 
  </div>
  <div class="ajax-load text-center" style="display: none;">
<p><img src="/gif.gif" alt="">Loading more products</p>
  </div>
  

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
    <script>
       
       function loadMoreData(page){
$.ajax({
   url:'?page='+ page,
   type:'get',
   beforeSend: function(){
       $('.ajax-load').show();
 }
   
})
.done(function(data){
if(data.html == "" ){
   $('.ajax-load').html('no more records');
   return;
}
$('ajax-load').hide();
$('#post-data').append(data.html);
})
.fail(function(jqXHR, ajaxOptions,thrownError){
alert('server not responding');
})
       }
       var page = 1;
       $(window).scroll(function(){
           if($(window).scrollTop() + $(window).height() >= $(document).height()){
               page++;
               loadMoreData(page);

           }
       })
   </script>
   
</body>

</html>

          