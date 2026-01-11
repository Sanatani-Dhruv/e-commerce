<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		@if (isset($status) && $status)
			<title>{{ $detail_object->product_name }} - {{ config('app.name') }}</title>
		@else
			<title> Error Fetching Data - {{ config('app.name') }}</title>
		@endif
		<link rel="icon" href="/images/logo-monodark.png">
		<link rel="stylesheet" href="/css/header.css" media="all">
		<link rel="stylesheet" href="/css/general.css" media="all">
		<link rel="stylesheet" href="/css/login.css" media="all">
		<link rel="stylesheet" href="/css/user-page.css" media="all">
		<link rel="stylesheet" href="/css/footer-part.css" media="all">
		<link rel="stylesheet" href="/css/store-page-general.css" media="all">
		<link rel="stylesheet" href="/css/store-page-single.css" media="all">
		<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
	</head>
	<body id="body" class="body dark">
		{{ view('parts.header') }}
		@if (isset($status) && $status)
			<div class="pathline-container">
				<div class="pathline">
					<a class="home-link" href="/">
						<span class="home">Home</span>
					</a>
					<span class="path-arrow">&#x3E;</span>
					<a class="home-link" href="/products">
						<span class="home">Products</span>
					</a>
					<span class="path-arrow">&#x3E;</span>
					<span class="current-location">{{ $detail_object->product_name }}</span>
				</div>
			</div>
			<main class="main-container">
				<div class="product-container-1">
					<div class="product-left-part-container">
						<div class="product-image-container">
							<img class="product-image" src="{{ $detail_object->product_imagepath }}" alt="{{ $detail_object->product_name }}">
						</div>
					</div>
					<div class="product-right-part-container">
						<div class="product-right-part">
							<div class="product-showcase-title">
								<h2>
									{{ $detail_object->product_name }}
								</h2>
							</div>
							<div class="product-showcase-sdesc">
								<h4>
									{{ $detail_object->product_shortdesc }}
								</h4>
							</div>
							<hr class="product-page-hr">
							<div class="product-showcase-price"><sup>₹</sup> {{ $detail_object->product_price }}</div>
							<div class="product-showcase-stock">
								<strong>Stock:</strong> {{ $detail_object->product_stock }}
								<div class="product-showcase-post-stock-message {{ ($stock_status)? 'true' : 'false' }}">{{ $stock_message }}</div>
							</div>
							<form action="/user.php#cart" method="post">
								<input type="hidden" id="type" name="type" value="hardware">
								<div class="product-showcase-btns-container">
									<div class="product-showcase-how-much-addcart">
										Quantity: <input name="quantity" class="product-showcase-how-much-addcart-input" value="1" min="1" max="{{ $detail_object->product_stock }}" type="number">
									</div>
									<div class="product-showcase-addcart-btn-container">
										<button name="product-id" value="{{ $detail_object->product_id }}" class="product-showcase-addcart-btn login-btn submit {{ ($stock_status)? 'true' : 'false' }}">Add To Cart</button>
										<br>
										<a class="cart-product-btn-link" href="/products">
											<div class="cart-product-btn login-btn submit product-page-cart-btn">
												View Cart
											</div>
										</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="product-container-2">
					<div class="product-ldesc-container" style="white-space: pre-line">
						<h3 class="ldesc-title">Product Description</h3>
						{{ $detail_object->product_longdesc }}
					</div>
				</div>
			</main>
		@else
			<main class="main-container">
				<h2 style="margin-bottom: 1.4rem;">Error Fetching Data:</h2>
				@if (isset($error_array))
					@foreach ($error_array as $value)
						<h5 style="font-size: 1.2rem;font-weight: 400;">
							> {{ $value }}
						</h5>
					@endforeach
				@endif
			</main>
		@endif
		{{ view('parts.footer') }}
		<script src="/js/base.js"></script>
	</body>
</html>
