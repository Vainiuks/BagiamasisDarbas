$(document).ready(function() {
    
    $(".collapse.show").each(function() {
        $(this).prev(".card-header").find(".fa-solid").addClass("fa-minus").removeClass("fa-plus");
    });

    $(".collapse").on('show.bs.collapse', function() {
        $(this).prev(".card-header").find(".fa-solid").removeClass("fa-plus").addClass("fa-minus");
    }).on('hide.bs.collapse', function() {
        $(this).prev(".card-header").find(".fa-solid").removeClass("fa-minus").addClass("fa-plus");
    });


})