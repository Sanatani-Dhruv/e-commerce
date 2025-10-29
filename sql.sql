create database ProjectDB;
use ProjectDB;

create table products (
	product_id int primary key auto_increment,
	product_name varchar(150) unique not null,
	product_shortdesc varchar(400) not null,
	product_longdesc varchar(2000) not null,
	product_stock varchar(11) not null,
	product_price varchar(11) not null,
	product_imagepath varchar(200) not null
);
desc products;

create table services (
	service_id int primary key auto_increment,
	service_name varchar(50) unique not null,
	service_shortdesc varchar(100) not null,
	service_longdesc varchar(500) not null,
	service_price varchar(11) not null,
	service_status enum('available', 'not_available')
);
desc services;

create table users (
	user_id int not null auto_increment,
	user_name varchar(50) not null,
	primary key(user_id, user_name),
	user_email varchar(250) not null,
	user_number varchar(20) not null,
	user_pass varchar(64) not null
);
desc users ;

create table cart_items (
	cart_items_id int primary key auto_increment,
	user_id int,
	foreign key(user_id) references users(user_id),
	product_id int,
	foreign key(product_id) references products(product_id),
	item_quantity int not null,
	service_id int,
	foreign key(service_id) references services(service_id)
);
desc cart_items ;

create table loginfo (
	loginfo_id int auto_increment primary key,
	user_id int,
	foreign key(user_id) references users(user_id),
	loginfo_datetime datetime not null default now()
);
desc loginfo ;

create table orders (
	order_id int not null auto_increment primary key,
	order_status enum('success', 'fail', 'online') not null,
	user_id int,
	foreign key(user_id) references users(user_id)
);

create table payments (
	payment_id int not null auto_increment,
	primary key(payment_id),
	payment_method enum('cash_on_delivery', 'upi', 'credit_card', 'debit_card'),
	order_id int,
	foreign key(order_id) references orders(order_id)
);

show tables;

INSERT INTO `users` VALUES
(1,'admin','dhruvdds125@gmail.com','6352733627','$2y$12$m30vretxmfy50yhUKf7eneutuMoEKbEZdk0qQGAncBK8hfFnXNxmi'),
(2,'deadster125','dhruvdds125@gmail.com','6352733627','$2y$12$7.pf1miNtT3pZsYG.39bB.uf/6fOMLmNjs.KGL6BoulAVTh61mmiq');

INSERT INTO `products` VALUES
(1,'Intel Core i3-13100 CPU','Intel’s Entry-Level Core i3-13100 CPU With Quad Core Design Spotted, Perfect For Budget Gaming Builds','Intel’s Entry-Level Core i3-13100 CPU With Quad Core Design Spotted, Perfect For Budget Gaming Builds Intel’s Entry-Level Core i3-13100 CPU With Quad Core Design Spotted, Perfect For Budget Gaming Builds Intel’s Entry-Level Core i3-13100 CPU With Quad Core Design Spotted, Perfect For Budget Gaming Builds','250','2459','images/products/13th-Gen-Intel-Core-2-740x416.jpg'),
(2,'DDR4 Intel Ram 9th Gen','DDR4 Intel Ram 9th Gen','DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen DDR4 Intel Ram 9th Gen','20','1499','images/products/DDR4 Intel Ram 9th Gen .jpeg'),
(3,'DD2 Gen 2 Old HD RAM','(FROM W3M)DD4 HD Ram From Old Gen','DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen DD4 HD Ram From Old Gen\r\n ~/Desktop/HTML-CSS-PRACTICE/MAIN/images/products/DDR4 Intel Ram 9th Gen .jpeg','0','1250','images/products/DDR4 Intel Ram 9th Gen .jpeg'),
(4,'CORSAIR Vengeance LPX DDR4 RAM 32GB (2x16GB) 3200MHz','CORSAIR Vengeance LPX DDR4 RAM 32GB (2x16GB) 3200MHz CL16-20-20-38 1.35V Intel AMD Desktop Computer Memory - Black (CMK32GX4M2E3200C16)','VENGEANCE LPX memory is designed for high-performance overclocking. The heatspreader is made of pure aluminum for faster heat dissipation, and the eight-layer PCB helps manage heat and provides superior overclocking headroom. DESIGNED FOR HIGH-PERFORMANCE OVERCLOCKING VENGEANCE LPX memory is designed for high-performance overclocking. The heatspreader is made of pure aluminum for faster heat dissipation, and the custom performance PCB helps manage heat and provides superior overclocking headroom. Each IC is individually screened for peak performance potential. COMPATIBILITY TESTED Part of our exhaustive testing process includes performance and compatibility testing on nearly every motherboard on the market - and a few that aren&#039;t. DESIGNED FOR HIGH-PERFORMANCE OVERCLOCKING Each VENGEANCE LPX module is built from an custom performance PCB and highly-screened memory ICs. The efficient heat spreader provides effective cooling to improve overclocking potential. XMP 2.0 SUPPORT One setting is all it takes to automatically adjust to the fastest safe speed for your VENGEANCE LPX kit. You&#039;ll get amazing, reliable performance without lockups or other strange behavior. LOW-PROFILE DESIGN The small form factor makes it ideal for smaller cases or any system where internal space is at a premium. ALUMINUM HEAT SPREADER Overclocking overhead is limited by operating temperature. The unique design of the VENGEANCE LPX heat spreader optimally pulls heat away from the ICs and into your system&#039;s cooling path, so you can push it harder. MATCH YOUR SYSTEM The best high-performance systems look as good as they run. VENGEANCE LPX is available in several colors to match your motherboard, your other components, your case -- or just your favorite color. The DDR4 form factor is optimized for the latest DDR4 systems and offers higher frequencies, greater bandwidth, and lower power','156','10119','images/products/61wCOVcyvFL._AC_SX466_.jpg');
-- desc products; desc services;desc carts;desc cart_items;desc users;desc loginfo;desc orders;desc payments;

drop database ProjectDB;
