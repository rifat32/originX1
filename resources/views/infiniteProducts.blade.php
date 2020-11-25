@foreach($products as $product)
                           
                           <div class="col-lg-3 col-sm-6">
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