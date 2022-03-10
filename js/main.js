/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
/**
 * Mobile Navigation Bar
 */
function toggleMobileNavBar(element){
    document.querySelector('#navbar').classList.toggle('navbar-mobile')
    element.classList.toggle('bi-list')
    element.classList.toggle('bi-x')
    if (!document.querySelector('#navbar').classList.contains('navbar-mobile')){
        document.getElementById("navbarSeperator").innerHTML = "<a>|</a>"
    }else{
        document.getElementById("navbarSeperator").innerHTML = "<hr>"
    }
    
}
function toggleMobileNavBarDropdown(element){
    if (document.querySelector('#navbar').classList.contains('navbar-mobile')) {
        element.nextElementSibling.classList.toggle('dropdown-active')
    }
}
window.onload = function(e){
    window.onresize = function(){
        if (document.querySelector('#navbar').classList.contains('navbar-mobile')) {
            document.querySelector('#navbar').classList.toggle('navbar-mobile');
            document.querySelector('.mobile-nav-toggle').classList.toggle('bi-list');
            document.querySelector('.mobile-nav-toggle').classList.toggle('bi-x');
            var elements = document.querySelectorAll(".navbar .dropdown > a");
            for (var i = 0; i < elements.length; i++) {
                if (elements[i].nextElementSibling.classList.contains('dropdown-active')){
                    elements[i].nextElementSibling.classList.toggle('dropdown-active');
                }
            }
            document.getElementById("navbarSeperator").innerHTML = "<a>|</a>"
        }
    }
    document.getElementById("preloader").remove();
    var topButton = document.querySelector(".back-to-top");
    if (topButton !== null) {
        window.onscroll = function () { detectScroll() };
        function detectScroll() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                topButton.classList.add('active')
            } else {
                topButton.classList.remove('active')
            }
        }
        detectScroll();
    }
}