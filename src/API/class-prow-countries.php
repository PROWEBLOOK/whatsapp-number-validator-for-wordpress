<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Translate ISO 3166-1 Country Codes to Country names and vice versa.
 *
 * @package PROW/API
 */

/**
 * Class PROW_Countries
 */
class PROW_Countries {

	/**
	 * The country list.
	 *
	 * @var array
	 */
	private static $countries = array();

	/**
	 * Populate the countries
	 */
	public static function populate() {

		self::$countries = array(
			'AF' => __( 'Afghanistan', 'Proweblook-wa-validator' ),
			'AL' => __( 'Albania', 'Proweblook-wa-validator' ),
			'DZ' => __( 'Algeria', 'Proweblook-wa-validator' ),
			'AS' => __( 'American Samoa', 'Proweblook-wa-validator' ),
			'AD' => __( 'Andorra', 'Proweblook-wa-validator' ),
			'AO' => __( 'Angola', 'Proweblook-wa-validator' ),
			'AI' => __( 'Anguilla', 'Proweblook-wa-validator' ),
			'AQ' => __( 'Antarctica', 'Proweblook-wa-validator' ),
			'AG' => __( 'Antigua & Barbuda', 'Proweblook-wa-validator' ),
			'AR' => __( 'Argentina', 'Proweblook-wa-validator' ),
			'AM' => __( 'Armenia', 'Proweblook-wa-validator' ),
			'AW' => __( 'Aruba', 'Proweblook-wa-validator' ),
			'AU' => __( 'Australia', 'Proweblook-wa-validator' ),
			'AT' => __( 'Austria', 'Proweblook-wa-validator' ),
			'AZ' => __( 'Azerbaijan', 'Proweblook-wa-validator' ),
			'BS' => __( 'Bahamas', 'Proweblook-wa-validator' ),
			'BH' => __( 'Bahrain', 'Proweblook-wa-validator' ),
			'BD' => __( 'Bangladesh', 'Proweblook-wa-validator' ),
			'BB' => __( 'Barbados', 'Proweblook-wa-validator' ),
			'BY' => __( 'Belarus', 'Proweblook-wa-validator' ),
			'BE' => __( 'Belgium', 'Proweblook-wa-validator' ),
			'BZ' => __( 'Belize', 'Proweblook-wa-validator' ),
			'BJ' => __( 'Benin', 'Proweblook-wa-validator' ),
			'BM' => __( 'Bermuda', 'Proweblook-wa-validator' ),
			'BT' => __( 'Bhutan', 'Proweblook-wa-validator' ),
			'BO' => __( 'Bolivia', 'Proweblook-wa-validator' ),
			'BA' => __( 'Bosnia', 'Proweblook-wa-validator' ),
			'BW' => __( 'Botswana', 'Proweblook-wa-validator' ),
			'BV' => __( 'Bouvet Island', 'Proweblook-wa-validator' ),
			'BR' => __( 'Brazil', 'Proweblook-wa-validator' ),
			'IO' => __( 'British Indian Ocean Territory', 'Proweblook-wa-validator' ),
			'VG' => __( 'British Virgin Islands', 'Proweblook-wa-validator' ),
			'BN' => __( 'Brunei', 'Proweblook-wa-validator' ),
			'BG' => __( 'Bulgaria', 'Proweblook-wa-validator' ),
			'BF' => __( 'Burkina Faso', 'Proweblook-wa-validator' ),
			'BI' => __( 'Burundi', 'Proweblook-wa-validator' ),
			'KH' => __( 'Cambodia', 'Proweblook-wa-validator' ),
			'CM' => __( 'Cameroon', 'Proweblook-wa-validator' ),
			'CA' => __( 'Canada', 'Proweblook-wa-validator' ),
			'CV' => __( 'Cape Verde', 'Proweblook-wa-validator' ),
			'BQ' => __( 'Caribbean Netherlands', 'Proweblook-wa-validator' ),
			'KY' => __( 'Cayman Islands', 'Proweblook-wa-validator' ),
			'CF' => __( 'Central African Republic', 'Proweblook-wa-validator' ),
			'TD' => __( 'Chad', 'Proweblook-wa-validator' ),
			'CL' => __( 'Chile', 'Proweblook-wa-validator' ),
			'CN' => __( 'China', 'Proweblook-wa-validator' ),
			'CX' => __( 'Christmas Island', 'Proweblook-wa-validator' ),
			'CC' => __( 'Cocos (Keeling) Islands', 'Proweblook-wa-validator' ),
			'CO' => __( 'Colombia', 'Proweblook-wa-validator' ),
			'KM' => __( 'Comoros', 'Proweblook-wa-validator' ),
			'CG' => __( 'Congo - Brazzaville', 'Proweblook-wa-validator' ),
			'CD' => __( 'Congo - Kinshasa', 'Proweblook-wa-validator' ),
			'CK' => __( 'Cook Islands', 'Proweblook-wa-validator' ),
			'CR' => __( 'Costa Rica', 'Proweblook-wa-validator' ),
			'HR' => __( 'Croatia', 'Proweblook-wa-validator' ),
			'CU' => __( 'Cuba', 'Proweblook-wa-validator' ),
			'CW' => __( 'Curaçao', 'Proweblook-wa-validator' ),
			'CY' => __( 'Cyprus', 'Proweblook-wa-validator' ),
			'CZ' => __( 'Czechia', 'Proweblook-wa-validator' ),
			'CI' => __( 'Côte d’Ivoire', 'Proweblook-wa-validator' ),
			'DK' => __( 'Denmark', 'Proweblook-wa-validator' ),
			'DJ' => __( 'Djibouti', 'Proweblook-wa-validator' ),
			'DM' => __( 'Dominica', 'Proweblook-wa-validator' ),
			'DO' => __( 'Dominican Republic', 'Proweblook-wa-validator' ),
			'EC' => __( 'Ecuador', 'Proweblook-wa-validator' ),
			'EG' => __( 'Egypt', 'Proweblook-wa-validator' ),
			'SV' => __( 'El Salvador', 'Proweblook-wa-validator' ),
			'GQ' => __( 'Equatorial Guinea', 'Proweblook-wa-validator' ),
			'ER' => __( 'Eritrea', 'Proweblook-wa-validator' ),
			'EE' => __( 'Estonia', 'Proweblook-wa-validator' ),
			'ET' => __( 'Ethiopia', 'Proweblook-wa-validator' ),
			'FK' => __( 'Falkland Islands', 'Proweblook-wa-validator' ),
			'FO' => __( 'Faroe Islands', 'Proweblook-wa-validator' ),
			'FJ' => __( 'Fiji', 'Proweblook-wa-validator' ),
			'FI' => __( 'Finland', 'Proweblook-wa-validator' ),
			'FR' => __( 'France', 'Proweblook-wa-validator' ),
			'GF' => __( 'French Guiana', 'Proweblook-wa-validator' ),
			'PF' => __( 'French Polynesia', 'Proweblook-wa-validator' ),
			'TF' => __( 'French Southern Territories', 'Proweblook-wa-validator' ),
			'GA' => __( 'Gabon', 'Proweblook-wa-validator' ),
			'GM' => __( 'Gambia', 'Proweblook-wa-validator' ),
			'GE' => __( 'Georgia', 'Proweblook-wa-validator' ),
			'DE' => __( 'Germany', 'Proweblook-wa-validator' ),
			'GH' => __( 'Ghana', 'Proweblook-wa-validator' ),
			'GI' => __( 'Gibraltar', 'Proweblook-wa-validator' ),
			'GR' => __( 'Greece', 'Proweblook-wa-validator' ),
			'GL' => __( 'Greenland', 'Proweblook-wa-validator' ),
			'GD' => __( 'Grenada', 'Proweblook-wa-validator' ),
			'GP' => __( 'Guadeloupe', 'Proweblook-wa-validator' ),
			'GU' => __( 'Guam', 'Proweblook-wa-validator' ),
			'GT' => __( 'Guatemala', 'Proweblook-wa-validator' ),
			'GG' => __( 'Guernsey', 'Proweblook-wa-validator' ),
			'GN' => __( 'Guinea', 'Proweblook-wa-validator' ),
			'GW' => __( 'Guinea-Bissau', 'Proweblook-wa-validator' ),
			'GY' => __( 'Guyana', 'Proweblook-wa-validator' ),
			'HT' => __( 'Haiti', 'Proweblook-wa-validator' ),
			'HM' => __( 'Heard & McDonald Islands', 'Proweblook-wa-validator' ),
			'HN' => __( 'Honduras', 'Proweblook-wa-validator' ),
			'HK' => __( 'Hong Kong', 'Proweblook-wa-validator' ),
			'HU' => __( 'Hungary', 'Proweblook-wa-validator' ),
			'IS' => __( 'Iceland', 'Proweblook-wa-validator' ),
			'IN' => __( 'India', 'Proweblook-wa-validator' ),
			'ID' => __( 'Indonesia', 'Proweblook-wa-validator' ),
			'IR' => __( 'Iran', 'Proweblook-wa-validator' ),
			'IQ' => __( 'Iraq', 'Proweblook-wa-validator' ),
			'IE' => __( 'Ireland', 'Proweblook-wa-validator' ),
			'IM' => __( 'Isle of Man', 'Proweblook-wa-validator' ),
			'IL' => __( 'Israel', 'Proweblook-wa-validator' ),
			'IT' => __( 'Italy', 'Proweblook-wa-validator' ),
			'JM' => __( 'Jamaica', 'Proweblook-wa-validator' ),
			'JP' => __( 'Japan', 'Proweblook-wa-validator' ),
			'JE' => __( 'Jersey', 'Proweblook-wa-validator' ),
			'JO' => __( 'Jordan', 'Proweblook-wa-validator' ),
			'KZ' => __( 'Kazakhstan', 'Proweblook-wa-validator' ),
			'KE' => __( 'Kenya', 'Proweblook-wa-validator' ),
			'KI' => __( 'Kiribati', 'Proweblook-wa-validator' ),
			'KW' => __( 'Kuwait', 'Proweblook-wa-validator' ),
			'KG' => __( 'Kyrgyzstan', 'Proweblook-wa-validator' ),
			'LA' => __( 'Laos', 'Proweblook-wa-validator' ),
			'LV' => __( 'Latvia', 'Proweblook-wa-validator' ),
			'LB' => __( 'Lebanon', 'Proweblook-wa-validator' ),
			'LS' => __( 'Lesotho', 'Proweblook-wa-validator' ),
			'LR' => __( 'Liberia', 'Proweblook-wa-validator' ),
			'LY' => __( 'Libya', 'Proweblook-wa-validator' ),
			'LI' => __( 'Liechtenstein', 'Proweblook-wa-validator' ),
			'LT' => __( 'Lithuania', 'Proweblook-wa-validator' ),
			'LU' => __( 'Luxembourg', 'Proweblook-wa-validator' ),
			'MO' => __( 'Macau', 'Proweblook-wa-validator' ),
			'MK' => __( 'Macedonia', 'Proweblook-wa-validator' ),
			'MG' => __( 'Madagascar', 'Proweblook-wa-validator' ),
			'MW' => __( 'Malawi', 'Proweblook-wa-validator' ),
			'MY' => __( 'Malaysia', 'Proweblook-wa-validator' ),
			'MV' => __( 'Maldives', 'Proweblook-wa-validator' ),
			'ML' => __( 'Mali', 'Proweblook-wa-validator' ),
			'MT' => __( 'Malta', 'Proweblook-wa-validator' ),
			'MH' => __( 'Marshall Islands', 'Proweblook-wa-validator' ),
			'MQ' => __( 'Martinique', 'Proweblook-wa-validator' ),
			'MR' => __( 'Mauritania', 'Proweblook-wa-validator' ),
			'MU' => __( 'Mauritius', 'Proweblook-wa-validator' ),
			'YT' => __( 'Mayotte', 'Proweblook-wa-validator' ),
			'MX' => __( 'Mexico', 'Proweblook-wa-validator' ),
			'FM' => __( 'Micronesia', 'Proweblook-wa-validator' ),
			'MD' => __( 'Moldova', 'Proweblook-wa-validator' ),
			'MC' => __( 'Monaco', 'Proweblook-wa-validator' ),
			'MN' => __( 'Mongolia', 'Proweblook-wa-validator' ),
			'ME' => __( 'Montenegro', 'Proweblook-wa-validator' ),
			'MS' => __( 'Montserrat', 'Proweblook-wa-validator' ),
			'MA' => __( 'Morocco', 'Proweblook-wa-validator' ),
			'MZ' => __( 'Mozambique', 'Proweblook-wa-validator' ),
			'MM' => __( 'Myanmar', 'Proweblook-wa-validator' ),
			'NA' => __( 'Namibia', 'Proweblook-wa-validator' ),
			'NR' => __( 'Nauru', 'Proweblook-wa-validator' ),
			'NP' => __( 'Nepal', 'Proweblook-wa-validator' ),
			'NL' => __( 'Netherlands', 'Proweblook-wa-validator' ),
			'NC' => __( 'New Caledonia', 'Proweblook-wa-validator' ),
			'NZ' => __( 'New Zealand', 'Proweblook-wa-validator' ),
			'NI' => __( 'Nicaragua', 'Proweblook-wa-validator' ),
			'NE' => __( 'Niger', 'Proweblook-wa-validator' ),
			'NG' => __( 'Nigeria', 'Proweblook-wa-validator' ),
			'NU' => __( 'Niue', 'Proweblook-wa-validator' ),
			'NF' => __( 'Norfolk Island', 'Proweblook-wa-validator' ),
			'KP' => __( 'North Korea', 'Proweblook-wa-validator' ),
			'MP' => __( 'Northern Mariana Islands', 'Proweblook-wa-validator' ),
			'NO' => __( 'Norway', 'Proweblook-wa-validator' ),
			'OM' => __( 'Oman', 'Proweblook-wa-validator' ),
			'PK' => __( 'Pakistan', 'Proweblook-wa-validator' ),
			'PW' => __( 'Palau', 'Proweblook-wa-validator' ),
			'PS' => __( 'Palestine', 'Proweblook-wa-validator' ),
			'PA' => __( 'Panama', 'Proweblook-wa-validator' ),
			'PG' => __( 'Papua New Guinea', 'Proweblook-wa-validator' ),
			'PY' => __( 'Paraguay', 'Proweblook-wa-validator' ),
			'PE' => __( 'Peru', 'Proweblook-wa-validator' ),
			'PH' => __( 'Philippines', 'Proweblook-wa-validator' ),
			'PN' => __( 'Pitcairn Islands', 'Proweblook-wa-validator' ),
			'PL' => __( 'Poland', 'Proweblook-wa-validator' ),
			'PT' => __( 'Portugal', 'Proweblook-wa-validator' ),
			'PR' => __( 'Puerto Rico', 'Proweblook-wa-validator' ),
			'QA' => __( 'Qatar', 'Proweblook-wa-validator' ),
			'RO' => __( 'Romania', 'Proweblook-wa-validator' ),
			'RU' => __( 'Russia', 'Proweblook-wa-validator' ),
			'RW' => __( 'Rwanda', 'Proweblook-wa-validator' ),
			'RE' => __( 'Réunion', 'Proweblook-wa-validator' ),
			'WS' => __( 'Samoa', 'Proweblook-wa-validator' ),
			'SM' => __( 'San Marino', 'Proweblook-wa-validator' ),
			'SA' => __( 'Saudi Arabia', 'Proweblook-wa-validator' ),
			'SN' => __( 'Senegal', 'Proweblook-wa-validator' ),
			'RS' => __( 'Serbia', 'Proweblook-wa-validator' ),
			'SC' => __( 'Seychelles', 'Proweblook-wa-validator' ),
			'SL' => __( 'Sierra Leone', 'Proweblook-wa-validator' ),
			'SG' => __( 'Singapore', 'Proweblook-wa-validator' ),
			'SX' => __( 'Sint Maarten', 'Proweblook-wa-validator' ),
			'SK' => __( 'Slovakia', 'Proweblook-wa-validator' ),
			'SI' => __( 'Slovenia', 'Proweblook-wa-validator' ),
			'SB' => __( 'Solomon Islands', 'Proweblook-wa-validator' ),
			'SO' => __( 'Somalia', 'Proweblook-wa-validator' ),
			'ZA' => __( 'South Africa', 'Proweblook-wa-validator' ),
			'GS' => __( 'South Georgia & South Sandwich Islands', 'Proweblook-wa-validator' ),
			'KR' => __( 'South Korea', 'Proweblook-wa-validator' ),
			'SS' => __( 'South Sudan', 'Proweblook-wa-validator' ),
			'ES' => __( 'Spain', 'Proweblook-wa-validator' ),
			'LK' => __( 'Sri Lanka', 'Proweblook-wa-validator' ),
			'BL' => __( 'St. Barthélemy', 'Proweblook-wa-validator' ),
			'SH' => __( 'St. Helena', 'Proweblook-wa-validator' ),
			'KN' => __( 'St. Kitts & Nevis', 'Proweblook-wa-validator' ),
			'LC' => __( 'St. Lucia', 'Proweblook-wa-validator' ),
			'MF' => __( 'St. Martin', 'Proweblook-wa-validator' ),
			'PM' => __( 'St. Pierre & Miquelon', 'Proweblook-wa-validator' ),
			'VC' => __( 'St. Vincent & Grenadines', 'Proweblook-wa-validator' ),
			'SD' => __( 'Sudan', 'Proweblook-wa-validator' ),
			'SR' => __( 'Suriname', 'Proweblook-wa-validator' ),
			'SJ' => __( 'Svalbard & Jan Mayen', 'Proweblook-wa-validator' ),
			'SZ' => __( 'Swaziland', 'Proweblook-wa-validator' ),
			'SE' => __( 'Sweden', 'Proweblook-wa-validator' ),
			'CH' => __( 'Switzerland', 'Proweblook-wa-validator' ),
			'SY' => __( 'Syria', 'Proweblook-wa-validator' ),
			'ST' => __( 'São Tomé & Príncipe', 'Proweblook-wa-validator' ),
			'TW' => __( 'Taiwan', 'Proweblook-wa-validator' ),
			'TJ' => __( 'Tajikistan', 'Proweblook-wa-validator' ),
			'TZ' => __( 'Tanzania', 'Proweblook-wa-validator' ),
			'TH' => __( 'Thailand', 'Proweblook-wa-validator' ),
			'TL' => __( 'Timor-Leste', 'Proweblook-wa-validator' ),
			'TG' => __( 'Togo', 'Proweblook-wa-validator' ),
			'TK' => __( 'Tokelau', 'Proweblook-wa-validator' ),
			'TO' => __( 'Tonga', 'Proweblook-wa-validator' ),
			'TT' => __( 'Trinidad & Tobago', 'Proweblook-wa-validator' ),
			'TN' => __( 'Tunisia', 'Proweblook-wa-validator' ),
			'TR' => __( 'Turkey', 'Proweblook-wa-validator' ),
			'TM' => __( 'Turkmenistan', 'Proweblook-wa-validator' ),
			'TC' => __( 'Turks & Caicos Islands', 'Proweblook-wa-validator' ),
			'TV' => __( 'Tuvalu', 'Proweblook-wa-validator' ),
			'UM' => __( 'U.S. Outlying Islands', 'Proweblook-wa-validator' ),
			'VI' => __( 'U.S. Virgin Islands', 'Proweblook-wa-validator' ),
			'GB' => __( 'UK', 'Proweblook-wa-validator' ),
			'US' => __( 'US', 'Proweblook-wa-validator' ),
			'UG' => __( 'Uganda', 'Proweblook-wa-validator' ),
			'UA' => __( 'Ukraine', 'Proweblook-wa-validator' ),
			'AE' => __( 'United Arab Emirates', 'Proweblook-wa-validator' ),
			'UY' => __( 'Uruguay', 'Proweblook-wa-validator' ),
			'UZ' => __( 'Uzbekistan', 'Proweblook-wa-validator' ),
			'VU' => __( 'Vanuatu', 'Proweblook-wa-validator' ),
			'VA' => __( 'Vatican City', 'Proweblook-wa-validator' ),
			'VE' => __( 'Venezuela', 'Proweblook-wa-validator' ),
			'VN' => __( 'Vietnam', 'Proweblook-wa-validator' ),
			'WF' => __( 'Wallis & Futuna', 'Proweblook-wa-validator' ),
			'EH' => __( 'Western Sahara', 'Proweblook-wa-validator' ),
			'YE' => __( 'Yemen', 'Proweblook-wa-validator' ),
			'ZM' => __( 'Zambia', 'Proweblook-wa-validator' ),
			'ZW' => __( 'Zimbabwe', 'Proweblook-wa-validator' ),
			'AX' => __( 'Åland Islands', 'Proweblook-wa-validator' ),
		);
	}

	/**
	 * Get list
	 *
	 * @return array
	 */
	public static function get_list() {
		return self::$countries;
	}


	/**
	 * Get the country by its code.
	 *
	 * @param string $code The country code.
	 *
	 * @return string
	 */
	public static function get_country( $code ) {

		return ( ! empty( self::$countries[ $code ] ) ) ? self::$countries[ $code ] : '';
	}

	/**
	 * Get the code of a country.
	 *
	 * @param string $country The country name.
	 *
	 * @return string
	 */
	public static function get_code( $country ) {

		$codes = array_flip( self::$countries );
		return ( ! empty( $codes[ $country ] ) ) ? $codes[ $country ] : '';
	}
}
