create database ProjectDB;
use ProjectDB;

create table products (
	product_id int primary key auto_increment,
	product_name varchar(50) unique not null,
	product_shortdesc varchar(100) not null,
	product_longdesc varchar(500) not null,
	product_stock int not null
);

create table services (
	service_id int primary key auto_increment,
	service_name varchar(50) unique not null,
	service_shortdesc varchar(100) not null,
	service_longdesc varchar(500) not null,
	service_status enum('available', 'not_available')
);

create table carts (
	cart_id int primary key auto_increment,
	user_id int not null
);

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

create table users (
	user_id int not null auto_increment,
	user_name varchar(50) not null,
	primary key(user_id, user_name),
	user_pass varchar(64) not null,
	cart_id int,
	foreign key(cart_id) references carts(cart_id)
);

create table loginfo (
	loginfo_id int auto_increment primary key,
	user_id int,
	foreign key(user_id) references users(user_id),
	loginfo_datetime datetime not null default now()
);

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

desc products; desc services;desc carts;desc cart_items;desc users;desc loginfo;desc orders;desc payments;

drop database ProjectDB;
