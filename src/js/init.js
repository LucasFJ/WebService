$(document).ready(function() {
    // Initialize collapse button
    $('.button-collapse').sideNav();

    //Controla o abre/fecha dos itens da SideNav
    $('.liMenu').click(function(){
    if($(this).hasClass('active')){
        $(this).children('.collapsible-body').hide(400);
        $(this).removeClass('active'); 
    } else {
        $(this).removeClass('active');
        $('.active').children('.collapsible-body').hide(400);
        $(this).addClass('active');
        $('.active').removeClass('active');
    }
    });
});
