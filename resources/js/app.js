import { showNavbar } from "./sidebar";
require("./bootstrap");

document.addEventListener("DOMContentLoaded", function (event) {
    showNavbar("header-toggle", "nav-bar", "body-pd", "header");
});
