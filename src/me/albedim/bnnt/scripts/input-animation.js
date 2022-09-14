$(".email").on("click" , () => {
    document.querySelector(".email-icon").style.marginLeft = "9px";
    document.querySelector(".email-icon").style.transition = "0.4s";
    document.querySelector(".email-icon").style.color = "#2fc237";
    document.querySelector(".password-icon").style.marginLeft = "24px";
    document.querySelector(".password-icon").style.transition = "0.4s";
    document.querySelector(".password-icon").style.color = "black";
});

$(".password").on("click" , () => {
    document.querySelector(".password-icon").style.marginLeft = "9px";
    document.querySelector(".password-icon").style.transition = "0.4s";
    document.querySelector(".password-icon").style.color = "#2fc237";
    document.querySelector(".email-icon").style.marginLeft = "24px";
    document.querySelector(".email-icon").style.transition = "0.4s";
    document.querySelector(".email-icon").style.color = "black";
});