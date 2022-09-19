let swipeMenu = document.querySelector(".swipe-menu");
let switchMenu, formMenu, isAnimate = false;
if (swipeMenu) {
    switchMenu = swipeMenu.querySelector(".switch");
    formMenu = swipeMenu.querySelector("form");

    if (switchMenu) {
        const stopAnimation = () => {
            isAnimate = false;
            if (!swipeMenu.classList.contains("show")) {
                formMenu.classList.add("hidden");
            }
        };
        swipeMenu.ontransitionend = stopAnimation;
        swipeMenu.ontransitioncansel = stopAnimation;
        switchMenu.onclick = () => {
            if (isAnimate === true) return;
            isAnimate = true;
            formMenu.classList.remove("hidden");
            swipeMenu.classList.toggle("show");
        };
    }
}
