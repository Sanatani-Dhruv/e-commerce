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

create table carts (
	cart_id int primary key auto_increment,
	user_id int not null
);
desc carts ;

create table cart_items (
	cart_items_id int not null,
	cart_id int,
	foreign key(cart_id) references carts(cart_id),
	product_id int not null,
	foreign key(product_id) references products(product_id),
	item_quantity int not null,
	service_id int not null,
	foreign key(service_id) references services(service_id)
);
desc cart_items ;

create table users (
	user_id int not null auto_increment,
	user_name varchar(50) not null,
	primary key(user_id, user_name),
	user_email varchar(250) not null,
	user_number varchar(20) not null,
	user_pass varchar(64) not null,
	cart_id int,
	foreign key(cart_id) references carts(cart_id)
);
desc users ;

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
	cart_id int,
	foreign key(cart_id) references carts(cart_id)
);

create table payments (
	payment_id int not null auto_increment,
	primary key(payment_id),
	payment_method enum('cash_on_delivery', 'upi', 'credit_card', 'debit_card'),
	order_id int,
	foreign key(order_id) references orders(order_id)
);

show tables;

-- desc products; desc services;desc carts;desc cart_items;desc users;desc loginfo;desc orders;desc payments;

drop database ProjectDB;
