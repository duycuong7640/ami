function confirmDelete(delUrl, message) {
    if (message) msg = message;
    else msg = 'Bạn có chắc chắn muốn xóa mục đã chọn không?';
    if (confirm(msg) == true) {
        document.location = delUrl;
    }
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

// $(document).ready(function () {
//     calHeightHomeOne();
//     calHeightBoxFooter()
// });
//
// window.addEventListener("resize", function () {
//     calHeightHomeOne()
//     calHeightBoxFooter()
// });
//
// function calHeightHomeOne() {
//     const bodyHeight = window.innerHeight;
//     console.log(bodyHeight)
//     const homeOne = document.querySelector('.wrap-home-one');
//     if (homeOne) {
//         homeOne.setAttribute('style', 'height: ' + bodyHeight + 'px');
//     }
// }
//
// function calHeightBoxFooter() {
//     const boxFooterLists = document.querySelectorAll('.cal-b-ft');
//     let heightMax = 0;
//     boxFooterLists.forEach((r) => {
//         if(r.clientHeight > heightMax){
//             heightMax = r.clientHeight;
//         }
//     });
//     heightMax += 90;
//     boxFooterLists.forEach((r) => {
//         r.setAttribute('style', 'height: ' + heightMax + 'px');
//     });
// }