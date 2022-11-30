for (var imgDefer = document.getElementsByTagName("img"), i = 0; i < imgDefer.length; i++) imgDefer[i].getAttribute("data-src") && imgDefer[i].setAttribute("src", imgDefer[i].getAttribute("data-src"));
try {
    getElement(".page-preload").classList.add("hidden")
} catch (e) {
}

function getElement(e) {
    return document.querySelector(e)
}

function getAllElements(e) {
    return document.querySelectorAll(e)
}

var psNavbar, navbar = getElement("nav"),
    navbarLeft = getElement("#navbar-left"),
    navbarRight = getElement("#navbar-right"),
    navbarToggle = getElement("#navbar-toggle"),
    navbarMenu = getElement(".navbar-menu"),
    navbarTab = getElement(".navbar-user-tab"),
    navbarSearch = getElement(".navbar-search");

function scrollPageTo(e, t) {
    try {
        return void(document.body.scrollTop > 0 ? scrollTo(document.body, e, t) : scrollTo(document.documentElement, e, t))
    } catch (e) {}
    window.scrollTo(0, e)
}
var floatingAction = getElement(".floating-action"),
    actionToggle = getElement(".action-toggle"),
    actionHome = getElement(".action-home"),
    actionMenu = getElement(".action-menu"),
    actionTop = getElement(".action-top");

actionToggle.onclick = function() {
    floatingAction.classList.contains("activated") ? (floatingAction.classList.remove("activated"), this.innerHTML = '<i class="icon-assistive"></i>') : (floatingAction.classList.add("activated"), this.innerHTML = '<i class="icon-close"></i>')
}, actionHome.onclick = function() {
    window.location.href = _GLOBAL_URL
}, actionMenu.onclick = function() {
    activeNavbarLeft()
}, actionTop.onclick = function() {
    scrollPageTo(0, 600)
};

function clickOnTab(e) {
    e.onclick = function () {
        for (var n = getElement(".tab-" + e.getAttribute("data-tab")), i = t.length - 1; i >= 0; i--) t[i].classList.add("hidden");
        for (i = navbarTab.children.length - 1; i >= 0; i--) navbarTab.children[i].classList.remove("activated");
        e.classList.add("activated"), n.classList.remove("hidden"), Ps.update(n)
    }
}

function activeNavbarLeft() {
    navbarLeft.classList.add("activated"), floatingAction.classList.remove("activated"), actionToggle.innerHTML = '<i class="icon-assistive"></i>', navbar.style.zIndex = "8888"
}

function lockScroll() { }

function unlockScroll() { }

function closeNavbar(e) {
    var t = 0,
        n = e.target;
    "ok" != n.className && (navbarLeft.contains(n) || navbarToggle.contains(n) || actionMenu.contains(n) || (navbarLeft.classList.remove("activated"), t++), t > 1 && (navbar.style.zIndex = ""))
}

function hideSearchResult(e) {
    navbarSearch.contains(e.target) || (navbarSearch.classList.remove("activated"), searchResult.classList.remove("activated"))
}

function showSubMenu(e) {
    e.onclick = function () {
        this.classList.toggle("activated")
    }
}
var onKeyTimeout, navbarHasSub = getAllElements(".navbar-menu-has-sub");
for (i = 0; i < navbarHasSub.length; i++) showSubMenu(navbarHasSub[i]);
navbarToggle.onclick = function () {
    activeNavbarLeft()
}, navbarLeft.querySelector(".navbar-close").onclick = function () {
    navbarLeft.classList.remove("activated"), navbar.style.zIndex = ""
};

window.addEventListener("click", (function (e) {
    closeNavbar(e)
}))

