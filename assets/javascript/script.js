document.body.insertAdjacentHTML("afterbegin", '<div class="info"><i class="fas fa-times"></i><p></p></div>');
const info = document.querySelector('.info'), info_btn = document.querySelector('.info > i');
info.style.opacity = 0;
function showInfo(msg) {
    info.children[1].innerHTML = msg;
    info.style.display = "flex";
    setTimeout(()=>{info.style.opacity = 1;}, 10);
    setTimeout(()=>{removeInfo();}, 2000);
}
function removeInfo() {
    info.style.opacity = 0;
    setTimeout(()=>{
        info.style.display = "none;"
    }, 500);
}
info_btn.onclick = removeInfo;
document.querySelector('.adress-ip-container').onclick = ()=>{
    if (navigator.clipboard) {
        navigator.clipboard.writeText(document.querySelector('.adress-ip').innerHTML).then(
        ()=>{
            showInfo("Pomyślnie skopiowano adres IP");
        },(err)=>{
            showInfo("Nie udało się skopiować adresu IP");
        });
    } else {
        showInfo("Nie udało się skopiować adresu IP!");
    }
};