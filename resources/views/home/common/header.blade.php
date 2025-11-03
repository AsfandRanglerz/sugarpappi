  <!-- Spinner Start -->
  <?php
  $userId = Auth::guard('user')->id();
  {{--  $notifications = App\Models\Order::where('user_id', $userId)
      ->where('status', 'Order Ready')->where('status', 'Delivered')
      ->where('seen', '0')
      ->get();  --}}
      $notifications = App\Models\Order::where('user_id', $userId)
      ->where(function ($query) {
          $query->where('status', 'Order Ready')
                ->orWhere('status', 'Delivered');
      })
      ->where('seen', '0')
      ->get();
  ?>
  <div id="spinner"
      class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner-border text-dark" style="width: 3rem; height: 3rem;" role="status">
          <span class="sr-only">Loading...</span>
      </div>
  </div>
  <!-- Spinner End -->

    <!-- Disclaimer Modal Start -->
    <div class="modal fade" id="disclaimerModal" tabindex="-1" aria-labelledby="disclaimerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="mb-0 text-danger"><strong>Disclaimer!</strong> Some of our products are made with
                        ingredients that may contain Nuts, Soy, Gluten And/Or Wheat. If you have any allergies, please
                        let us know</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Disclaimer Modal End -->

  <!-- Navbar & Hero Start -->
  <nav class="navbar navbar-expand-lg navbar-dark px-4 px-lg-5 py-lg-0 py-2">
      <div>
          <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
              <span class="fa fa-bars"></span>
          </button>
          <a href="{{ route('index') }}" class="navbar-brand p-0">
              <!-- <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Restoran</h1> -->
              <img src="{{ asset('public/img/logo.png') }}" alt="Logo">

          </a>
      </div>
      <div class="d-lg-none">
          {{-- <a class="me-2 btn-primary text-white py-1 px-2 rounded" type="button" data-bs-toggle="modal" data-bs-target="#disclaimerModal">Disclaimer</a> --}}
          <span class="fa fa-search me-2 header-icon open-btn"></span>
          <a href="" class="fa fa-shopping-cart position-relative header-icon"><span
                  class="badge cart-counter cart-counter-1"></span></a>
          @if (Auth::guard('user')->check())
              <div class="d-inline nav-item dropdown">
                  <a href="#" class="d-inline nav-link p-0" data-bs-toggle="dropdown"><span
                          class="fa fa-bell ms-3 position-relative header-icon"><span
                              class="badge bell-counter">{{ count($notifications) }}</span></span>
                  </a>
                  <div class="mobile-notify-block dropdown-menu py-3 px-0">
                      <div class="border-bottom pb-3 px-3">
                          <h5 class="m-0">Notifications ({{ count($notifications) }})</h5>
                      </div>
                      <div class="notify-block scrollable">
                          @if ($notifications->isEmpty())
                              <div class="card">
                                  <div class="card-body text-center">
                                      <a href="#">No Result Found!</a>
                                  </div>
                              </div>
                          @else
                              @foreach ($notifications as $notification)
                                  <div class="card">
                                      <div class="card-body">
                                          <a href="" class="markAsRead"
                                              data-notification-id="{{ $notification->id }}">
                                              {{--  Your Order #{{ $notification->code }} is Ready!  --}}
                                              Your Order #{{ $notification->code }} {{ $notification->status }}
                                          </a>
                                      </div>
                                  </div>
                              @endforeach
                          @endif
                      </div>
                  </div>
              </div>
          @endif
      </div>
      <div class="collapse navbar-collapse d-none" id="navbarCollapse">
          <div class="navbar-nav ms-auto py-0 pe-xl-4 pe-3">
              <a href="{{ route('index') }}"
                  class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
              <a href="{{ route('get-our-gallery') }}"
                  class="nav-item nav-link {{ request()->is('get-our-gallery') ? 'active' : '' }}">EXPLORE Sugar Pappi GALLERY</a>
              {{-- <a href="{{ route('get-new-sea-moss') }}"
                  class="nav-item nav-link {{ request()->is('get-new-sea-moss') ? 'active' : '' }}">Guide Video</a> --}}
              {{-- <a href="{{ route('get-our-menu') }}" class="nav-item nav-link {{ request()->is('get-our-menu') ? 'active' : '' }}">ORDER ONLINE</a> --}}
              @if (Auth::guard('user')->check())
                  <a href="{{ route('my-order') }}"
                      class="nav-item nav-link {{ request()->is('my-order') ? 'active' : '' }}">My Orders</a>
              @endif
          </div>
          <span class="fa fa-search header-icon open-btn"></span>
          @if (Auth::guard('user')->check())
              <a href="{{ route('my-profile') }}"
                  class="fa fa-user header-icon mx-xl-3 nav-item nav-link {{ request()->is('my-profile') ? 'active' : '' }}"></a>
              {{-- @endif --}}
              <div class="@if (!Auth::guard('user')->check()) ms-3 @endif nav-item dropdown">
                  <a href="#" class="nav-link p-0" data-bs-toggle="dropdown"><span
                          class="fa fa-bell me-3 position-relative header-icon"><span
                              class="badge bell-counter">{{ count($notifications) }}</span></span>
                  </a>
                  <div class="carting-card dropdown-menu py-3 px-0">
                      <div class="border-bottom pb-3 px-3">
                          <h5 class="m-0">Notifications ({{ count($notifications) }})</h5>
                      </div>
                      <div class="notify-block scrollable">

                          @if ($notifications->isEmpty())
                              <div class="card">
                                  <div class="card-body text-center">
				      <p class="text-danger text-center">No Result Found!</p>
                                  </div>
                              </div>
                          @else
                              @foreach ($notifications as $notification)
                                  <div class="card">
                                      <div class="card-body">
                                          <a href="" class="markAsRead"
                                              data-notification-id="{{ $notification->id }}">
                                              {{--  Your Order #{{ $notification->code }} is Ready!  --}}
                                              Your Order #{{ $notification->code }} {{ $notification->status }}
                                          </a>
                                      </div>
                                  </div>
                              @endforeach
                          @endif
                      </div>
                  </div>
              </div>
          @endif
          <div class="ms-2 nav-item dropdown">
              <a href="#" class="nav-link p-0" data-bs-toggle="dropdown"><span
                      class="fa fa-shopping-cart me-3 position-relative header-icon"><span
                          class="badge cart-counter cart-counter-1"></span></span>
              </a>
              <div class="carting-card dropdown-menu py-3 px-0">
                  <div class="border-bottom mb-1 pb-3 px-3">
                      <h5 class="m-0">Your Cart (<span class="cart-counter-1"></span>)</h5>
                  </div>
                  <div class="cards-parent scrollable">
                      @forelse (session('cart', []) as $item)
                          <div id="{{ $item['product_id'] }}carted"
                              class="carting-child px-3 mt-3 d-flex justify-content-between pb-3 border-bottom">
                              <img src="{{ asset($item['image']) }}" alt="">
                              <div class='content'>
                                  <div class="d-flex cart-input-parent justify-content-between">
                                      <h6 class="m-0">{{ $item['name'] }} <span style="font-size:12px">{{ $item['size'] ? '(' . $item['size'] . ')' : '' }}</span></h6>
                                      <h6 class="m-0 total-price">
                                          £{{ floatval($item['price']) * intval($item['quantity']) }}</h6>
                                      <p class="product-price d-none">{{ floatval($item['price']) }}</p>
                                  </div>

                                  @if ($item['toppings_by_category'])
                                            <h6>Toppings</h6>
                                            @foreach ($item['toppings_by_category'] as $categoryId => $toppingIds)
                                                @php
                                                    $categories = App\Models\Category::where('id' ,$categoryId)->get();
                                                    @endphp
                                                    @foreach ($categories as $category )
                                                    @if ($category)
                                                <div class='mb-2'>
                                                    <p class="category-name  mb-1 fw-bold pb-1 text-black">{{ $category->name }}</p>
                                                    @foreach ($toppingIds as $toppingId)
                                                        @php
                                                            $topping = App\Models\Topping::find($toppingId);
                                                        @endphp
                                                        @if ($topping)
                                                            <p class="small m-0">
                                                                {{ $topping->name }}
                                                            </p>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                    @endif

                                                    @endforeach
                                            @endforeach
                                        @endif
                                  <div class="cart-btn">
                                      <button class="btn p-0 decrement-btn"
                                          data-product-id="{{ $item['product_id'] }}, {{ $item['variant_id'] ?? null }}">-</button>
                                      <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                          class="increment-input cart-input cart_input text-center">
                                      <button class="btn p-0 increment-btn"
                                          data-product-id="{{ $item['product_id'] }}, {{ $item['variant_id'] ?? null }}">+</button>
                                      <p id="{{ $item['product_id'] }}" class="d-none sibling-p"></p>
                                  </div>
                              </div>
                          </div>
                      @empty
                          <p class="text-danger text-center">Your cart is empty!</p>
                      @endforelse
                  </div>
                  <div class="pt-3 border-top mt-1 text-center">
                      @if (count(session('cart', [])) > 0)
                          <a href="{{ route('my-cart') }}" class="btn btn-danger px-5">Continue To Cart</a>
                      @else
                          <a href="{{ route('my-cart') }}"
                              class="btn btn-danger disabled px-5 button-disable">Continue To Cart</a>
                      @endif
                  </div>
              </div>
          </div>
          @if (Auth::guard('user')->check())
              <a href="{{ route('user-logout') }}" class="btn btn-primary py-2 px-4" id="logout">Logout</a>
          @else
              <a href="{{ asset('login') }}" class="btn btn-primary py-2 px-4">Login</a>
          @endif
      </div>
  </nav>
  <!-- Overlay Search Start -->
  <div id="myOverlay" class="overlay">
      <span class="close-btn" title="Close Overlay">×</span>
      <div class="overlay-content">
          <form action="{{ route('product.search') }}" method="GET" class="mb-0">
              <input type="text" placeholder="Search Your Favorite Food ..." name="search">
              <button type="submit" class="btn btn-primary" style="border: none;border-radius: 0"><span class="fa fa-search"></span></button>
          </form>
      </div>
  </div>
  <!-- Overlay Search End -->

  <!-- Navbar & Hero End -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
      $(document).ready(function() {
          $(document).on('click', '.increment-btn', function() {
            var inputField = $(this).siblings('.increment-input');
            var quantity = parseInt(inputField.val());
            inputField.val(quantity + 1);
              var productData = $(this).data('product-id').split(',');
            var productId = productData[0].trim();
            var variantId = productData[1] ? productData[1].trim() : null;
            helper(true);
            updateServerCart(productId, variantId, quantity + 1);
            let b = $(this).closest('.carting-child');
            let d = b.find('.product-price').text();
            let c = b.find(".total-price").text('$' + (parseFloat(Number(d) * (quantity + 1)).toFixed(2)));
        });

        $(document).on('click', '.decrement-btn', function() {
            var inputField = $(this).siblings('.increment-input');
            var quantity = parseInt(inputField.val());
            if (quantity > 1) {
                inputField.val(quantity - 1);
                var productData = $(this).data('product-id').split(','); // Splitting product_id and variant_id
                var productId = productData[0].trim();
                var variantId = productData[1] ? productData[1].trim() : null;
                helper(false);
                updateServerCart(productId, variantId, quantity - 1);
                let b = $(this).closest('.carting-child');
                let d = b.find('.product-price').text();
                let c = b.find(".total-price").text('$' + (parseFloat(Number(d) * (quantity - 1)).toFixed(2))  )          ;
            }
        });
        function updateServerCart(productId, variantId, quantity) {
            $.ajax({
                type: 'POST',
                url: '{{ route('update.cart') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'product_id': productId,
                    'variant_id': variantId,
                    'quantity': quantity,
                },
                success: function(data) {
                    // Handle the success response, e.g., update UI
                    console.log('Cart updated successfully:', data);
                },
                error: function(error) {
                    // Handle the error response, e.g., show an error message
                    console.error('Error updating cart:', error);
                }
            });
        }
          function helper(c) {
              let a = 0;
              $('.cart-input').each(function() {
                  a += parseInt($(this).val());
              });
              if (!a) {
                  $('.cart-counter-1').each(function() {
                      let b = $(this).text();
                      b = parseInt(b);
                      if (!b) {
                          $(this).text(0);
                          return;
                      }
                      if (c) {
                          b++;
                      } else {
                          b--;
                      }
                      $(this).text(b);
                  });
                  return;
              }
              $('.cart-counter-1').each(function() {
                  $(this).text(a);
              })

          }

          function updateCartCounter() {
              var cartItemCount = 0;
              @foreach (session('cart', []) as $item)
                  cartItemCount += {{ $item['quantity'] }};
              @endforeach
              $('.cart-counter-1').text(cartItemCount);
          }
          helper();
      });

      $(document).ready(function() {
          $('.markAsRead').on('click', function(e) {
              e.preventDefault();
              var id = $(this).data('notification-id');

              // Store the reference to the clicked item for removal
              var clickedItem = $(this);

              $.ajax({
                  url: '{{ route('markAllAsRead') }}',
                  method: 'GET',
                  data: {
                      id: id,
                  },
                  success: function() {

                      clickedItem.remove();

                      // Update the notification counter
                      var notificationCounter = $('#notificationCounter');
                      notificationCounter.text(parseInt(notificationCounter.text()) - 1);

                      window.location.href = '{!! route('my-order') !!}';

                  },
                  error: function(xhr, status, error) {
                      console.error('Error marking notifications as seen:', error);
                  }
              });
          });
      });
  </script>
