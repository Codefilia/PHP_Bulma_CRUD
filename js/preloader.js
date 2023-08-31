if ($(".pageloader").length) {
    $(".pageloader").toggleClass("is-active");
    $(window).on("load", function (){
        var pageloaderTimeout = setTimeout(function () {
            $(".pageloader").toggleClass("is-active");
            $(".infraloader").toggleClass("is-active");
            clearTimeout(pageloaderTimeout);
        }, 3000);
    });
}




