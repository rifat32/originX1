      <!--If logged In Show Shopping Cart  -->
      @auth
<li class="bg-primary mr-2"><a href="#">Cart and Orders</a>
                            <ul class="dropdown">
                                
                                <li><a href="/shopping-cart">Shopping Cart</a></li>
                                <li><a href="/check-out">Place Order</a></li>
                                <li><a href="/active-orders">Active Orders</a></li>
                            </ul>
                        </li>
       @endif   
       <!--If logged In Show Profile  -->          
            @auth
          
                <li class='bg-primary'><a href="#">{{ Auth::user()->name }}</a>
                        <ul class="dropdown">
                            <li><a href="{{ route('profile.show') }}">{{ __('Profile') }}</a></li>
                            <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li>
<a href="{{ route('logout') }}"onclick="event.preventDefault();this.closest('form').submit();">{{ __('Logout') }}</a>
                            </li>
                        </form>
                        </ul>
                    </li>
                      <!--If logged In Show Login or Register  -->  
                    @else
                  <li><a href="{{ route('login') }}">Login</a></li>
                        
                  <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                </ul>
           
                </nav>
<div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>