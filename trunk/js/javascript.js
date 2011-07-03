$(function(){
    /*--------menu---------*/
    $('#menu > ul > li').hover(function(){
        $(this).find('ul').css({visibility: "visible",display: "none"}).slideDown(200);
    },function(){
        $(this).find('ul').hide();
    });
    
    /*---------slideshow-----------*/
    $('#top1-right img:not(:first)').hide();
    $('#top1-right div a:first').css({'color':'red'});
    $('#top1-right div a').hover(function(){
        var name = $(this).attr('name');
        $('#top1-right img').hide();
        $('#top1-right div a').css({'color':'#0D65AD'});
        $('#top1-right img[name='+name+']').show();
        $('#top1-right div a[name='+name+']').css({'color':'red'});
    });
    
    $('.sim-detail-info div:even').css({'background':'#f4f4f4'});
    
});