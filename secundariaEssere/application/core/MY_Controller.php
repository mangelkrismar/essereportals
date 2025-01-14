<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_controller extends CI_Controller{
	public $bandera_movil = false;
	public $device = "pc";

	public $paises = array(	

		"Afganistán" => "AF",
		"Albania" => "AL",
		"Alemania" => "DE",
		"Andorra" => "AD",
		"Angola" => "AO",
		"Anguila" => "AI",
		"Antártida" => "AQ",
		"Antigua y Barbuda" => "AG",
		"Antillas Holandesas" => "AN",
		"Arabia Saudita" => "SA",
		"Argelia" => "DZ",
		"Argentina" => "AR",
		"Armenia" => "AM",
		"Aruba" => "AW",
		"Australia" => "AU",
		"Austria" => "AT",
		"Azerbaiyán" => "AZ",
		"Bahamas" => "BS",
		"Bahrein" => "BH",
		"Bangladesh" => "BD",
		"Barbados" => "BB",
		"Bélgica" => "BE",
		"Belice" => "BZ",
		"Benin" => "BJ",
		"Bermuda" => "BM",
		"Bielorrusia" => "BY",
		"Bolivia" => "BO",
		"Bosnia y Herzegovina" => "BA",
		"Botswana" => "BW",
		"Brasil" => "BR",
		"Brunei Darussalam" => "BN",
		"Bulgaria" => "BG",
		"Burkina Faso" => "BF",
		"Burundi" => "BI",
		"Bután" => "BT",
		"Cabo Verde" => "CV",
		"Camboya" => "KH",
		"Camerún" => "CM",
		"Canadá" => "CA",
		"Chad" => "TD",
		"Chile" => "CL",
		"China" => "CN",
		"Chipre" => "CY",
		"Colombia" => "Co",
		"Comoras" => "KM",
		"Congo" => "CG",
		"Congo, República Democrática del" => "CD",
		"Corea del Norte" => "KP",
		"Corea del Sur" => "KR",
		"Costa de Marfil" => "CI",
		"Costa Rica" => "CR",
		"Croacia" => "HR",
		"Cuba" => "CU",
		"Dinamarca" => "DK",
		"Djibouti" => "DJ",
		"Dominica" => "DM",
		"Ecuador" => "EC",
		"Egipto" => "EG",
		"El Salvador" => "SV",
		"El Vaticano" => "VA",
		"Emiratos Árabes Unidos" => "AE",
		"Eritrea" => "ER",
		"Eslovaquia" => "SK",
		"Eslovenia" => "SI",
		"España" => "ES",
		"Estados Unidos" => "US",
		"Estonia" => "EE",
		"Etiopía" => "ET",
		"Federación Rusa" => "RU",
		"Fiji" => "FJ",
		"Filipinas" => "PH",
		"Finlandia" => "FI",
		"Francia" => "FR",
		"Francia Metropolitana" => "FX",
		"Gabón" => "GA",
		"Gales" => "WA",
		"Gambia" => "GM",
		"Georgia" => "GE",
		"Georgia del Sur e Islas Sandwich del Sur" => "GS",
		"Ghana" => "GH",
		"Gibraltar" => "GI",
		"Granada" => "GD",
		"Grecia" => "GR",
		"Groenlandia" => "GL",
		"Guadalupe" => "GP",
		"Guam" => "GU",
		"Guatemala" => "GT",
		"Guernsey" => "GG",
		"Guinea" => "GN",
		"Guinea-Bissau" => "GW",
		"Guinea Ecuatorial" => "GQ",
		"Guyana" => "GY",
		"Guyana Francesa" => "GF",
		"Haití" => "HT",
		"Holanda" => "NL",
		"Honduras" => "HN",
		"Hong Kong" => "HK",
		"Hungría" => "HU",
		"India" => "IN",
		"Indonesia" => "ID",
		"Irak" => "IQ",
		"Irán" => "IR",
		"Irlanda" => "IE",
		"Isla de Man" => "IM",
		"Islandia" => "IS",
		"Islas Åland" => "AX",
		"Islas Bouvet" => "BV",
		"Islas Caimán" => "KY",
		"Islas Cocos" => "CC",
		"Islas Cook" => "CK",
		"Islas de Navidad" => "CX",
		"Islas Faroe" => "FO",
		"Islas Heard y McDonald" => "HM",
		"Islas Malvinas" => "FK",
		"Islas Marianas del Norte" => "MP",
		"Islas Marshall" => "MH",
		"Islas Norfolk" => "NF",
		"Islas Salomón" => "SB",
		"Islas Svalbard y Jan Mayen" => "SJ",
		"Islas Turcas y Caicos" => "TC",
		"Islas Vírgenes (Americanas)" => "VI",
		"Islas Vírgenes (Británícas)" => "VG",
		"Islas Wallis y Futuna" => "WF",
		"Israel" => "IL",
		"Italia" => "IT",
		"Jamahiriya Árabe Libia" => "LY",
		"Jamaica" => "JM",
		"Japón" => "JP",
		"Jersey" => "JE",
		"Jordania" => "JO",
		"Kazajstán" => "KZ",
		"Kenia" => "KE",
		"Kirguistán" => "KG",
		"Kiribati" => "KI",
		"Kosovo" => "KO",
		"Kuwait" => "KW",
		"Laos" => "LA",
		"Latvia" => "LV",
		"Lesotho" => "LS",
		"Líbano" => "LB",
		"Liberia" => "LR",
		"Liechtenstein" => "LI",
		"Lituania" => "LT",
		"Luxemburgo" => "LU",
		"Macao" => "MO",
		"Macedonia" => "MK",
		"Madagascar" => "MG",
		"Malasia" => "MY",
		"Malawi" => "MW",
		"Maldivas" => "MV",
		"Mali" => "ML",
		"Malta" => "MT",
		"Marruecos" => "MA",
		"Martinica" => "MQ",
		"Mauricio" => "MU",
		"Mauritania" => "MR",
		"Mayotte" => "YT",
		"México" => "MX",
		"Micronesia" => "FM",
		"Moldovia" => "MD",
		"Mónaco" => "MC",
		"Mongolia" => "MN",
		"Montenegro" => "ME",
		"Montserrat" => "MS",
		"Mozambique" => "MZ",
		"Myanmar" => "MM",
		"Namibia" => "NA",
		"Naurú" => "NR",
		"Nepal" => "NP",
		"Nicaragua" => "NI",
		"Níger" => "NE",
		"Nigeria" => "NG",
		"Niue" => "NU",
		"Noruega" => "NO",
		"Nueva Caledonia" => "NC",
		"Nueva Zelandia" => "NZ",
		"Omán" => "OM",
		"Pakistán" => "PK",
		"Palau" => "PW",
		"Palestina" => "PS",
		"Panamá" => "PA",
		"Papúa Nueva Guinea" => "PG",
		"Paraguay" => "PY",
		"Perú" => "PE",
		"Pitcairn" => "PN",
		"Polinesia Francesa" => "PF",
		"Polonia" => "PL",
		"Portugal" => "PT",
		"Puerto Rico" => "PR",
		"Qatar" => "QA",
		"Reino Unido" => "GB",
		"República Centroafricana" => "CF",
		"República Checa" => "CZ",
		"República Dominicana" => "DO",
		"Reunión" => "RE",
		"Ruanda" => "RW",
		"Rumania" => "RO",
		"Sahara Occidental" => "EH",
		"Saint Barthélemy" => "BL",
		"Samoa" => "WS",
		"Samoa Americana" => "AS",
		"San Cristóbal Nevis" => "KN",
		"San Marino" => "SM",
		"San Martín" => "MF",
		"San Pedro y Miquelon" => "PM",
		"Santa Helena" => "SH",
		"Santa Lucía" => "LC",
		"Santo Tomé y Príncipe" => "ST",
		"San Vincente y Las Granadinas" => "VC",
		"Senegal" => "SN",
		"Serbia" => "RS",
		"Serbia y Montenegro" => "CS",
		"Seychelles" => "SC",
		"Sierra Leona" => "SL",
		"Singapur" => "SG",
		"Siria" => "SY",
		"Somalía" => "SO",
		"Sri Lanka" => "LK",
		"Sudáfrica" => "ZA",
		"Sudán" => "SD",
		"Suecia" => "SE",
		"Suiza" => "CH",
		"Surinam" => "SR",
		"Swazilandia" => "SZ",
		"Tailandia" => "TH",
		"Taiwán" => "TW",
		"Tanzania" => "TZ",
		"Tayikistán" => "TJ",
		"Territorio Británico del Océano Índico" => "IO",
		"Territorios Franceses del Sur" => "TF",
		"Timor-Leste" => "TL",
		"Timor Oriental" => "TP",
		"Togo" => "TG",
		"Tokelau" => "TK",
		"Tonga" => "TO",
		"Trinidad y Tobago" => "TT",
		"Túnez" => "TN",
		"Turkmenistán" => "TM",
		"Turquía" => "TR",
		"Tuvalu" => "TV",
		"Ucrania" => "UA",
		"Uganda" => "UG",
		"United States Minor Outlying Islands" => "UM",
		"Uruguay" => "UY",
		"Uzbekistan" => "UZ",
		"Vanuatu" => "VU",
		"Venezuela" => "VE",
		"Vietnam" => "VN",
		"Yemen" => "YE",
		"Zaire" => "ZR",
		"Zambia" => "ZM",
		"Zimbaw" => "ZW"	
	);

	function My_controller(){

		parent::__construct();
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$this->bandera_movil = true;
			$this->device = 'movil';
		}
		else if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		   	$this->bandera_movil = true;
		   	$this->device = 'movil';
		}
	}
	public function getRealIP() {
	if (!empty($_SERVER['HTTP_CLIENT_IP']))


	return $_SERVER['HTTP_CLIENT_IP'];

		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))return $_SERVER['HTTP_X_FORWARDED_FOR'];

		return $_SERVER['REMOTE_ADDR'];	
	}	 

	public function obtener_demos($tipo_demo)    {
		$this->load->model('config_model');
		$this->load->model('apps_model');
		$existe = $this->config_model->obtener_apps_demo($tipo_demo);
		$apps = array();
		if($existe != null){
			$existe = $existe->result();
			foreach($existe as $appDemo){
				$datos_app = $this->apps_model->obtener_app_individual($appDemo->prefijo);
				array_push($apps, $datos_app);
			}
		}
		return $apps;   
	}    

	public function obtener_apps_demo($tipo_d)    {
		$tipo_demo = $tipo_d;
		$apps = $this->obtener_demos($tipo_demo);
		foreach($apps as $app){
			foreach($app as $dato_app){
		    	switch($dato_app->categoria){
					case "lectura":
						$img = "p_recienteiconlectura.png";
						break;
					case "video":
						$img = "p_recienteiconvideo.png";
						break;
					case "aplicacion":
						$img = "p_recienteiconaplicacion.png";
						break;
					case "aplicacionL":
						$img = "p_recienteiconaplicacionL.png";
						break;
					case "evaluacionC":
						$img = "p_recienteiconevaluacionC.png";
						break;
					case "evaluacionE":
						$img = "p_recienteiconevaluacionE.png";
						break;
			    }
		   ?>
			
				<div class="p_recientebox" onclick = "playDemo(<?=$dato_app -> id_aplicacion?>)" rel = "<?=$dato_app -> id_aplicacion?>" prefijo = "<?=$dato_app -> prefijo?>" nombre = "<?=$dato_app -> nombre?>" tipoapp = "<?=$dato_app -> tipo_aplicacion?>">
					<div class="p_recienteboximg">
						<!--style="background-image:url(<?=base_url()?>src/img/miniaturas/<?=$contador?>.png)"-->
						<div class="p_recienteboxminiatura" style="background-image:url(http://192.168.1.15/KrismarApps/src/sistema/img/miniatura/<?=$dato_app -> prefijo?>.png)">
							<img src = ""/>
							<div class="p_recienteboxicon" style = "background-image:url(<?=base_url()?>src/img/<?=$img?>)"></div>
							<div class="p_recienteboxlight"></div>
							<div class="p_recienteinfo">
								<div class="p_recienteinfoplay">
									<div class="p_recienteinfoplayicon" onclick = "playDemo(<?=$dato_app -> id_aplicacion?>)"></div>
								</div>
								<div class="p_recienteinfotitle">Title</div>
								<div class="p_recienteinfoobjetivos">Objetivos</div>
								<div class="p_recienteinfoobjetivos">Objetivos</div>
							</div>
						</div>
					</div>
					<div class="p_recienteboxtxt"><?=$dato_app -> nombre?></div>
		    	</div>
		    
		    <?php
			}
		}    

	}
}