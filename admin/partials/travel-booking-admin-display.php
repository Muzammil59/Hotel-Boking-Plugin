<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       muzammildev.com
 * @since      1.0.0
 *
 * @package    Travel_Booking
 * @subpackage Travel_Booking/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="container">
    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Settings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Videos Link</a>
        </li>
    </ul><!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="tabs-1" role="tabpanel">
        <?php 
        if(isset($_POST['submit'])){

            update_option('formstyle', $_POST['formstyle']);
            update_option('formposition', $_POST['formposition']);
            update_option('formbgcolor', $_POST['formbgcolor']);
            update_option('formheadingcolor', $_POST['formheadingcolor']);
            update_option('formheadingfontsize', $_POST['formheadingfontsize']);
            update_option('labelfontsize', $_POST['labelfontsize']);
            update_option('labelfontcolor', $_POST['labelfontcolor']);
            update_option('formbuttonbgcolor', $_POST['formbuttonbgcolor']);
            update_option('formbuttonbghovercolor', $_POST['formbuttonbghovercolor']);
            update_option('buttontextsize', $_POST['buttontextsize']);
            update_option('buttontextcolor', $_POST['buttontextcolor']);
            update_option('buttontexthovercolor', $_POST['buttontexthovercolor']);
            update_option('calendarcolor', $_POST['calendarcolor']);

            // Page Settings
            update_option('listingprimarycolor', $_POST['listingprimarycolor']);
            update_option('listingsecondarycolor', $_POST['listingsecondarycolor']);
            update_option('listingheadingscolor', $_POST['listingheadingscolor']);
            update_option('listingheadingsfontsize', $_POST['listingheadingsfontsize']);
            update_option('listingparagraphcolor', $_POST['listingparagraphcolor']);
            update_option('listingparagraphfontsize', $_POST['listingparagraphfontsize']);
            
            // Single Page Settings
            update_option('detailheadingscolor', $_POST['detailheadingscolor']);
            update_option('detailheadingsfontsize', $_POST['detailheadingsfontsize']);
            update_option('detailparagraphcolor', $_POST['detailparagraphcolor']);
            update_option('detailparagraphfontsize', $_POST['detailparagraphfontsize']);

        }
        ?>
      
        <form action="" method="post">
            <fieldset>
                <legend>Settings:</legend>
                
                <div class="form-group form_checkBox">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="formstyle" id="formstyle1" value="vertical-form" <?php if(get_option('formstyle') == "vertical-form") { ?>checked<?php } ?>>
                        <label class="form-check-label" for="formstyle1">
                            Show Vertical Form
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="formstyle" id="formstyle2" value="horizontal-form" <?php if(get_option('formstyle') == "horizontal-form") { ?>checked<?php } ?>>
                        <label class="form-check-label" for="formstyle2">
                            Show Horizontal Form
                        </label>
                    </div>
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Form Position:</label>
                    <select class="form-control" name="formposition">
                    <option value="left">Left</option>
                    <option value="center">Center</option>
                    <option value="right">Right</option>
                    </select>
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Form Background Color:</label>
                    <input type="color" class="form-control" id="formbgcolor" name="formbgcolor" value="<?php echo get_option( 'formbgcolor' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Form Heading Color:</label>
                    <input type="color" class="form-control" id="formheadingcolor" name="formheadingcolor" value="<?php echo get_option( 'formheadingcolor' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Form Heading Font Size:</label>
                    <input type="text" class="form-control" id="formheadingfontsize" name="formheadingfontsize" value="<?php echo get_option( 'formheadingfontsize' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Label Color:</label>
                    <input type="color" class="form-control" id="labelfontcolor" name="labelfontcolor" value="<?php echo get_option( 'labelfontcolor' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelfontsize">Label Font Size:</label>
                    <input type="text" class="form-control" id="labelfontsize" name="labelfontsize" placeholder="e.g. 14px" value="<?php echo get_option( 'labelfontsize' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelfontsize">Form Button BG Color:</label>
                    <input type="color" class="form-control" id="formbuttonbgcolor" name="formbuttonbgcolor" placeholder="Button BG color" value="<?php echo get_option('formbuttonbgcolor'); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelfontsize">Form Button BG Hover Color:</label>
                    <input type="color" class="form-control" id="formbuttonbghovercolor" name="formbuttonbghovercolor" placeholder="Button BG color" value="<?php echo get_option('formbuttonbghovercolor'); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelfontsize">Button Text Size:</label>
                    <input type="text" class="form-control" id="buttontextsize" name="buttontextsize" placeholder="e.g. 14px"  value="<?php echo get_option('buttontextsize'); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelfontsize">Button Text Color:</label>
                    <input type="color" class="form-control" id="buttontextcolor" name="buttontextcolor" placeholder="e.g. 14px" value="<?php echo get_option('buttontextcolor'); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelfontsize">Button Text Hover Color:</label>
                    <input type="color" class="form-control" id="buttontexthovercolor" name="buttontexthovercolor" placeholder="e.g. 14px" value="<?php echo get_option('buttontexthovercolor'); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelfontsize">Calendar Active Date Color:</label>
                    <input type="color" class="form-control" id="calendarcolor" name="calendarcolor" placeholder="e.g. 14px" value="<?php echo get_option('calendarcolor'); ?>">
                </div>

                <legend>Listing Pages Settings:</legend>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Primary Color:</label>
                    <input type="color" class="form-control" id="listingprimarycolor" name="listingprimarycolor" value="<?php echo get_option( 'listingprimarycolor' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Secondary Color:</label>
                    <input type="color" class="form-control" id="listingsecondarycolor" name="listingsecondarycolor" value="<?php echo get_option( 'listingsecondarycolor' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Headings Color:</label>
                    <input type="color" class="form-control" id="listingheadingscolor" name="listingheadingscolor" value="<?php echo get_option( 'listingheadingscolor' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Headings Fontsize:</label>
                    <input type="text" class="form-control" id="listingheadingsfontsize" name="listingheadingsfontsize" placeholder="e.g. 14px" value="<?php echo get_option( 'listingheadingsfontsize' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Paragraph Color:</label>
                    <input type="color" class="form-control" id="listingparagraphcolor" name="listingparagraphcolor" value="<?php echo get_option( 'listingparagraphcolor' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Paragraph Fontsize:</label>
                    <input type="text" class="form-control" id="listingparagraphfontsize" name="listingparagraphfontsize" placeholder="e.g. 14px" value="<?php echo get_option( 'listingparagraphfontsize' ); ?>">
                </div>
                <legend>Detail Page Settings:</legend>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Headings Color:</label>
                    <input type="color" class="form-control" id="detailheadingscolor" name="detailheadingscolor" value="<?php echo get_option( 'detailheadingscolor' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Headings Fontsize:</label>
                    <input type="text" class="form-control" id="detailheadingsfontsize" name="detailheadingsfontsize" placeholder="e.g. 14px" value="<?php echo get_option( 'detailheadingsfontsize' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Paragraph Color:</label>
                    <input type="color" class="form-control" id="detailparagraphcolor" name="detailparagraphcolor" value="<?php echo get_option( 'detailparagraphcolor' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <label for="labelcolor">Paragraph Fontsize:</label>
                    <input type="text" class="form-control" id="detailparagraphfontsize" name="detailparagraphfontsize" placeholder="e.g. 14px" value="<?php echo get_option( 'detailparagraphfontsize' ); ?>">
                </div>
                <div class="form-group travel_booking_field">
                    <?php submit_button('Save Settings'); ?>
                </div>      
            </fieldset>
        </form>
        </div>
        <div class="tab-pane" id="tabs-2" role="tabpanel"> 
        <?php
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://ws.tourpaq.com/AgencyOffer/v4.1/service',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:ws-tourpaq-com:AgencyOffer:v2:Messages">
            <soapenv:Header/>
            <soapenv:Body>
                <urn:GetHotelsRequest>
                    <urn:AgencyID>122</urn:AgencyID>
                    <urn:IntervalID>0</urn:IntervalID>
                    <urn:DepartureDate>2021-07-07</urn:DepartureDate>
                    <urn:Departures></urn:Departures>
                    <urn:AdultsNumber>4</urn:AdultsNumber>
                    <urn:Resorts></urn:Resorts>
                    <urn:GetHotelDescriptions ShortDescription="1" HtmlDescription="1" AltHtmlDescription="1">1</urn:GetHotelDescriptions>
                    <urn:ShowAllHotels>1</urn:ShowAllHotels>
                    <urn:PageNumber>0</urn:PageNumber>
                    <urn:PageSize>10</urn:PageSize>
                </urn:GetHotelsRequest>
            </soapenv:Body>
            </soapenv:Envelope>',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/xml',
                'SOAPAction: urn:ws-tourpaq-com:AgencyOffer:v2/IAgencyOffer/GetHotels',
                'Authorization: Basic VVBUREs6MjUxMTM4ZDk1MDc0MjNlN2ZjYmU4YmUzMDMyMjUwMTA='
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3" , $response);
            $xml=new SimpleXMLElement($response);
            $body=$xml->xpath('//sBody')[0];
            $array = json_decode(json_encode((array)$body), TRUE);
        
            $hotelsArray = $array["GetHotelsResponse"]["Hotels"];
            if( $hotelsArray ){ 
            // print_r($hotelsArray);
            ?>
             <table class="table table-bordered">
                <thead>
                <tr>
                    <th>HotelID</th>
                    <th>Hotel Name</th>
                    <th>Video Link</th>
                </tr>
                </thead>
                <tbody>
                <?php
				global $wpdb;
                 if(isset($_POST['submit'])){
					$hotelids   =   $_POST['hotelsid'];
					$hotelnames =   $_POST['hotelsname'];
					$videolinks =   $_POST['videolink'];
					$table_name =   $wpdb->prefix . 'hotels';
					$i  =   0;
					foreach($hotelids as $hotelid){
						$hotel_id   =   0;
						$hotel_id   =   $wpdb->query("SELECT hotelid FROM $table_name WHERE hotelid = ".$hotelid);
						if($hotel_id){
							$sql = "UPDATE $table_name SET hotelurl='" . $videolinks[$i]. "' WHERE hotelid = ".$hotelid;
							$wpdb->query($sql);
						} else {
							$sql = "INSERT INTO
										$table_name
									SET
										hotelid     =   ".$hotelid.",
										hotelname   =   '".$hotelnames[$i]."',
										hotelurl    =   '".$videolinks[$i]."'
							";
							$wpdb->query($sql);
						}
					$i++;
					}
                 }  
                ?>
                <form action="#" method="post">
                <?php 
                foreach($hotelsArray as $hotels) {
                                    
                    foreach ($hotels as $key => $value) {
                ?>
                <tr>
                    <td><input type="hidden" id="hotelsid" name="hotelsid[]" value="<?php echo $value["@attributes"]["HotelID"]; ?>" ><?php echo $value["@attributes"]["HotelID"]; ?></td>
                    <td><input type="hidden" id="hotelsname" name="hotelsname[]" value="<?php echo $value["@attributes"]["Name"]; ?>"><?php echo $value["@attributes"]["Name"]; ?></td>
                    <td><input type="text" name="videolink[]" value="" class="form-control" id="Inputtext" placeholder="Pase Video link here"></td>
                </tr>
                <?php 
                } 
                } 
                ?>
                <?php submit_button('Save Settings'); ?>
                </form>
                </tbody>
            </table>
            <?php } ?>
        </div>
    </div>
       

</div>
