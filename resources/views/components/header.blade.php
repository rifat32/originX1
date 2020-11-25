<header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        drrifatalashwad0@gmail.com
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        +8801771034383
                    </div>
                </div>
                <div class="ht-right">
                   
                
                    <div class="top-social">
                        <a target="_blank" href="https://www.facebook.com/Real-Web-Developer-104162748159942"><i class="ti-facebook"></i></a>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="/">
                                <img src="/img/logo/ORIGINX1.png" alt="logo" width="90%">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                    
                        <div class="advanced-search">
                            <button  type="button" class="category-btn">All Categories</button>
                            <div class="input-group">
                                <form action="{{route('search')}}" method="POST">
                                    @csrf
                                <input style="font-weight: bold; color:black;" name="search" type="text" placeholder="What do you need?">
                                <button class="d-xm-none d-md-block" type="submit"><i class="ti-search"></i></button>
                                </form>
                            </div>
                        </div>
                     @if(Session::has('nothing-found'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('nothing-found')}}</div> 
                     @endif
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li style="visibility: hidden;" class="heart-icon">
                                <a href="#">
                                    <i class="icon_heart_alt"></i>
                                    <span>1</span>
                                </a>
                            </li>
                            @auth
                            <li class="cart-icon">
                                <a href="#">
                                    <i class="icon_bag_alt"></i>
                                    <span>{{$carts}}</span>
                                </a>
                                <div style="max-height: 30rem; overflow-x:hidden; overflow-y:scroll;" class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody id="headerCart">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="totalIndex" class="select-total">
                                        
                                    </div>
                                    <div class="select-button">
                                        <a href="/shopping-cart" class="primary-btn view-card">VIEW CARD</a>
                                        <a href="/check-out" class="primary-btn checkout-btn">Place Order</a>
                                    </div>
                                </div>
                          </li>
                          
                            <li class="cart-price">{{$personCart[0]->total}}&#2547;</li>
                            @else
                            <li style="visibility: hidden;" class="cart-icon">
                                <a href="/shopping-cart">
                                    <i class="icon_bag_alt"></i>
                                    <span>0</span>
                                </a>
                               
                            </li>
                            <li style="visibility: hidden;" class="cart-price">0&#2547;</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="navbar" class="nav-item">
            <div class="container">
     

            
              