<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       muzammildev.com
 * @since      1.0.0
 *
 * @package    Travel_Booking
 * @subpackage Travel_Booking/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
if ( isset( $_POST['submit'] ) ) {
			$avreseort = $_POST['avreseort'];
			$resmal = $_POST['resmal'];
			$date = $_POST['date'];
			$travelers = $_POST['travelers'];

			$_SESSION['avreseort'] = $_POST['avreseort'];
			$_SESSION['departures'] = $_POST['departures'];
			$_SESSION['resmal'] = $_POST['resmal'];
			$_SESSION['destinations'] = $_POST['destinations'];
			$_SESSION['date'] = $_POST['date'];
			$_SESSION['travelers'] = $_POST['travelers'];

			echo '<script>window.location.href="'.site_url().'/sokresultat-paketbokning/";</script>';
		
		}else{ ?>

		<div class="vart-vill form <?php if(get_option( 'formstyle' ) == "horizontal-form"){ ?>horizontal-inner<?php } ?>">
		<?php
		echo '<div class="vart-form">';
		echo  '<h4>Vart vill du resa?</h4>';
		echo '<div class="vart-inner ">';
		echo '<form id="tbform" class="custom_form" method="POST">';
		echo '<div class="avre multiselect-container">';
		echo '<h5>Avreseort</h5>';
		echo '<button type="button" id="avreseort" class="btn btn-primary" data-toggle="collapse" data-target="#demo"><span>Välj</span><i class="fa fa-caret-down" aria-hidden="true"></i></button>';
		echo '<div id="demo" class="collapse arvi-form avreseort">';
		echo '<div class="form_outer-open">';
		echo '<div class="ala">';
		echo '<div class="ala-inner">
			<a  href="javascript:void(0)" onclick="selectAll(\'avreseort\')">Valj Alla <i class="fa fa-check-square-o" aria-hidden="true"></i></a>
			<a  href="javascript:void(0)" onclick="deSelectAll(\'avreseort\')">Avmarkera alla <i class="fa fa-times" aria-hidden="true"></i></a>
		</div>';
		echo '<div class="close-btn">
			<a href=""><i class="fa fa-times" aria-hidden="true"></i></a>
		</div>';
		echo '</div>';
		echo '<input type="hidden" class="multiselect-names" name="departures" value="">';
		echo '<input type="hidden" class="multiselect-values" name="avreseort" value="">';
		// get departures
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
			<urn:GetDeparturesRequest>
				<urn:AgencyID>122</urn:AgencyID>
			</urn:GetDeparturesRequest>
		</soapenv:Body>
		</soapenv:Envelope>',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: text/xml',
			'SOAPAction: urn:ws-tourpaq-com:AgencyOffer:v2/IAgencyOffer/GetDepartures',
			'Authorization: Basic VVBUREs6MjUxMTM4ZDk1MDc0MjNlN2ZjYmU4YmUzMDMyMjUwMTA='
		),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3" , $response);
		$xml = new SimpleXMLElement($response);
		$body=$xml->xpath('//sBody')[0];
		$arr = json_decode($response, TRUE);
		$body = $body->GetDeparturesResponse;
		foreach($body as $departures) {
			foreach ($departures as $key => $value) {
				echo '<div class="form-check">';
				echo '<input type="checkbox" value="'.$value->DepartureID.'" data-title="'.$value->Name.'" class="form-check-input multiselect-checkbox" id="examplecheck'.$value->DepartureID.'">';
				echo '<label for="examplecheck'.$value->DepartureID.'" class="form-check-level">'.$value->Name.'</label>';
				echo '</div>';
			}
		}
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo '<div class="avre multiselect-container">';
		echo '<h5>Resmål</h5>';
		echo '<button type="button" id="resmal" class="btn btn-primary" data-toggle="collapse" data-target="#demo1"><span>Välj</span><i class="fa fa-caret-down" aria-hidden="true"></i></button>';
			echo '<div id="demo1" class="collapse arvi-form resmal">';
			echo '<div class="form_outer-open">';
				echo '<div class="ala">';
					echo '<div class="ala-inner">
						<a href="javascript:void(0)" onclick="selectAll(\'resmal\')">Valj Alla <i class="fa fa-check-square-o" aria-hidden="true"></i></a>
						<a href="javascript:void(0)" onclick="deSelectAll(\'resmal\')">Avmarkera alla <i class="fa fa-times" aria-hidden="true"></i></a>
					</div>';
					echo '<div class="close-btn">
						<a href=""> <i class="fa fa-times" aria-hidden="true"></i></a>
					</div>';
					echo '</div>';
					echo '<input type="hidden" class="multiselect-names" name="destinations" value="">';
					echo '<input type="hidden" class="multiselect-values" name="resmal" value="">';
					// get destinations
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
						<urn:GetResortsRequest>
							<urn:AgencyID>122</urn:AgencyID>
						</urn:GetResortsRequest>
					</soapenv:Body>
					</soapenv:Envelope>',
					CURLOPT_HTTPHEADER => array(
						'Content-Type: text/xml',
						'SOAPAction: urn:ws-tourpaq-com:AgencyOffer:v2/IAgencyOffer/GetResorts',
						'Authorization: Basic VVBUREs6MjUxMTM4ZDk1MDc0MjNlN2ZjYmU4YmUzMDMyMjUwMTA='
					),
					));

					$response = curl_exec($curl);

					curl_close($curl);
					//echo $response;
					$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3" , $response);
					$xml=new SimpleXMLElement($response);
					$body=$xml->xpath('//sBody')[0];
					$arr = json_decode($response, TRUE);
					$body = $body->GetResortsResponse;
			  		
					foreach($body as $destination) {
						foreach ($destination as $key => $value) {
					echo '<div class="form-check">';
					echo ' <input type="checkbox" value="'.$value->ResortID.'" data-title="'.$value->Name.'" class="form-check-input multiselect-checkbox" id="examplecheck'.$value->ResortID.'">';
					echo '<label for="examplecheck'.$value->ResortID.'" class="form-check-level">'.$value->Name.'</label>';
					echo '</div>';
						}
					}
					echo '</div>';
					echo '</div>';
					echo '</div>';
		echo '<div class="avre calender">';
		echo '<h5>Datum</h5>';
			echo '<div class="form-group">';
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
        			<urn:GetAvailableDaysRequest>
        			
        				<urn:DepartureDate>2021-07-05</urn:DepartureDate>
        				<urn:AdultsNumber>4</urn:AdultsNumber>
        				<urn:AgencyID>122</urn:AgencyID>
        
        				<urn:IntervalID>0</urn:IntervalID>
        
        			</urn:GetAvailableDaysRequest>
        		</soapenv:Body>
        		</soapenv:Envelope>',
        		CURLOPT_HTTPHEADER => array(
        			'Content-Type: text/xml',
        			'SOAPAction: urn:ws-tourpaq-com:AgencyOffer:v2/IAgencyOffer/GetAvailableDays',
        			'Authorization: Basic VVBUREs6MjUxMTM4ZDk1MDc0MjNlN2ZjYmU4YmUzMDMyMjUwMTA='
        		),
        		));
        
        		$response = curl_exec($curl);

        		curl_close($curl);
        		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3" , $response);
        			$xml=new SimpleXMLElement($response);
        			$body=$xml->xpath('//sBody')[0];
        			$array = json_decode(json_encode((array)$body), TRUE);
        			$GetAvailableDaysArray = $array["GetAvailableDaysResponse"]["Departures"]["DepartureDate"];
        // 			echo '<pre>';
        // 			print_r($GetAvailableDaysArray);
        // 			echo '<pre>';
			echo '<input type="text" name="date" id="datepicker" value="'.$GetAvailableDaysArray[0].'" placeholder="yy-mm-dd" autocomplete="off">';
			echo '</div>';
			echo '</div>';
		echo '<div class="avre">';
		echo '<div class="form-group">';
		echo '<h5>Resenärer</h5>';
			echo '<select class="form-control" name="travelers" id="exampleFormControlSelect1">';
					echo '<option value="1">1 Resenär</option>';
					echo '<option  value="2" selected>2 Resenärer</option>';
					echo '<option  value="3">3 Resenärer</option>';
					echo '<option  value="4">4 Resenärer</option>';
					echo '<option  value="5">5 Resenärer</option>';
					echo '<option  value="6">6 Resenärer</option>';
					echo '<option  value="7">7 Resenärer</option>';
					echo '<option  value="8">8 Resenärer</option>';
					echo '<option  value="9">9 Resenärer</option>';
					echo '<option  value="10">10 Resenärer</option>';
					echo '<option  value="11">11 Resenärer</option>';
					echo '<option  value="12">12 Resenärer</option>';
					echo '</select>';
					echo '</div>';
					echo '</div>';
		echo '<div class="item-inner">';
		// echo '<input type="hidden" name="action" value="booking_form">';
		echo '<button type="submit" name="submit">Sök</button>';
		echo '</div>';
		echo '</div>';
		echo'</form>';
		echo '</div>';
		echo '</div>';
		
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
			<urn:GetAvailableDaysRequest>
			
				<urn:DepartureDate>2021-07-05</urn:DepartureDate>
				<urn:AdultsNumber>4</urn:AdultsNumber>
				<urn:AgencyID>122</urn:AgencyID>

				<urn:IntervalID>0</urn:IntervalID>

			</urn:GetAvailableDaysRequest>
		</soapenv:Body>
		</soapenv:Envelope>',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: text/xml',
			'SOAPAction: urn:ws-tourpaq-com:AgencyOffer:v2/IAgencyOffer/GetAvailableDays',
			'Authorization: Basic VVBUREs6MjUxMTM4ZDk1MDc0MjNlN2ZjYmU4YmUzMDMyMjUwMTA='
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3" , $response);
			$xml=new SimpleXMLElement($response);
			$body=$xml->xpath('//sBody')[0];
			$array = json_decode(json_encode((array)$body), TRUE);
			$GetAvailableDaysArray = $array["GetAvailableDaysResponse"]["Departures"]["DepartureDate"];
			// echo '<pre>';
			// print_r($GetAvailableDaysArray);
			// echo '<pre>';
			$AvailableDays = "'".implode("','",$GetAvailableDaysArray)."'";
		
			echo "<script>
			jQuery(document).ready(function($) {
			var availableDates = [$AvailableDays];
			$('#datepicker').datepicker({
				showWeek: true,
				dateFormat: 'yy-mm-dd',
				beforeShowDay: function(date){
					var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
					return [ availableDates.indexOf(string) != -1 ]
				}
			});
			});
			</script>"; ?>
			<style>
				.avre h5 { color: <?php echo get_option( 'labelfontcolor' ); ?>!important }
				.form .vart-form { background-color: <?php echo get_option( 'formbgcolor' ); ?> }
				.item-inner button { color: <?php echo get_option( 'buttontextcolor' ); ?>!important; border: 3px solid <?php echo get_option( 'formbuttonbgcolor' ); ?>; font-size: <?php echo get_option( 'buttontextsize' ); ?>; background-color: <?php echo get_option( 'formbuttonbgcolor' ); ?>!important; } 
				.item-inner button:hover{ background-color:<?php echo get_option( 'formbuttonbghovercolor' ); ?> !important; color: <?php echo get_option( 'formbuttonbgcolor' ); ?> !important; }
				</style>

<?php
			}