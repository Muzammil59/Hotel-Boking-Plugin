
    
        jQuery( document ).ready(function($) {

            $('.tour_btn').click(function () {
    
            var hotelId = $(this).data('hotelid');
           
            var str = 'hotelid=' + hotelId + '&action=popup_images';
            $.ajax({
                type: "POST",
                dataType: "html",
                url: my_ajax_object.ajaxurl,
                data: str,
                success: function(data){
                    if ($('.image_slider').hasClass('slick-initialized')) {
                        $('.image_slider').slick('destroy');
                    }
                    
                    $( '.image_slider' ).html( data );
                    
                    $('.image_slider').slick({
                        dots: false,
                        infinite: false,
                        speed: 300,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                            });
                
                console.log(data);     
                },
                error : function(jqXHR, textStatus, errorThrown) {
                  connsole.log("i am not in");
                }
            });
        });
    
        $('.transport-dates').click(function () {
            var loaderurl = $(this).data('imageurl');
            $('#hotels-listing').prepend('<div id="loading"><img src="' + loaderurl + '" title="loading" /></div>');
    
        
            var fullDate = $(this).data('fulldate');
            var departureId = $(this).data('departureid');
            var arrivalId = $(this).data('arrivalid');
            var travelersNum = $(this).data('travelersnum');
           
            var str = 'fullDate=' + fullDate + '&departureId=' + departureId + '&arrivalId=' + arrivalId + '&travelersNum=' + travelersNum + '&action=ajax_hotels';
            $.ajax({
                type: "POST",
                dataType: "html",
                url: my_ajax_object.ajaxurl,
                data: str,
                success: function(data){
                    setTimeout(function () {
                    $('#loading').remove();
                    $("#hotels-listing").html(data);
                }, 3000);
                //console.log(data);     
                },
                error : function(jqXHR, textStatus, errorThrown) {
                  connsole.log("i am not in");
                }
            });
        });
    });
    