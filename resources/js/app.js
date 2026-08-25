import './bootstrap';
import './tasks';
import "./confirm-modal";

window.themeController = () => ({
	theme: document.documentElement.classList.contains("light") ? "light" : "dark",

	init() {
		this.apply(this.theme);
	},

	toggle() {
		this.apply(this.theme === "dark" ? "light" : "dark");
	},

	apply(theme) {
		this.theme = theme;
		document.documentElement.classList.toggle("light", theme === "light");
		document.documentElement.classList.toggle("dark", theme !== "light");
		localStorage.setItem("taskora-theme", theme);
	},
});


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
