function getElement(e) {
    return document.querySelector(e)
}

function getAllElements(e) {
    return document.querySelectorAll(e)
}

var filmInfoTab = getElement(".film-info-tab"),
    episodeTab = getElement(".info-tab-item.tab-episode"),
    commentTab = getElement(".info-tab-item.tab-comment"),
    infoTab = getElement(".info-tab-item.tab-information"),
    commentBody = getElement(".film-comment"),
    infoBody = getElement(".film-content"),
    episodeBody = getElement(".film-episode"),
    episodeGroupTabs = getAllElements(".episode-group-tab"),
    episodeGroupBody = getAllElements(".episode-group");
episodeTab.onclick = function () {
    for (a = filmInfoTab.children.length - 1; a >= 0; a--) filmInfoTab.children[a].classList.remove("activated");
    this.classList.add("activated"), episodeBody.classList.remove("hidden"), commentBody.classList.add("hidden"), infoBody.classList.add("hidden")
}
commentTab.onclick = function () {
    for (var e = filmInfoTab.children.length - 1; e >= 0; e--) filmInfoTab.children[e].classList.remove("activated");
    this.classList.add("activated"), episodeBody.classList.add("hidden"), commentBody.classList.remove("hidden"), infoBody.classList.add("hidden")
}
infoTab.onclick = function () {
    for (var e = filmInfoTab.children.length - 1; e >= 0; e--) filmInfoTab.children[e].classList.remove("activated");
    this.classList.add("activated"), episodeBody.classList.add("hidden"), commentBody.classList.add("hidden"), infoBody.classList.remove("hidden")
}
function clickOnEpisodeGroupTab(e) {
    e.onclick = function() {
        this.classList.add("activated")
        for (var i = episodeGroupBody.length - 1; i >= 0; i--) {
            if (episodeGroupBody[i].getAttribute("data-group") === e.getAttribute("data-tab")) episodeGroupBody[i].classList.remove("hidden");
            else episodeGroupBody[i].classList.add("hidden"), episodeGroupTabs[i].classList.remove("activated") ;
        }
    }
}
for (i = 0; i < episodeGroupTabs.length; i++) clickOnEpisodeGroupTab(episodeGroupTabs[i]);
