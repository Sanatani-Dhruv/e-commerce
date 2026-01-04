var hamburger = document.querySelector(".hamburger");
var navbar_ul = document.querySelector(".navbar-ul");
var navbar_link_container = document.querySelector(".navbar-link-container");
var navbar_links = document.querySelectorAll(".navbar-link");
var close_icon = document.querySelector(".close-icon");
var header_container = document.querySelector(".header-container");
var body_element = document.querySelector(".body");
hamburger.addEventListener("click", () => {
	navbar_ul.classList.add("navbar-ul-show");
	navbar_link_container.classList.add("navbar-link-container-show");
	header_container.classList.add("header-container-show");
	body_element.classList.add("stop-scroll");
	hamburger.style.display = "none";
})

close_icon.addEventListener("click", () => {
	navbar_ul.classList.remove("navbar-ul-show");
	navbar_link_container.classList.remove("navbar-link-container-show");
	body_element.classList.remove("stop-scroll");
	header_container.classList.remove("header-container-show");
	hamburger.style.display = "block";
})

navbar_links.forEach(
	element => element.addEventListener("click", function () {
		navbar_ul.classList.remove("navbar-ul-show");
		navbar_link_container.classList.remove("navbar-link-container-show");
		body_element.classList.remove("stop-scroll");
		header_container.classList.remove("header-container-show");
		hamburger.style.display = "block";
	})
);

pass_field = document.querySelector('#login-password');
pass_change_btn = document.querySelector('#pass_change_btn');
pass_change_btn.addEventListener('click', () => {
	if (pass_field.type == 'password') {
		pass_field.type = 'text';
		change_img('passwd_hide_img', 'images/passwd-show.svg');
	} else if (pass_field.type == 'text') {
		pass_field.type = 'password';
		change_img('passwd_hide_img', 'images/passwd-hide.svg');
	}
});

function change_img(prev_id, next_img_url) {
	var prev_img_url = document.getElementById(prev_id).src;
	var prev_img = document.getElementById(prev_id);
	var img_url = document.getElementById(prev_id).src;
	if (prev_img_url != next_img_url) {
		prev_img.src = next_img_url;
	}
}
