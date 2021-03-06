<?php
/**
 * Main OcimPress Formatting API.
 *
 * Handles many functions for formatting output.
 *
 * @package OcimPress
 */

function oc_check_invalid_utf8( $string, $strip = false ) {
        $string = (string) $string;
        if ( 0 === strlen( $string ) ) {
                return '';
        }
        // Store the site charset as a static to avoid multiple calls to get_option()
        static $is_utf8;
        if ( !isset( $is_utf8 ) ) {
                $is_utf8 = in_array( get_bloginfo( 'blog_charset' ), array( 'utf8', 'utf-8', 'UTF8', 'UTF-8' ) );
        }
        if ( !$is_utf8 ) {
                return $string;
        }
        // Check for support for utf8 in the installed PCRE library once and store the result in a static
        static $utf8_pcre;
        if ( !isset( $utf8_pcre ) ) {
                $utf8_pcre = @preg_match( '/^./u', 'a' );
        }
        // We can't demand utf8 in the PCRE installation, so just return the string in those cases
        if ( !$utf8_pcre ) {
                return $string;
        }
        // preg_match fails when it encounters invalid UTF8 in $string
        if ( 1 === @preg_match( '/^./us', $string ) ) {
                return $string;
        }
        // Attempt to strip the bad chars if requested (not recommended)
        if ( $strip && function_exists( 'iconv' ) ) {
                return iconv( 'utf-8', 'utf-8', $string );
        }
        return '';
}

function _oc_specialchars( $string, $quote_style = ENT_NOQUOTES, $charset = false, $double_encode = false ) {
        $string = (string) $string;
        if ( 0 === strlen( $string ) )
                return '';
        // Don't bother if there are no specialchars - saves some processing
        if ( ! preg_match( '/[&<>"\']/', $string ) )
                return $string;
        // Account for the previous behaviour of the function when the $quote_style is not an accepted value
        if ( empty( $quote_style ) )
                $quote_style = ENT_NOQUOTES;
        elseif ( ! in_array( $quote_style, array( 0, 2, 3, 'single', 'double' ), true ) )
                $quote_style = ENT_QUOTES;
        if ( ! $charset ) {
                static $_charset;
                if ( ! isset( $_charset ) ) {
                        $alloptions = get_bloginfo( 'blog_charset' );
                        $_charset = isset( $alloptions ) ? $alloptions : '';
                }
                $charset = $_charset;
        }
        if ( in_array( $charset, array( 'utf8', 'utf-8', 'UTF8' ) ) )
                $charset = 'UTF-8';
        $_quote_style = $quote_style;
        if ( $quote_style === 'double' ) {
                $quote_style = ENT_COMPAT;
                $_quote_style = ENT_COMPAT;
        } elseif ( $quote_style === 'single' ) {
                $quote_style = ENT_NOQUOTES;
        }
        // Handle double encoding ourselves
        if ( $double_encode ) {
                $string = @htmlspecialchars( $string, $quote_style, $charset );
        } else {
                // Decode &amp; into &
                $string = oc_specialchars_decode( $string, $_quote_style );
                // Guarantee every &entity; is valid or re-encode the &
                $string = oc_kses_normalize_entities( $string );
                // Now re-encode everything except &entity;
                $string = preg_split( '/(&#?x?[0-9a-z]+;)/i', $string, -1, PREG_SPLIT_DELIM_CAPTURE );
                for ( $i = 0; $i < count( $string ); $i += 2 )
                        $string[$i] = @htmlspecialchars( $string[$i], $quote_style, $charset );
                $string = implode( '', $string );
        }
        // Backwards compatibility
        if ( 'single' === $_quote_style )
                $string = str_replace( "'", '&#039;', $string );
        return $string;
}
function oc_specialchars_decode( $string, $quote_style = ENT_NOQUOTES ) {
        $string = (string) $string;
        if ( 0 === strlen( $string ) ) {
                return '';
        }
        if ( strpos( $string, '&' ) === false ) {
                return $string;
        }
        if ( empty( $quote_style ) ) {
                $quote_style = ENT_NOQUOTES;
        } elseif ( !in_array( $quote_style, array( 0, 2, 3, 'single', 'double' ), true ) ) {
                $quote_style = ENT_QUOTES;
        }
        $single = array( '&#039;'  => '\'', '&#x27;' => '\'' );
        $single_preg = array( '/&#0*39;/'  => '&#039;', '/&#x0*27;/i' => '&#x27;' );
        $double = array( '&quot;' => '"', '&#034;'  => '"', '&#x22;' => '"' );
        $double_preg = array( '/&#0*34;/'  => '&#034;', '/&#x0*22;/i' => '&#x22;' );
        $others = array( '&lt;'   => '<', '&#060;'  => '<', '&gt;'   => '>', '&#062;'  => '>', '&amp;'  => '&', '&#038;'  => '&', '&#x26;' => '&' );
        $others_preg = array( '/&#0*60;/'  => '&#060;', '/&#0*62;/'  => '&#062;', '/&#0*38;/'  => '&#038;', '/&#x0*26;/i' => '&#x26;' );
        if ( $quote_style === ENT_QUOTES ) {
                $translation = array_merge( $single, $double, $others );
                $translation_preg = array_merge( $single_preg, $double_preg, $others_preg );
        } elseif ( $quote_style === ENT_COMPAT || $quote_style === 'double' ) {
                $translation = array_merge( $double, $others );
                $translation_preg = array_merge( $double_preg, $others_preg );
        } elseif ( $quote_style === 'single' ) {
                $translation = array_merge( $single, $others );
                $translation_preg = array_merge( $single_preg, $others_preg );
        } elseif ( $quote_style === ENT_NOQUOTES ) {
                $translation = $others;
                $translation_preg = $others_preg;
        }
        $string = preg_replace( array_keys( $translation_preg ), array_values( $translation_preg ), $string );
        return strtr( $string, $translation );
}
function oc_kses_normalize_entities($string) {
        $string = str_replace('&', '&amp;', $string);
        $string = preg_replace_callback('/&amp;([A-Za-z]{2,8}[0-9]{0,2});/', 'oc_kses_named_entities', $string);
        $string = preg_replace_callback('/&amp;#(0*[0-9]{1,7});/', 'oc_kses_normalize_entities2', $string);
        $string = preg_replace_callback('/&amp;#[Xx](0*[0-9A-Fa-f]{1,6});/', 'oc_kses_normalize_entities3', $string);
        return $string;
}
function oc_kses_named_entities($matches) {
        global $allowedentitynames;
        if ( empty($matches[1]) )
                return '';
        $i = $matches[1];
        return ( ( ! in_array($i, $allowedentitynames) ) ? "&amp;$i;" : "&$i;" );
}
function oc_kses_normalize_entities2($matches) {
        if ( empty($matches[1]) )
                return '';
        $i = $matches[1];
        if (valid_unicode($i)) {
                $i = str_pad(ltrim($i,'0'), 3, '0', STR_PAD_LEFT);
                $i = "&#$i;";
        } else {
                $i = "&amp;#$i;";
        }
        return $i;
}
function oc_kses_normalize_entities3($matches) {
        if ( empty($matches[1]) )
                return '';
        $hexchars = $matches[1];
        return ( ( ! valid_unicode(hexdec($hexchars)) ) ? "&amp;#x$hexchars;" : '&#x'.ltrim($hexchars,'0').';' );
}
function valid_unicode($i) {
        return ( $i == 0x9 || $i == 0xa || $i == 0xd ||
                        ($i >= 0x20 && $i <= 0xd7ff) ||
                        ($i >= 0xe000 && $i <= 0xfffd) ||
                        ($i >= 0x10000 && $i <= 0x10ffff) );
}
function esc_attr( $text ) {
        $safe_text = oc_check_invalid_utf8( $text );
        $safe_text = _oc_specialchars( $safe_text, ENT_QUOTES );
        return $safe_text;
}