<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Products - IT Sales and Services Website</title>
		<link rel="icon" href="images/logo-monodark.png">
		<link rel="stylesheet" href="css/header.css" media="all">
		<link rel="stylesheet" href="css/general.css" media="all">
		<link rel="stylesheet" href="css/footer-part.css" media="all">
		<link rel="stylesheet" href="css/store-page-general.css" media="all">
		<link rel="stylesheet" href="css/store-page-items.css" media="all">
	</head>
	<body id="body" class="body dark">
		{{ view('parts.header') }}
		<div class="pathline-container">
			<div class="pathline">
				<a class="home-link" href="\">
					<span class="home">Home</span>
				</a>
				<span class="path-arrow">&#x3E;</span>
				<span class="current-location">Products</span>
			</div>
		</div>
		<main class="main-container">
			<div class="products-container">
				<h2 class="products-category-title">
					Hardware
				</h2>
				<div class="product-listing">
					@foreach ($product_object as $object)
						<div class='hardware-element-container hardware-element-'>
							<div class='hardware-element-1 hardware-img-container'>
								<img class="hardware-img" src="{{ $object->product_imagepath }}" alt="Hardware-image">
							</div>
							<div class="hardware-element-2-container">
								<div class="hardware-element-2 hardware-text-container">
									<div class='hardware-element-title hardware-element-1'>{{ $object->product_name }}</div>
									<div class='hardware-element-1 hardware-element-price'>₹{{ $object->product_price }}</div>
									<div class='hardware-element-1 hardware-element-price'>Stock: {{ $object->product_stock }}</div>
								</div>
								<div class="hardware-element-2 hardware-element-addtocart-btn-container">
									<a class="hardware-element-addtocart-link" href="/view-page?product_id={{ $object->product_id }}">
										<button class="hardware-element-addtocart-btn">View Product</button>
									</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</main>
		{{ view('parts.footer') }}
		<script src="scripts/base.js"></script>
	</body>
</html>
