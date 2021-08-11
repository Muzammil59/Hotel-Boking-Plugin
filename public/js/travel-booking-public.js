(function($) {


    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
})(jQuery);
jQuery(document).on('click', function(event){
	let targetDiv = jQuery('.arvi-form');
	if (!targetDiv.is(event.target) && !targetDiv.has(event.target).length) {
        $(targetDiv).removeClass('show');
    }
});
function selectAll(id) {
	var allDropDowns = [{
            name: id,
            checked: [],
            checkedNames: []
        }];
// 	allDropDowns.push();
	var a = $("."+id).find('.multiselect-checkbox').each(function() {
		$(this).prop('checked',true);
		var v = $(this).val();
		var name = $(this).attr('data-title');
		allDropDowns[0].checked.push(v);
		allDropDowns[0].checkedNames.push(name);
	});
	var btnText = $("#" + id)
		.closest(".multiselect-container")
		.find("button")
		.find("span");
	var depNames = $("#" + id)
		.closest(".multiselect-container")
		.find(".multiselect-names")
	var hiddenValues = $("#" + id)
		.closest(".multiselect-container")
		.find(".multiselect-values");
	   if (allDropDowns[0] && allDropDowns[0].checked.length > 0) {
            allDropDowns[0].checked.length < 4 ?
                $(btnText).text(allDropDowns[0].checkedNames.join(",")) :
                $(btnText).text(allDropDowns[0].checkedNames.length + " Valda");
                $(hiddenValues).val(allDropDowns[0].checked.join(","));
                $(depNames).val(allDropDowns[0].checkedNames.join("/"));
        } else {
            $(btnText).text("Välj");
            $(hiddenValues).val("");
        }
}
function deSelectAll(id) {
	var a = $("."+id).find('.multiselect-checkbox').each(function() {
		$(this).prop('checked',false);
	});
	$("#" + id)
		.closest(".multiselect-container")
		.find("button")
		.find("span")
		.text('Välj');
	$("#" + id)
		.closest(".multiselect-container")
		.find(".multiselect-names").val('');
	$("#" + id)
		.closest(".multiselect-container")
		.find(".multiselect-values").val('');
}
jQuery(document).ready(function($) {
    $(".andra-sokning").click(function(){
        $(".visible-form").show();
      });
    $(".your-class").slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              infinite: true,
              dots: false,
            },
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ],
      });
    var allDropDowns = [];
    $(".multiselect-container").each(function(c) {
        var id = $(this).find("button").attr("id");
        allDropDowns.push({
            name: id,
            checked: [],
            checkedNames: []
        });
    });
	
    $(".multiselect-checkbox").click(function() {
        var isChecked = $(this).prop("checked");
        var currentValue = $(this).val();
        var currentName = $(this).attr('data-title');
        var dropDown = $(this)
            .closest(".multiselect-container")
            .find("button")
            .attr("id");
        if (isChecked) {
            allDropDowns.forEach(function(d) {
                if (d.name == dropDown) {
                    d.checked.push(currentValue);
                    d.checkedNames.push(currentName);
                }
            });
            // checked.push($(this).val());
        } else {
            allDropDowns.forEach(function(d) {
                if (d.name == dropDown) {
                    var remove = d.checked.indexOf(currentValue);
                    d.checked.splice(remove, 1);
                    d.checkedNames.splice(remove, 1);
                }
            });
        }

        var currentDropDown = allDropDowns.filter(function(d) {
            return d.name == dropDown;
        });
        var btnText = $(this)
            .closest(".multiselect-container")
            .find("button")
            .find("span");
        var depNames = $(this)
            .closest(".multiselect-container")
            .find(".multiselect-names")
        var hiddenValues = $(this)
            .closest(".multiselect-container")
            .find(".multiselect-values");
        if (currentDropDown[0] && currentDropDown[0].checked.length > 0) {
            currentDropDown[0].checked.length < 4 ?
                $(btnText).text(currentDropDown[0].checkedNames.join(",")) :
                $(btnText).text(currentDropDown[0].checkedNames.length + " Valda");
                $(hiddenValues).val(currentDropDown[0].checked.join(","));
                $(depNames).val(currentDropDown[0].checkedNames.join("/"));
        } else {
            $(btnText).text("Välj");
            $(hiddenValues).val("");
        }

    });

     $( "#avreseort" ).change(function() {
        var depVal= $('#avreseort span').text();
        console.log(depVal);
     });

    $(".transport-dates").click(function(){
        $('.transport-dates').removeClass('active');
	    $(this).addClass('active');
        //console.log("Text: " + $(".active .date").text()); 
        var departureDate = $(".active .full-date").val();
        $('.departureDate').text(departureDate);

        var departureTime = $(".active .departureTime").val();
        $('.departure_time').text(departureTime);

        var arrivalTime = $(".active .arrivalTime").val();
        $('.arrival_time').text(arrivalTime);
        
        var departureTimeSplit = departureTime.split('');
        var arrivalTimeSplit = arrivalTime.split('');
        var departurehours =  arrivalTimeSplit[0].concat(arrivalTimeSplit[1]) - departureTimeSplit[0].concat(departureTimeSplit[1]) ;
        var departureminutes =  arrivalTimeSplit[3].concat(arrivalTimeSplit[4]) - departureTimeSplit[3].concat(departureTimeSplit[4]) ;
        $('.dhour').text(Math.abs(departurehours));
        $('.dminute').text(Math.abs(departureminutes));
        
        
        var departureName = $(".active .box_book_wrap-transp-from").text();
        $('.departureName').text(departureName);
        
        var arrivalName = $(".active .box_book_wrap-transp-to").text();
        $('.arrivalName').text(arrivalName);
        
        var returnDate = $(".active .returnDate").val();
        $('.returnarrivalDate').text(returnDate);

        var returnDepartureTime = $(".active .returnDepartureTime").val();
        $('.return_departure').text(returnDepartureTime);

        var returnArrivalTime = $(".active .returnArrivalTime").val();
        $('.return_arrival').text(returnArrivalTime);
        
        var returndepartureTimeSplit = returnDepartureTime.split('');
        var returnarrivalTimeSplit = returnArrivalTime.split('');
        var returndeparturehours =  returnarrivalTimeSplit[0].concat(returnarrivalTimeSplit[1]) - returndepartureTimeSplit[0].concat(returndepartureTimeSplit[1]) ;
        var returndepartureminutes =  returnarrivalTimeSplit[3].concat(returnarrivalTimeSplit[4]) - returndepartureTimeSplit[3].concat(returndepartureTimeSplit[4]) ;
        $('.rdhour').text(Math.abs(returndeparturehours));
        $('.rdminute').text(Math.abs(returndepartureminutes));

        var returnDepartureName = $(".active .box_book_wrap-transp-to").text();
        $('.return_arrivalname').text(returnDepartureName);

        var returnArrivalName = $(".active .box_book_wrap-transp-from").text();
        $('.return_departurename').text(returnArrivalName);

    });
// 	$(".VideoPopup").on('show.bs.modal', function (e) {
//      $(".VideoPopup iframe").attr("src",   $(".VideoPopup iframe").attr("src"));
// 	});
//    	$(".VideoPopup").on('hidden.bs.modal', function (e) {
//      $(".VideoPopup iframe").attr("src",   $(".VideoPopup iframe").attr("src"));
// 	});
	$('.image_slider').slick({
		dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
	});

    /* $('#tbform').on('submit', function(e) {

         e.preventDefault();

         //var data = {
        //     action: 'booking_form'
         //}

         $.ajax({
             type: "POST",
             dataType: "html",
             url: my_php_variables.ajaxurl,
             data: $(this).serialize(),
             success: function(data) {
                 console.log('Result: ' + data);
                 $("#response").html(data);
                 // jQuery(".apt-row_"+aptform_id).hide();
             },
             error: function(jqXHR, textStatus, errorThrown) {
                 console.log('i am not in');
             }
         });

         return false;
     });*/
	

});


