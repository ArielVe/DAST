$(function () {
    $('[data-toggle="popover"]').popover()
});

var filtro = document.querySelector('#filtro');

filtro.addEventListener('input', function(){

    var boxfilter = document.querySelectorAll(".box-info");
    if(filtro.value.length > 0){
        for(var i = 0; i < boxfilter.length; i++){
            var boxname = boxfilter[i].querySelector(".box-info--text").textContent;
            var exp = new RegExp(filtro.value, "i");
            if(exp.test(boxname)){
                boxfilter[i].classList.remove("invisivel");
            }else{
                boxfilter[i].classList.add("invisivel");
            }
        };
    }else{
        for(var i = 0; i < boxfilter.length; i++){
            boxfilter[i].classList.remove("invisivel");
        };
    }
});