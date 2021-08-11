<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       muzammildev.com
 * @since      1.0.0
 *
 * @package    Travel_Booking
 * @subpackage Travel_Booking/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Travel_Booking
 * @subpackage Travel_Booking/public
 * @author     Muzammil <raja_muzammil95@hotmail.com>
 */
class Travel_Booking_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	public $_POST;

    public $hotelsArray;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Travel_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Travel_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


		wp_enqueue_style( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-fontawesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-slick', plugin_dir_url( __FILE__ ) . 'css/slick.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-slick-theme', plugin_dir_url( __FILE__ ) . 'css/slick-theme.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-main', plugin_dir_url( __FILE__ ) . 'css/travel-booking-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Travel_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Travel_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		
		wp_enqueue_script( $this->plugin_name.'-jquery', plugin_dir_url( __FILE__ ) . 'js/jquery-3.3.1.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name.'-bootstrap-min', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-slick', plugin_dir_url( __FILE__ ) . 'js/slick.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-main', plugin_dir_url( __FILE__ ) . 'js/travel-booking-public.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( $this->plugin_name.'-ajax', plugin_dir_url( __FILE__ ) . 'js/class-travel-booking-public-ajax.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name.'-ajax', ' my_ajax_object', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('_wpnonce')
        ));

	}

	public function vertical_booking_form_html() {
		ob_start();
	    session_start();

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
				changeMonth: true, 
    			changeYear: true, 
				dateFormat: 'yy-mm-dd',
				beforeShowDay: function(date){
					var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
					return [ availableDates.indexOf(string) != -1 ]
				}
			});
			$.datepicker.regional.sv = {
			closeText: 'Stäng',
			prevText: '&#xAB;Förra',
			nextText: 'Nästa&#xBB;',
			currentText: 'Idag',
			monthNames: [ 'januari', 'februari', 'mars', 'april', 'maj', 'juni',
			'juli', 'augusti', 'september', 'oktober', 'november', 'december' ],
			monthNamesShort: [ 'jan.', 'feb.', 'mars', 'apr.', 'maj', 'juni',
			'juli', 'aug.', 'sep.', 'okt.', 'nov.', 'dec.' ],
			dayNamesShort: [ 'sön', 'mån', 'tis', 'ons', 'tor', 'fre', 'lör' ],
			dayNames: [ 'söndag', 'måndag', 'tisdag', 'onsdag', 'torsdag', 'fredag', 'lördag' ],
			dayNamesMin: [ 'sö', 'må', 'ti', 'on', 'to', 'fr', 'lö' ],
			weekHeader: 'Ve',
			dateFormat: 'yy-mm-dd',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: '' };
			$.datepicker.setDefaults($.datepicker.regional.sv);
			});
			</script>"; ?>
			<style>
				.avre h5 { color: <?php echo get_option( 'labelfontcolor' ); ?>!important }
				.form .vart-form { background-color: <?php echo get_option( 'formbgcolor' ); ?> }
				.item-inner button { color: <?php echo get_option( 'buttontextcolor' ); ?>!important; border: 3px solid <?php echo get_option( 'formbuttonbgcolor' ); ?> !important; font-size: <?php echo get_option( 'buttontextsize' ); ?>; background-color: <?php echo get_option( 'formbuttonbgcolor' ); ?>!important; } 
				.item-inner button:hover{ color: <?php echo get_option( 'buttontexthovercolor' ); ?>!important; background-color:<?php echo get_option( 'formbuttonbghovercolor' ); ?> !important; color: <?php echo get_option( 'formbuttonbgcolor' ); ?> !important; } .ui-state-active { background-color:<?php echo get_option( 'calendarcolor' ); ?> !important; } .ala-inner a, .close-btn a { color: <?php echo get_option( 'formbgcolor' ); ?>; } .vart-form h4 { color: <?php echo get_option( 'formheadingcolor' ); ?>; font-size: <?php echo get_option( 'formheadingfontsize' ); ?>; }
				</style>

<?php
			}
	}

	function hotels_listing() {
		ob_start();
	    session_start(); ?>
		 <div class="hotels-wrapper">
    <div class="content_wrapper">
        <div class="sup_wrap">
			<div class="visible-form">
				<?php //echo do_shortcode("[search_results_booking_form]"); 
				include_once('partials/travel-booking-public-display.php');
				?>
			</div>
			<?php 
					$avreseort = $_SESSION['avreseort'];
					$departures = $_SESSION['departures'];
					$resmal = $_SESSION['resmal'];
					$destinations = $_SESSION['destinations'];
					$date = $_SESSION['date'];
					$travelers = $_SESSION['travelers'];
			
					// die($destinations);
			
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
								<urn:DepartureDate>'.$date.'</urn:DepartureDate>
								<urn:Departures>'.$avreseort.'</urn:Departures>
								<urn:AdultsNumber>'.$travelers.'</urn:AdultsNumber>
								<urn:Resorts>'.$resmal.'</urn:Resorts>
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
						if ($hotelsArray) {

			?>
            <div class="heading_top">
                <div class="heading_left">
                    <p>Din sökning</p>
                    <p> <?php if(!$departures == "") { echo $departures; } else { echo "Alla avreseorter"; } ?> - <?php if(!$destinations == "") { echo $destinations; } else { echo "Alla destinationer"; } ?>, <?php echo $date; ?></p>
                </div>
                <div class="heading_right">
                    <a href="javascript:void(0)" class="andra-sokning">Ändra sökning</a>
                </div>
            </div>
			<!--slider-->
			<div class="slider_outer">
                    <div class="your-class">
					<?php 
					$tranports = $array["GetHotelsResponse"]["Transports"]["TransportInformation"];
					foreach($tranports as $transport) :
						// echo '<pre>';
						// print_r($transport["@attributes"]);
						// echo '</pre>';
					?>
                        <div>
                            <!--slider_item-->
                            <div class="slider_item">
                                <a href="javascript:void(0)" class="transport-dates" data-fulldate="<?php echo $transport["FlightsInformation"]["FlightInformation"][0]["OutboundFlightInfo"]["@attributes"]["DepartureDate"]; ?>" data-departureid="<?php echo $transport["@attributes"]["DepartureID"]; ?>" data-arrivalid="<?php echo $resmal; ?>" data-travelersnum="<?php echo $travelers; ?>" data-imageurl="<?php echo plugin_dir_url( __FILE__ ); ?>css/ajax-loader.gif">
                                    <div class="date_wrap">
										<?php $transportDepartureDate = $transport["FlightsInformation"]["FlightInformation"][0]["OutboundFlightInfo"]["@attributes"]["DepartureDate"];
										$transportDeparturefullDate = date("d M Y", strtotime($transportDepartureDate));
										$transportDeparturenewDate = date("d F", strtotime($transportDepartureDate));
										$transportDeparturenewDay = date("D", strtotime($transportDepartureDate));
										?>
										<input type="hidden" class="full-date" value="<?php echo $transportDeparturefullDate; ?>">

										<?php 
										$departureDateTime = $transport["FlightsInformation"]["FlightInformation"][0]["OutboundFlightInfo"]["@attributes"]["DepartureTime"];
										$departureTime = substr($departureDateTime, 11, -3);
										?>
										<input type="hidden" class="departureTime" value="<?php echo $departureTime; ?>">

										<?php 
										$arrivalDateTime = $transport["FlightsInformation"]["FlightInformation"][0]["OutboundFlightInfo"]["@attributes"]["ArrivalTime"];
										$arrivalTime = substr($arrivalDateTime, 11, -3);
										?>
										<input type="hidden" class="arrivalTime" value="<?php echo $arrivalTime; ?>">

										<?php 
										$returndepartureDate = $transport["FlightsInformation"]["FlightInformation"][0]["HomeboundFlightInfo"]["@attributes"]["DepartureDate"];
										$returndeparturenewDate = date("d M Y", strtotime($returndepartureDate));
										?>
										<input type="hidden" class="returnDate" value="<?php echo $returndeparturenewDate; ?>">

										<?php 
										$returndepartureDateTime = $transport["FlightsInformation"]["FlightInformation"][0]["HomeboundFlightInfo"]["@attributes"]["DepartureTime"];
										$returndepartureTime = substr($returndepartureDateTime, 11, -3);
										?>
										<input type="hidden" class="returnDepartureTime" value="<?php echo $returndepartureTime; ?>">

										<?php
										$returnarrivalDateTime = $transport["FlightsInformation"]["FlightInformation"][0]["HomeboundFlightInfo"]["@attributes"]["ArrivalTime"];
										$returnarrivalTime = substr($returnarrivalDateTime, 11, -3);
										?>
										<input type="hidden" class="returnArrivalTime" value="<?php echo $returnarrivalTime; ?>">

                                        <p class="date"><?php echo $transportDeparturenewDate; ?></p><span><?php echo $transportDeparturenewDay; ?></span>
                                    </div>
                                    <div class="book_wrap">
		                                <p class="box_book_wrap-transp-from"><?php echo $transport["@attributes"]["DepartureName"]; ?></p>
                                        <p class="box_book_wrap-transp-sep"> - </p>
                                        <p class="box_book_wrap-transp-to"><?php echo $transport["@attributes"]["ArrivalName"]; ?> </p> 
                                    </div>
                                    <div class="cost_wrap">
                                        <!-- <p>Fullbokat</p> -->
                                    </div>
                                </a>
                            </div>
                        </div>
						<?php endforeach; ?>                       
                    </div>
                </div>
            <!--resv_wrap-->
            <div class="resv_wrap">
                <div class="part_wrap_one mt-15">
                    
                    <div class="aver_new_flie">
						<?php 
						$airLineName = $array["GetHotelsResponse"]["Transports"]["TransportInformation"][0]["FlightsInformation"]["FlightInformation"][0]["OutboundFlightInfo"]["@attributes"]["AirlineName"];

						$departureDate = $array["GetHotelsResponse"]["Transports"]["TransportInformation"][0]["FlightsInformation"]["FlightInformation"][0]["OutboundFlightInfo"]["@attributes"]["DepartureDate"];
						$departurenewDate = date("d M Y", strtotime($departureDate));
						
						$departureDateTime = $array["GetHotelsResponse"]["Transports"]["TransportInformation"][0]["FlightsInformation"]["FlightInformation"][0]["OutboundFlightInfo"]["@attributes"]["DepartureTime"];
						$departureTime = substr($departureDateTime, 11, -3);

                        $departureTimeSplit = str_split($departureTime);
            
						$arrivalDateTime = $array["GetHotelsResponse"]["Transports"]["TransportInformation"][0]["FlightsInformation"]["FlightInformation"][0]["OutboundFlightInfo"]["@attributes"]["ArrivalTime"];
						$arrivalTime = substr($arrivalDateTime, 11, -3);
	
						$departureName = $array["GetHotelsResponse"]["Transports"]["TransportInformation"][0]["@attributes"]["DepartureName"];

						$arrivalName = $array["GetHotelsResponse"]["Transports"]["TransportInformation"][0]["@attributes"]["ArrivalName"];
						?>
                        <span class="aver_wrap">AVRESA SÖNDAG <span class="departureDate"><?php echo $departurenewDate; ?></span></span>
                        <span class="time_wrap">
                            <span class="departure_time"><?php echo $departureTime; ?></span> - 
                            <span class="arrival_time"><?php echo $arrivalTime; ?></span>
                            <span class="duration_wrap"> (<span class="dhour">4</span> h <span class="dminute">0</span> m)</span>
                        </span>
                        <span class="loaction_wrap"><span class="departureName"><?php echo $departureName; ?></span> <i class="fa fa-arrow-right"></i> <span class="arrivalName"><?php echo $arrivalName; ?></span></span>
                    </div>
                </div>
                <div class="part_wrap_one mt-15">
                    <div class="aver_new_flie2">
					<?php 
						$returnAirLineName = $array["GetHotelsResponse"]["Transports"]["TransportInformation"][0]["FlightsInformation"]["FlightInformation"][0]["HomeboundFlightInfo"]["@attributes"]["AirlineName"];

						$returndepartureDate = $array["GetHotelsResponse"]["Transports"]["TransportInformation"][0]["FlightsInformation"]["FlightInformation"][0]["HomeboundFlightInfo"]["@attributes"]["DepartureDate"];
						$returndeparturenewDate = date("d M Y", strtotime($returndepartureDate));

						$returndepartureDateTime = $array["GetHotelsResponse"]["Transports"]["TransportInformation"][0]["FlightsInformation"]["FlightInformation"][0]["HomeboundFlightInfo"]["@attributes"]["DepartureTime"];
						$returndepartureTime = substr($returndepartureDateTime, 11, -3);
						
						$returnarrivalDateTime = $array["GetHotelsResponse"]["Transports"]["TransportInformation"][0]["FlightsInformation"]["FlightInformation"][0]["HomeboundFlightInfo"]["@attributes"]["ArrivalTime"];
						$returnarrivalTime = substr($returnarrivalDateTime, 11, -3);

						?>
                        <span class="aver_wrap">HEMRESA SÖNDAG <span class="returnarrivalDate"><?php echo $returndeparturenewDate; ?></span>
                        <span class="time_wrap">
                            <span class="return_departure"><?php echo $returndepartureTime; ?></span> - 
                            <span class="return_arrival"><?php echo $returnarrivalTime; ?></span>
                            <span class="duration_wrap"> (<span class="rdhour">2</span> h <span class="rdminute">0</span> m)</span> 
                        </span>
                        <span class="loaction_wrap"><span class="return_arrivalname"><?php echo $arrivalName; ?></span> <i class="fa fa-arrow-right"></i> <span class="return_departurename"><?php echo $departureName; ?></span></span>
                    </div>
                </div>
            </div>
			<div id="hotels-listing">
			
		<?php

				// hotel array sorting start
				foreach($hotelsArray as $hotels) {
						
					foreach ($hotels as $key => $value) {
						if(!$value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"]["@attributes"]["DiscountPrice1"] == "") {
							$sorted_hotels[$key]["discountprice"] =  $value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"]["@attributes"]["DiscountPrice1"];
						} else {
							$sorted_hotels[$key]["discountprice"] = $value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"][0]["@attributes"]["DiscountPrice1"];
						}
						$sorted_hotels[$key]["pictureID"] = $value["Pictures"]["Picture"][0]["@attributes"]["PictureID"];
						$sorted_hotels[$key]["Name"] =	$value["@attributes"]["Name"];
						$sorted_hotels[$key]["Stars"] = $value["@attributes"]["Stars"];
						$sorted_hotels[$key]["Description"]  = $value["Description"];
						$sorted_hotels[$key]["HotelID"] = $value["@attributes"]["HotelID"];
						$sorted_hotels[$key]["totalprice1"] = $value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"]["@attributes"]["Price1"]; 
						$sorted_hotels[$key]["totalprice2"] = $value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"][0]["@attributes"]["Price1"];
										
						$sorted_hotels[$key]["booked1"] = $value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"]["@attributes"]["HasFreeRooms"];
						$sorted_hotels[$key]["booked2"] = $value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"][0]["@attributes"]["HasFreeRooms"];
						$sorted_hotels[$key]["till-strand"] = $value["Facilities"]["Facility"][12]["Value"];
						$sorted_hotels[$key]["wifi"] = $value["Facilities"]["Facility"][26]["Value"];
						$sorted_hotels[$key]["restaurang"] = $value["Facilities"]["Facility"][31]["Value"];
						$sorted_hotels[$key]["till-bargata"] = $value["Facilities"]["Facility"][13]["Value"];
						$sorted_hotels[$key]["PriceListTransportAllotmentID"] = $value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"]["@attributes"]["PriceListTransportAllotmentID"];
                                                
						$sorted_hotels[$key]["PriceListTransportAllotmentID2"] = $value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"][0]["@attributes"]["PriceListTransportAllotmentID"];
						
					}
					}
					asort($sorted_hotels);
					// echo '<pre>';
					// print_r($sorted_hotels);
					// echo '<pre>';
					// hotel array sorting end

					foreach($sorted_hotels as $hotel) {
						?>
							
							<div class="tour_list">
								<div class="tour_img_wrap">
								<div class="tour_img-btn">
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-primary tour_btn" id="image-popup" data-toggle="modal" data-target="#VideoPop" data-hotelid="<?php echo $hotel["HotelID"]; ?>">
									  Fler bilder <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
									</button>

									<!-- Modal -->
									<div class="modal fade VideoPopup" id="VideoPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" 											aria-hidden="true">
									  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
										<div class="modal-content">
										  <div class="modal-body p-0">
											  <div class="image_slider">
                                             
											</div>
										  </div>
										</div>
									  </div>
									</div>
									<!-- Button trigger modal -->
									
									<button type="button" class="btn btn-primary tour_btn video_btn" data-toggle="modal" data-target="#VideoPop<?php echo $hotel["HotelID"] ?>">
									  Video <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
									</button>

								</div>
									<span><img alt="Hotell Vistasol Magaluf"
											src="https://booking.tourpaq.com/Media/GetPhoto.ashx?type=Hotel&photosize=960x495&photoid=<?php echo $hotel["pictureID"]; ?>"></span>
								</div>
								<div class="tour_cont_wrap">
									<div class="tour_head_wrap">
										<span class="tour_head_wrap_inner">
											<span class="key-rating"><?php echo $hotel["Name"]; ?></span> 
											<span class="value-rating rating rate-3-plus">
												<span class="screen-reader-text">
													(Hotellklass: 3+ stjärnor) 
												</span> 
												<?php 
													$n = $hotel["Stars"];
													//for ($i = 0; $i < $n; $i++) { 
													if($n == "3+")	{
												?>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-plus">+</span>
												<?php } elseif($n == 3) { ?>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<?php } elseif($n == "4+") { ?>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-plus">+</span>
												<?php } elseif($n == 4) { ?>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<?php } else { ?>
												<?php } ?>
											</span>
										</span>
									</div>
									<div class="disc_wrap_cont">
										<?php if(!empty($hotel["Description"])) { echo $hotel["Description"]; } ?>
                                        <?php
                                        $discountPrice = $hotel["discountprice"]; 
                                        ?> 
                                        <a class="txtcolor1" href="<?php echo site_url('/enda-paketdetalj'); ?>?hotel_id=<?php echo $hotel["HotelID"]; ?>&&price=<?php if(!$discountPrice == "") { echo $discountPrice; } else {  } ?>"
											target="_blank">Läs mer <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="tour_table_file">

										<div class="tour_detail_wrap">
											<span class="avs_wrap">Avstånd till strand</span> <span class="avs_wrap2"><?php echo $hotel["till-strand"]; ?> m</span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">WiFi</span> 
                                            <span class="avs_wrap2">
                                                <?php  $wifi = $hotel["wifi"];
                                                    if($wifi == "true") { echo "Ja"; } else { echo $wifi; }
                                            ?></span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Air conditioning</span> <span class="avs_wrap2">Ja</span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Pool</span> <span class="avs_wrap2">Ja</span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Restaurang</span> <span class="avs_wrap2">
											<?php if($hotel["restaurang"] == "true") { echo "Ja"; } else { echo "Nej"; } ?>
											
											</span>
										</div>
									</div>
									<div class="tour_table_file2">
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Balkong</span> <span class="avs_wrap2">Ja</span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Gym</span> <span class="avs_wrap2">Ja</span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Avstånd till bargata</span> <span class="avs_wrap2"><?php echo $hotel["till-bargata"]; ?> m</span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Bar</span> <span class="avs_wrap2">Ja</span>
										</div>
									</div>
									<div class="res_book_now">
										<!--<div class="offer price">-->
										<!--	TRYGGHETSPAKETET INGÅR-->
										<!--</div>-->
										<div class="price_wrap">
										    <?php 
										    $discountPrice =$hotel["discountprice"]; 
										    $totalPrice1 = $hotel["totalprice1"]; 
										    $totalPrice2 = $hotel["totalprice2"];
                                            
                                            $booked = $hotel["booked1"];
											$booked2 =  $hotel["booked2"];
                                            if($booked == "true" || $booked2 == "true"){
										    ?>
                                           <p class="price_wrap_style1"><?php if(!$discountPrice == "") { echo $discountPrice; } else { } ?>:- <span class="price_wrap_style1-end">/person</span></p>
                                                <p class="previous-price"><?php if(!$totalPrice1 == "") { echo $totalPrice1; } else { echo $totalPrice2; } ?>:-</p>
                                                <?php $PriceListTransportAllotmentID = $hotel["PriceListTransportAllotmentID"];
                                                
                                                $PriceListTransportAllotmentID2 = $hotel["PriceListTransportAllotmentID2"];
                                                ?>
                                                <p><a class="button book_bt"
                                                    href="
													<?php if ($travelers == 2) { ?>
													https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>&p=1&rno=1&pt=2&a=<?php echo $travelers; ?>&c=0&aa=&ca=
													<?php } elseif($travelers == 4) { ?>
													https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>&p=1&rno=1,1&pt=2,2&a=2,2&c=0&aa=&ca=
													<?php } elseif($travelers == 5) { ?>
													https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>&p=1&rno=1,1&pt=2,2&a=3,2&c=0&aa=&ca=
													<?php } elseif($travelers == 6) { ?>
														https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>&p=1&rno=1,1&pt=2,2&a=3,3&c=0&aa=&ca=
													<?php } elseif($travelers == 7) { ?>
														https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>&p=1&rno=1,1,1&pt=2,2,2&a=3,2,2&c=0&aa=&ca=
													<?php } elseif($travelers == 8) { ?>
														https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>&p=1&rno=1,1,1&pt=2,2,2&a=3,3,2&c=0&aa=&ca=
													<?php } elseif($travelers == 9) { ?>
														https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>&p=1&rno=1,1,1&pt=2,2,2&a=3,3,2&c=0&aa=&ca=
													<?php } else { ?>
														https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } else{ echo $PriceListTransportAllotmentID2; } ?>&p=1&rno=1&pt=2&a=<?php echo $travelers; ?>&c=0&aa=&ca=
													<?php } ?>
													">Boka</a></p>
                                            <?php
                                            } else {
                                            ?>
                                                
												<div class="price-list-hotels__hotel__soldout"></div>
                                      <?php } ?>
										</div>
									</div>
								</div>
							</div>
						<?php
						// echo '<pre>';
						// 	print_r($value);
						// 	echo '</pre>';
					} ?>
					<!-- Modal -->
					<?php 
									global $wpdb;
							$table_name = $wpdb->prefix . 'hotels';
									$results = $wpdb->get_results( "SELECT * FROM $table_name");
									foreach($results as $result) {
									?>
									<div class="modal fade VideoPopup" id="VideoPop<?php echo $result->hotelid; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" 											aria-hidden="true">
									  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
										<div class="modal-content">
										  <div class="modal-body p-0">
										  <?php
// 										  echo "<pre>";
// 										print_r($result);
// 										echo "</pre>"; ?>
<iframe width="100%" height="600" src="<?php echo $result->hotelurl; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<!-- 											  <iframe width="900" height="506" src="https://www.youtube.com/embed/t_DwxoC8_mQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
											 
										  </div>
										</div>
									  </div>
									</div>
									<?php	
										
											 } 

		 } else { ?>
			<div class="notfound">
			<h2>Hotell inte tillgängligt</h2>
			<a href="<?php echo site_url(); ?>">Back</a>
			</div>

		<?php	 
		 }
		?>
		</div>
		<style>
		 .txtcolor1, .offer.price, .price_wrap_style1  { color: <?php echo get_option( 'listingprimarycolor' ); ?>; }
		 .resv_wrap { box-shadow: inset 0 -5px 0 0 <?php echo get_option( 'listingprimarycolor' ); ?>; }
		.slider_item, .heading_top { background-color: <?php echo get_option( 'listingsecondarycolor' ); ?> }
		.key-rating, .hoptel_detail h2 { color: <?php echo get_option( 'listingheadingscolor' ); ?>; font-size: <?php echo get_option( 'listingheadingsfontsize' ); ?>; }
		.disc_wrap_cont { color: <?php echo get_option( 'listingparagraphcolor' ); ?>; font-size: <?php echo get_option( 'listingparagraphfontsize' ); ?>; } .slider_item:hover { background: <?php echo get_option( 'listingprimarycolor' ); ?>; }
		</style>
		<script>
		</script>
		 </div>
    </div>
  
    </div>
	<?php

		die();		
	}

	public function ajax_hotels() {
		$fullDate = $_POST["fullDate"];
		$departureId = $_POST["departureId"];
		$arrivalId = $_POST["arrivalId"];
		$travelersNum = $_POST["travelersNum"];
		
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
								<urn:DepartureDate>'.$fullDate.'</urn:DepartureDate>
								<urn:Departures>'.$departureId.'</urn:Departures>
								<urn:AdultsNumber>'.$travelersNum.'</urn:AdultsNumber>
								<urn:Resorts>'.$arrivalId.'</urn:Resorts>
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

							// 						hotel array sorting start
							foreach($hotelsArray as $hotels) {
									
								foreach ($hotels as $key => $value) {
									if(!$value["Offers"]["Departures"]["Departure"]["PriceItems"]["PriceItem"]["@attributes"]["DiscountPrice1"] == "") {
										$sorted_hotels[$key]["discountprice"] =  $value["Offers"]["Departures"]["Departure"]["PriceItems"]["PriceItem"]["@attributes"]["DiscountPrice1"];
									} elseif(!$value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"]["@attributes"]["DiscountPrice1"]) {
										$sorted_hotels[$key]["discountprice"] = $value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"]["@attributes"]["DiscountPrice1"];
									} else {
										$sorted_hotels[$key]["discountprice"] = $value["Offers"]["Departures"]["Departure"]["PriceItems"]["PriceItem"][0]["@attributes"]["DiscountPrice1"];
									}
									$sorted_hotels[$key]["pictureID"] = $value["Pictures"]["Picture"][0]["@attributes"]["PictureID"];
									$sorted_hotels[$key]["Name"] =	$value["@attributes"]["Name"];
									$sorted_hotels[$key]["Stars"] = $value["@attributes"]["Stars"];
									$sorted_hotels[$key]["Description"]  = $value["Description"];
									$sorted_hotels[$key]["HotelID"] = $value["@attributes"]["HotelID"];
									$sorted_hotels[$key]["totalprice1"] = $value["Offers"]["Departures"]["Departure"]["PriceItems"]["PriceItem"]["@attributes"]["Price1"]; 
									$sorted_hotels[$key]["totalprice2"] = $value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"]["@attributes"]["Price1"];
									$sorted_hotels[$key]["totalprice3"] = $value["Offers"]["Departures"]["Departure"]["PriceItems"]["PriceItem"][0]["@attributes"]["Price1"];
													
									$sorted_hotels[$key]["booked1"] = $value["Offers"]["Departures"]["Departure"]["PriceItems"]["PriceItem"]["@attributes"]["HasFreeRooms"];
									$sorted_hotels[$key]["booked2"] = $value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"]["@attributes"]["HasFreeRooms"];
									$sorted_hotels[$key]["booked3"] = $value["Offers"]["Departures"]["Departure"]["PriceItems"]["PriceItem"][0]["@attributes"]["HasFreeRooms"];
									$sorted_hotels[$key]["till-strand"] = $value["Facilities"]["Facility"][12]["Value"];
									$sorted_hotels[$key]["wifi"] = $value["Facilities"]["Facility"][26]["Value"];
									$sorted_hotels[$key]["restaurang"] = $value["Facilities"]["Facility"][31]["Value"];
									$sorted_hotels[$key]["till-bargata"] = $value["Facilities"]["Facility"][13]["Value"];
							
									$sorted_hotels[$key]["PriceListTransportAllotmentID"] = $value["Offers"]["Departures"]["Departure"]["PriceItems"]["PriceItem"]["@attributes"]["PriceListTransportAllotmentID"];                 
									$sorted_hotels[$key]["PriceListTransportAllotmentID2"] = $value["Offers"]["Departures"]["Departure"][0]["PriceItems"]["PriceItem"]["@attributes"]["PriceListTransportAllotmentID"];
									$sorted_hotels[$key]["PriceListTransportAllotmentID3"] = $value["Offers"]["Departures"]["Departure"]["PriceItems"]["PriceItem"][0]["@attributes"]["PriceListTransportAllotmentID"];
									
								}
								}
								asort($sorted_hotels);
								
								// hotel array sorting end
							
								foreach($sorted_hotels as $hotel) {
									?>
							
							<div class="tour_list">
								<div class="tour_img_wrap">
									<div class="tour_img-btn">
										<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary tour_btn" id="image-popup" data-toggle="modal"
											data-target="#VideoPop" data-hotelid="<?php echo $hotel["HotelID"]; ?>">
											Fler bilder <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
										</button>
							
										<!-- Modal -->
										<div class="modal fade VideoPopup" id="VideoPop" tabindex="-1" role="dialog"
											aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-body p-0">
														<div class="image_slider">
							
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- Button trigger modal -->
										<!-- 									<button type="button" class="btn btn-primary tour_btn video_btn" data-toggle="modal" data-target="#VideoPop2">
												  Video <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
												</button> -->
							
										<!-- Modal -->
										<!-- 									<div class="modal fade VideoPopup" id="VideoPop2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" 											aria-hidden="true">
												  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
													<div class="modal-content">
													  <div class="modal-body p-0"> -->
										<!-- <iframe width="100%" height="600" src="https://www.youtube.com/embed/X7R-q9rsrtU" frameborder="0" 															allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
										<!-- 										  </div>
													</div>
												  </div>
												</div> -->
									</div>
									<span><img alt="Hotell Vistasol Magaluf"
											src="https://booking.tourpaq.com/Media/GetPhoto.ashx?type=Hotel&photosize=960x495&photoid=<?php echo $hotel["pictureID"]; ?>"></span>
								</div>
								<div class="tour_cont_wrap">
									<div class="tour_head_wrap">
										<span class="tour_head_wrap_inner">
											<span class="key-rating"><?php echo $hotel["Name"]; ?></span>
											<span class="value-rating rating rate-3-plus">
												<span class="screen-reader-text">
													(Hotellklass: 3+ stjärnor)
												</span>
												<?php 
													$n = $hotel["Stars"];
													//for ($i = 0; $i < $n; $i++) { 
													if($n == "3+")	{
												?>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-plus">+</span>
												<?php } elseif($n == 3) { ?>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<?php } elseif($n == "4+") { ?>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-plus">+</span>
												<?php } elseif($n == 4) { ?>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<span aria-hidden="true" class="rating-star">★</span>
												<?php } else { ?>
												<?php } ?>
											</span>
										</span>
									</div>
									<div class="disc_wrap_cont">
										<?php if(!empty($hotel["Description"])) { echo $hotel["Description"]; } ?>
										<?php
													$discountPrice = $hotel["discountprice"]; 
													?>
										<a class="txtcolor1"
											href="<?php echo site_url('/enda-paketdetalj'); ?>?hotel_id=<?php echo $hotel["HotelID"]; ?>&&price=<?php if(!$discountPrice == "") { echo $discountPrice; } else {  } ?>"
											target="_blank">Läs mer <i class="fa fa-angle-double-right"></i></a>
									</div>
									<div class="tour_table_file">
							
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Avstånd till strand</span> <span
												class="avs_wrap2"><?php echo $hotel["till-strand"]; ?> m</span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">WiFi</span>
											<span class="avs_wrap2">
												<?php  $wifi = $hotel["wifi"];
																if($wifi == "true") { echo "Ja"; } else { echo $wifi; }
														?></span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Air conditioning</span> <span class="avs_wrap2">Ja</span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Pool</span> <span class="avs_wrap2">Ja</span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Restaurang</span> <span class="avs_wrap2">
												<?php if($hotel["restaurang"] == "true") { echo "Ja"; } else { echo "Nej"; } ?>
							
											</span>
										</div>
									</div>
									<div class="tour_table_file2">
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Balkong</span> <span class="avs_wrap2">Ja</span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Gym</span> <span class="avs_wrap2">Ja</span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Avstånd till bargata</span> <span
												class="avs_wrap2"><?php echo $hotel["till-bargata"]; ?> m</span>
										</div>
										<div class="tour_detail_wrap">
											<span class="avs_wrap">Bar</span> <span class="avs_wrap2">Ja</span>
										</div>
									</div>
									<div class="res_book_now">
										<!--<div class="offer price">-->
										<!--	TRYGGHETSPAKETET INGÅR-->
										<!--</div>-->
										<div class="price_wrap">
											<?php 
														$discountPrice =$hotel["discountprice"]; 
														$totalPrice1 = $hotel["totalprice1"]; 
														$totalPrice2 = $hotel["totalprice2"];
														$totalPrice3 = $hotel["totalprice3"];
														
														$booked = $hotel["booked1"];
														$booked2 =  $hotel["booked2"];
														$booked3 =  $hotel["booked3"];
														if($booked == "true" || $booked2 == "true"){
														?>
											<p class="price_wrap_style1"><?php if(!$discountPrice == "") { echo $discountPrice; } else { } ?>:-
												<span class="price_wrap_style1-end">/person</span></p>
											<p class="previous-price">
											<?php if(!$totalPrice1 == "") { echo $totalPrice1; } elseif(!$totalPrice2 == "") { echo $totalPrice2; } else { echo $totalPrice3; } ?>:-</p>
											<?php $PriceListTransportAllotmentID = $hotel["PriceListTransportAllotmentID"];
															
															$PriceListTransportAllotmentID2 = $hotel["PriceListTransportAllotmentID2"];
															$PriceListTransportAllotmentID3 = $hotel["PriceListTransportAllotmentID3"];
															?>
											<p><a class="button book_bt"
																							href="
																							<?php if ($travelersNum == 2) { ?>
																							https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>&p=1&rno=1&pt=2&a=<?php echo $travelersNum; ?>&c=0&aa=&ca=
																							<?php } elseif($travelersNum == 4) { ?>
																							https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>&p=1&rno=1,1&pt=2,2&a=2,2&c=0&aa=&ca=
																							<?php } elseif($travelersNum == 5) { ?>
																							https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>&p=1&rno=1,1&pt=2,2&a=3,2&c=0&aa=&ca=
																							<?php } elseif($travelersNum == 6) { ?>
																								https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>&p=1&rno=1,1&pt=2,2&a=3,3&c=0&aa=&ca=
																							<?php } elseif($travelersNum == 7) { ?>
																								https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>&p=1&rno=1,1,1&pt=2,2,2&a=3,2,2&c=0&aa=&ca=
																							<?php } elseif($travelersNum == 8) { ?>
																								https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>&p=1&rno=1,1,1&pt=2,2,2&a=3,3,2&c=0&aa=&ca=
																							<?php } elseif($travelersNum == 9) { ?>
																								https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>,<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>&p=1&rno=1,1,1&pt=2,2,2&a=3,3,2&c=0&aa=&ca=
																							<?php } else { ?>
																								https://uptours-dk-webbooking.tourpaq.com/DoBooking.aspx?pltaID=<?php  if(!$PriceListTransportAllotmentID == ""){ echo $PriceListTransportAllotmentID; } elseif(!$PriceListTransportAllotmentID2 == "") { echo $PriceListTransportAllotmentID2;  } else{ echo $PriceListTransportAllotmentID3; } ?>&p=1&rno=1&pt=2&a=<?php echo $travelersNum; ?>&c=0&aa=&ca=
																							<?php } ?>
																">Boka</a></p>
											<?php
														} else {
														?>
							
											<div class="price-list-hotels__hotel__soldout"></div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<?php
									// echo '<pre>';
									// 	print_r($value);
									// 	echo '</pre>';
								}		
							
							}

		
		die;
	}

    public function popup_images() {
        
         session_start();
         
         $avreseort = $_SESSION['avreseort'];
         $resmal = $_SESSION['resmal'];
         $date = $_SESSION['date'];
         $travelers = $_SESSION['travelers'];
 
         //die($avreseort);
 
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
                    <urn:DepartureDate>'.$date.'</urn:DepartureDate>
                    <urn:Departures>'.$avreseort.'</urn:Departures>
                    <urn:AdultsNumber>'.$travelers.'</urn:AdultsNumber>
                    <urn:ArrivalID>'.$resmal.'</urn:ArrivalID >
                    <urn:GetHotelDescriptions ShortDescription="1" HtmlDescription="1" AltHtmlDescription="1">1</urn:GetHotelDescriptions>
                    <urn:ShowAllHotels>1</urn:ShowAllHotels>
                    <urn:PageNumber>0</urn:PageNumber>
                    <urn:PageSize>20</urn:PageSize>
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
            $hotelId = $_POST['hotelid'];
            //echo $hotelId;
           
            foreach($hotelsArray as $hotels) {
                foreach ($hotels as $value) { 
                    if(in_array($hotelId, $value["@attributes"])){
                        // print_r($value["@attributes"]);
                        // exit;
                        $images = $value["Pictures"]["Picture"];
                        foreach($images as $image) { ?>
                            <div>
                                <img alt="Hotell Vistasol Magaluf"
                                src="https://booking.tourpaq.com/Media/GetPhoto.ashx?type=Hotel&photosize=000&photoid=<?php echo $image["@attributes"]["PictureID"]; ?>">
                            </div>
                            <?php
                        }
                    }
                }
            } 
                    
        die;
    }


	function single_listing() { 

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
			<urn:GetHotelByIDRequest>
				<urn:HotelID>'.$_GET["hotel_id"].'</urn:HotelID>
				<urn:AgencyID>122</urn:AgencyID>
                <urn:InvalidateCache>1</urn:InvalidateCache>
			</urn:GetHotelByIDRequest>
		</soapenv:Body>
		</soapenv:Envelope>',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: text/xml',
			'SOAPAction: urn:ws-tourpaq-com:AgencyOffer:v2/IAgencyOffer/GetHotelByID',
			'Authorization: Basic VVBUREs6MjUxMTM4ZDk1MDc0MjNlN2ZjYmU4YmUzMDMyMjUwMTA='
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3" , $response);
		$xml=new SimpleXMLElement($response);
		$body=$xml->xpath('//sBody')[0];
		$array = json_decode(json_encode((array)$body), TRUE);
		$hotelByIdArray = $array["GetHotelByIDResponse"]["Hotel"];
        // echo '<pre>';
		// print_r($array);
		// echo '</pre>';
        // exit;
		$pictureID = $hotelByIdArray["Pictures"]["Picture"][0]["@attributes"]["PictureID"];
		?>
		    <!--banner-->
			<div class="banner">
        <div class="banner_img">
            <img src="https://booking.tourpaq.com/Media/GetPhoto.ashx?type=Hotel&photosize=000&photoid=<?php echo $pictureID; ?>" style="position: relative; left: 0px;">
        </div>
        <div class="headline-video">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="banner_heading">
                            <h1>
                                <span><?php echo $hotelByIdArray["@attributes"]["Name"]; ?></span>
                            </h1>
                            <!-- Button trigger modal -->
									<button type="button" class="btn btn-primary tour_btn" id="image-popup" data-toggle="modal" data-target="#VideoPop" data-hotelid="<?php echo $hotelByIdArray["@attributes"]["HotelID"]; ?>">
									  Fler bilder <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
									</button>

									<!-- Modal -->
									<div class="modal fade VideoPopup" id="VideoPop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" 											aria-hidden="true">
									  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
										<div class="modal-content">
										  <div class="modal-body p-0">
											  <div class="image_slider">
                                             
											</div>
										  </div>
										</div>
									  </div>
									</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="price_outer">
                            <div class="pricer_list">
                                <p>Från: </p>
                                <h3><?php echo $_GET["price"]; ?>:-</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--contant-->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    
                    <div class="hoptel_detail">
						<span class="value-rating rating rate-3-plus">
                        <?php 
                        $n = $hotelByIdArray["Stars"];
                        for ($i = 0; $i < $n; $i++) { ?>
                        <span aria-hidden="true" class="rating-star">★</span>
                        <?php } ?>
                        <span aria-hidden="true" class="rating-plus">+</span>
                    </span>
                        <?php echo $hotelByIdArray["HtmlDescription"]; ?>
                    </div>
                </div>
                <!--deatil-info-->
                <div class="col-12">
                    <!--Accordion wrapper-->
                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                    <!-- Accordion card -->
                    <div class="card detail_info">
                        <!-- Card header -->
                        <div class="card-header" role="tab" id="headingOne1">
                            <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne3"
                                aria-expanded="true" aria-controls="collapseOne1">
                                <h5 class="mb-0">
                                    Hotellinformation<i class="fa fa-chevron-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>
                        <!-- Card body -->
                        <div id="collapseOne3" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
                            data-parent="#accordionEx">
                            <div class="card-body">
                                <div class="tour_table_file">
                                    <div class="tour_detail_wrap">
                                        <span class="avs_wrap">Avstånd till strand</span> <span class="avs_wrap2"><?php echo $hotelByIdArray["Facilities"]["Facility"][13]["Value"]; ?> m</span>
                                    </div>
                                    <div class="tour_detail_wrap">
                                    <span class="avs_wrap">Avstånd till bargata</span> <span class="avs_wrap2"><?php echo $hotelByIdArray["Facilities"]["Facility"][15]["Value"]; ?> m</span>
                                    </div>
                                    <div class="tour_detail_wrap">
                                        <span class="avs_wrap">WiFi</span> <span class="avs_wrap2"> <?php  $wifi = $hotelByIdArray["Facilities"]["Facility"][28]["Value"];
                                                    if($wifi == "true") { echo "Ja"; } else { echo $wifi; }
                                            ?></span>
                                    </div>
                                    <div class="tour_detail_wrap">
                                        <span class="avs_wrap">Air conditioning</span> <span class="avs_wrap2"><?php echo $hotelByIdArray["Facilities"]["Facility"][3]["Value"]; ?></span>
                                    </div>
                                    <div class="tour_detail_wrap">
                                        <span class="avs_wrap">Pool</span> <span class="avs_wrap2">Ja</span>
                                    </div>
                                    <div class="tour_detail_wrap">
                                        <span class="avs_wrap">Restaurang</span> <span class="avs_wrap2">Ja</span>
                                    </div>
                                    <div class="tour_detail_wrap">
                                        <span class="avs_wrap">Køleskab</span> <span class="avs_wrap2"><?php if($hotelByIdArray["Facilities"]["Facility"][30]["Value"] == "true") { echo "Ja"; } else { echo "Nej"; } ?></span>
                                    </div>
                                    <div class="tour_detail_wrap">
											<span class="avs_wrap">Bar</span> <span class="avs_wrap2">Ja</span>
									</div>
                                    <div class="tour_detail_wrap">
											<span class="avs_wrap">Gym</span> <span class="avs_wrap2">Ja</span>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->
                </div>
                <!-- Accordion wrapper -->
                </div>
                
            </div>
            </div>
        </div>

    </div>
	<style>
		.hoptel_detail h2 { color: <?php echo get_option( 'detailheadingscolor' ); ?>; font-size: <?php echo get_option( 'detailheadingsfontsize' ); ?>; }
		.hoptel_detail { color: <?php echo get_option( 'detailparagraphcolor' ); ?>; font-size: <?php echo get_option( 'detailparagraphfontsize' ); ?>; }
	</style>
	<?php

		die();		
	}


}//End of Class


?>
