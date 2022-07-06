<?php defined( 'ABSPATH' ) || exit;

if( ! class_exists('CSH_Common')){

  class CSH_Common {


    function __construct(){

        add_action('init',function(){

          if( ! is_admin() ):

            add_filter( 'pre_option_show_on_front', array( $this,'static_front_page' ) );
            add_filter( 'pre_option_page_on_front', array( $this,'set_page_for_country' ) );

          endif;

        });

        add_action( 'init', array($this,'csh_i18n') );

    }



    function static_front_page(){
       return 'page';
    }


    function set_page_for_country( $val ){

      if( $country = $this->get_user_country()) {

        $country = strtolower($country);

        if( $page_id = get_option('page_on_front_'.$country) ) {

          $page_id = intval($page_id);

          if( 'publish' == get_post_status ( $page_id ) && 'page' == get_post_type($page_id)) {

              return $page_id;
          }

        }

       }

       return $val;
    }


    function get_countries( $country_code = '' ){

          $countries=array('AF'=>'AFGHANISTAN','AL'=>'ALBANIA','DZ'=>'ALGERIA','AS'=>'AMERICANSAMOA','AD'=>'ANDORRA','AO'=>'ANGOLA','AI'=>'ANGUILLA','AQ'=>'ANTARCTICA','AG'=>'ANTIGUAANDBARBUDA','AR'=>'ARGENTINA','AM'=>'ARMENIA','AW'=>'ARUBA','AU'=>'AUSTRALIA','AT'=>'AUSTRIA','AZ'=>'AZERBAIJAN','BS'=>'BAHAMAS','BH'=>'BAHRAIN','BD'=>'BANGLADESH','BB'=>'BARBADOS','BY'=>'BELARUS','BE'=>'BELGIUM','BZ'=>'BELIZE','BJ'=>'BENIN','BM'=>'BERMUDA','BT'=>'BHUTAN','BO'=>'BOLIVIA','BA'=>'BOSNIAANDHERZEGOVINA','BW'=>'BOTSWANA','BV'=>'BOUVETISLAND','BR'=>'BRAZIL','IO'=>'BRITISHINDIANOCEANTERRITORY','BN'=>'BRUNEIDARUSSALAM','BG'=>'BULGARIA','BF'=>'BURKINAFASO','BI'=>'BURUNDI','KH'=>'CAMBODIA','CM'=>'CAMEROON','CA'=>'CANADA','CV'=>'CAPEVERDE','KY'=>'CAYMANISLANDS','CF'=>'CENTRALAFRICANREPUBLIC','TD'=>'CHAD','CL'=>'CHILE','CN'=>'CHINA','CX'=>'CHRISTMASISLAND','CC'=>'COCOS(KEELING)ISLANDS','CO'=>'COLOMBIA','KM'=>'COMOROS','CG'=>'CONGO','CD'=>'CONGO,THEDEMOCRATICREPUBLICOFTHE','CK'=>'COOKISLANDS','CR'=>'COSTARICA','CI'=>'COTEDIVOIRE','HR'=>'CROATIA','CU'=>'CUBA','CY'=>'CYPRUS','CZ'=>'CZECHREPUBLIC','DK'=>'DENMARK','DJ'=>'DJIBOUTI','DM'=>'DOMINICA','DO'=>'DOMINICANREPUBLIC','TP'=>'EASTTIMOR','EC'=>'ECUADOR','EG'=>'EGYPT','SV'=>'ELSALVADOR','GQ'=>'EQUATORIALGUINEA','ER'=>'ERITREA','EE'=>'ESTONIA','ET'=>'ETHIOPIA','FK'=>'FALKLANDISLANDS(MALVINAS)','FO'=>'FAROEISLANDS','FJ'=>'FIJI','FI'=>'FINLAND','FR'=>'FRANCE','GF'=>'FRENCHGUIANA','PF'=>'FRENCHPOLYNESIA','TF'=>'FRENCHSOUTHERNTERRITORIES','GA'=>'GABON','GM'=>'GAMBIA','GE'=>'GEORGIA','DE'=>'GERMANY','GH'=>'GHANA','GI'=>'GIBRALTAR','GR'=>'GREECE','GL'=>'GREENLAND','GD'=>'GRENADA','GP'=>'GUADELOUPE','GU'=>'GUAM','GT'=>'GUATEMALA','GN'=>'GUINEA','GW'=>'GUINEA-BISSAU','GY'=>'GUYANA','HT'=>'HAITI','HM'=>'HEARDISLANDANDMCDONALDISLANDS','VA'=>'HOLYSEE(VATICANCITYSTATE)','HN'=>'HONDURAS','HK'=>'HONGKONG','HU'=>'HUNGARY','IS'=>'ICELAND','IN'=>'INDIA','ID'=>'INDONESIA','IR'=>'IRAN,ISLAMICREPUBLICOF','IQ'=>'IRAQ','IE'=>'IRELAND','IL'=>'ISRAEL','IT'=>'ITALY','JM'=>'JAMAICA','JP'=>'JAPAN','JO'=>'JORDAN','KZ'=>'KAZAKSTAN','KE'=>'KENYA','KI'=>'KIRIBATI','KP'=>'KOREADEMOCRATICPEOPLESREPUBLICOF','KR'=>'KOREAREPUBLICOF','KW'=>'KUWAIT','KG'=>'KYRGYZSTAN','LA'=>'LAOPEOPLESDEMOCRATICREPUBLIC','LV'=>'LATVIA','LB'=>'LEBANON','LS'=>'LESOTHO','LR'=>'LIBERIA','LY'=>'LIBYANARABJAMAHIRIYA','LI'=>'LIECHTENSTEIN','LT'=>'LITHUANIA','LU'=>'LUXEMBOURG','MO'=>'MACAU','MK'=>'MACEDONIA,THEFORMERYUGOSLAVREPUBLICOF','MG'=>'MADAGASCAR','MW'=>'MALAWI','MY'=>'MALAYSIA','MV'=>'MALDIVES','ML'=>'MALI','MT'=>'MALTA','MH'=>'MARSHALLISLANDS','MQ'=>'MARTINIQUE','MR'=>'MAURITANIA','MU'=>'MAURITIUS','YT'=>'MAYOTTE','MX'=>'MEXICO','FM'=>'MICRONESIA,FEDERATEDSTATESOF','MD'=>'MOLDOVA,REPUBLICOF','MC'=>'MONACO','MN'=>'MONGOLIA','MS'=>'MONTSERRAT','MA'=>'MOROCCO','MZ'=>'MOZAMBIQUE','MM'=>'MYANMAR','NA'=>'NAMIBIA','NR'=>'NAURU','NP'=>'NEPAL','NL'=>'NETHERLANDS','AN'=>'NETHERLANDSANTILLES','NC'=>'NEWCALEDONIA','NZ'=>'NEWZEALAND','NI'=>'NICARAGUA','NE'=>'NIGER','NG'=>'NIGERIA','NU'=>'NIUE','NF'=>'NORFOLKISLAND','MP'=>'NORTHERNMARIANAISLANDS','NO'=>'NORWAY','OM'=>'OMAN','PK'=>'PAKISTAN','PW'=>'PALAU','PS'=>'PALESTINIANTERRITORY,OCCUPIED','PA'=>'PANAMA','PG'=>'PAPUANEWGUINEA','PY'=>'PARAGUAY','PE'=>'PERU','PH'=>'PHILIPPINES','PN'=>'PITCAIRN','PL'=>'POLAND','PT'=>'PORTUGAL','PR'=>'PUERTORICO','QA'=>'QATAR','RE'=>'REUNION','RO'=>'ROMANIA','RU'=>'RUSSIANFEDERATION','RW'=>'RWANDA','SH'=>'SAINTHELENA','KN'=>'SAINTKITTSANDNEVIS','LC'=>'SAINTLUCIA','PM'=>'SAINTPIERREANDMIQUELON','VC'=>'SAINTVINCENTANDTHEGRENADINES','WS'=>'SAMOA','SM'=>'SANMARINO','ST'=>'SAOTOMEANDPRINCIPE','SA'=>'SAUDIARABIA','SN'=>'SENEGAL','SC'=>'SEYCHELLES','SL'=>'SIERRALEONE','SG'=>'SINGAPORE','SK'=>'SLOVAKIA','SI'=>'SLOVENIA','SB'=>'SOLOMONISLANDS','SO'=>'SOMALIA','ZA'=>'SOUTHAFRICA','GS'=>'SOUTHGEORGIAANDTHESOUTHSANDWICHISLANDS','ES'=>'SPAIN','LK'=>'SRILANKA','SD'=>'SUDAN','SR'=>'SURINAME','SJ'=>'SVALBARDANDJANMAYEN','SZ'=>'SWAZILAND','SE'=>'SWEDEN','CH'=>'SWITZERLAND','SY'=>'SYRIANARABREPUBLIC','TW'=>'TAIWAN,PROVINCEOFCHINA','TJ'=>'TAJIKISTAN','TZ'=>'TANZANIA,UNITEDREPUBLICOF','TH'=>'THAILAND','TG'=>'TOGO','TK'=>'TOKELAU','TO'=>'TONGA','TT'=>'TRINIDADANDTOBAGO','TN'=>'TUNISIA','TR'=>'TURKEY','TM'=>'TURKMENISTAN','TC'=>'TURKSANDCAICOSISLANDS','TV'=>'TUVALU','UG'=>'UGANDA','UA'=>'UKRAINE','AE'=>'UNITEDARABEMIRATES','GB'=>'UNITEDKINGDOM','US'=>'UNITEDSTATES','UM'=>'UNITEDSTATESMINOROUTLYINGISLANDS','UY'=>'URUGUAY','UZ'=>'UZBEKISTAN','VU'=>'VANUATU','VE'=>'VENEZUELA','VN'=>'VIETNAM','VG'=>'VIRGINISLANDS,BRITISH','VI'=>'VIRGINISLANDS,U.S.','WF'=>'WALLISANDFUTUNA','EH'=>'WESTERNSAHARA','YE'=>'YEMEN','YU'=>'YUGOSLAVIA','ZM'=>'ZAMBIA','ZW'=>'ZIMBABWE');

          if( $country_code !='' && isset( $countries[ strtoupper( $country_code ) ] ) ){
                return $countries[strtoupper( $country_code )];
          }

          return $countries;

    } // end get_countries



    function get_user_country(){

      /*if(isset($_COOKIE['_csh_user_country']) && $_COOKIE['_csh_user_country'] != ''){
          return $_COOKIE['_csh_user_country'];
      }*/

       $ip  = $this->get_ip();

       if( $ip == '127.0.0.1' ){
           return 'NP';
           return null;
       }

      $csh_ip_country = get_option('_csh_ip_country');

      if( $csh_ip_country && isset( $csh_ip_country[$ip] ) ){
        return $csh_ip_country[$ip];
      }

      //$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
      $url ="http://www.geoplugin.net/json.gp?ip=$ip";
      $ch = curl_init( $url );
      $options = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array('Content-type: application/json')
      );
      curl_setopt_array( $ch, $options );
      $result = curl_exec($ch); 
      $ip_data = json_decode($result);
      
          $country = null;

          if( $ip_data && $ip_data->geoplugin_countryName != null ){

              $country = $ip_data->geoplugin_countryCode;

              if( $country && strlen($country) == 2 ){

                $csh_ip_country[$ip] = esc_attr( $country );
                update_option('_csh_ip_country',$csh_ip_country);
                setcookie('_csh_user_country', $country, strtotime("+3 hours"));

              }
          }

        return $country;

    }



      function get_ip(){

       if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }


          $client  = @$_SERVER['HTTP_CLIENT_IP'];
          $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
          $remote  = $_SERVER['REMOTE_ADDR'];

          if(filter_var($client, FILTER_VALIDATE_IP)) {

              $ip = $client;

          } elseif(filter_var($forward, FILTER_VALIDATE_IP)) {

              $ip = $forward;

          } else {

              $ip = $remote;

          }

          return $ip;

}

  function csh_i18n(){
    load_plugin_textdomain( 'country-specific-homepage', false, basename(country_specific_homepage_path). '/languages' );
  }

  }

}
