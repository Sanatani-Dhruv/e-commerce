let hamburger = document.querySelector(".hamburger");
let navbar_ul = document.querySelector(".navbar-ul");
let navbar_link_container = document.querySelector(".navbar-link-container");
let navbar_links = document.querySelectorAll(".navbar-link");
let close_icon = document.querySelector(".close-icon");
let header_container = document.querySelector(".header-container");
let body_tag = document.getElementById("body");
let change_theme_btn = document.getElementById('ctb');
let theme = localStorage.getItem('theme') || 'dark';

body_tag.classList.add(theme);

change_theme_btn.addEventListener('click', () => {
	if (body_tag.classList.contains('light')) {
		body_tag.classList.replace('light', 'dark')
		window.localStorage.setItem('theme', 'dark');
		change_img('ctb-img', 'images/dark-mode.svg')
	} else {
		body_tag.classList.replace('dark', 'light')
		window.localStorage.setItem('theme', 'light');
		change_img('ctb-img', 'images/light-mode.svg')
	}
});

hamburger.addEventListener("click", () => {
	navbar_ul.classList.add("navbar-ul-show");
	navbar_link_container.classList.add("navbar-link-container-show");
	header_container.classList.add("header-container-show");
	body_tag.classList.add("stop-scroll");
	hamburger.style.display = "none";
})

close_icon.addEventListener("click", () => {
	navbar_ul.classList.remove("navbar-ul-show");
	navbar_link_container.classList.remove("navbar-link-container-show");
	body_tag.classList.remove("stop-scroll");
	header_container.classList.remove("header-container-show");
	hamburger.style.display = "block";
})

navbar_links.forEach(
	element => element.addEventListener("click", function () {
		navbar_ul.classList.remove("navbar-ul-show");
		navbar_link_container.classList.remove("navbar-link-container-show");
		body_tag.classList.remove("stop-scroll");
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
	let prev_img_url = document.getElementById(prev_id).src;
	let prev_img = document.getElementById(prev_id);
	let img_url = document.getElementById(prev_id).src;
	if (prev_img_url != next_img_url) {
		prev_img.src = next_img_url;
	}
}

// Check for System Theme
let getSystemTheme = () => {
	// Check if the preferred scheme is dark
	const isDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches; // Be careful! Not just parantheses and quotes, like ("()") this
	const mode = isDarkmode ? "dark" : "light";
	return mode;
}

// Set Theme
function setTheme(theme) {
	const rootElement = document.querySelector("html");
	// Set <html daa-theme="theme"> to change children styles
	rootElement.setQuery("data-theme", theme);
}

