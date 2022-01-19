<?php
namespace nacsl\App\Helpers;

use nacsl\Wordpress\HooksFrontInterfaces;
use nacsl\Wordpress\HooksInterfaces;

/** @package nacsl\App\Helpers */
class CustomsShortcuts implements HooksFrontInterfaces
{

    public function __construct(){}

    /**
     * @param array $atts 
     * @param mixed|null $content 
     * @return string|null 
     */
    public function acfcond($atts = [], $content = null)
    {
        $atts = array_change_key_case((array)$atts, CASE_LOWER);

        if ( array_key_exists("test", $atts) ) {
            if(get_field($atts['field']) == $atts['test'])
            {
                $content = do_shortcode($content);
            }
            else
            {
                $content = null;
            }
        }else{
            if(get_field($atts['field']))
            {
                $content = do_shortcode($content);
            }
            else
            {
                $content = null;
            }
        }

        return $content;
    }

    /**
     * @param array $atts 
     * @param mixed|null $content 
     * @return mixed 
     */
    public function gmapcond($atts = [], $content = null)
    {
        $atts = array_change_key_case( (array)$atts, CASE_LOWER );
        
        if ( array_key_exists("no", $atts) && array_key_exists("rue", $atts) ) {
            if ( get_field( $atts["no"] ) && get_field( $atts["rue"] ) && !\is_archive('nacsl-cpt-groupes') ) {

                $no = trim( do_shortcode( get_field( $atts["no"] ) ) );
                $rue = trim( do_shortcode( get_field( $atts["rue"] ) ) );
                $ville = trim( strip_tags(do_shortcode( "[nacsl-tx-villes]" )) );

                $content = <<<EOT
<h5>Google Maps</h5>
<iframe style="min-width: 100%; min-height: 450px;" src="https://maps.google.com/maps?q=$no+$rue,+$ville,+QC&amp;language=fr-CA&amp;output=embed" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"><span data-mce-type="bookmark" style="display: inline-block; width: 0px; overflow: hidden; line-height: 0;" class="mce_SELRES_start">﻿</span><span data-mce-type="bookmark" style="display: inline-block; width: 0px; overflow: hidden; line-height: 0;" class="mce_SELRES_start">﻿</span><span data-mce-type="bookmark" style="display: inline-block; width: 0px; overflow: hidden; line-height: 0;" class="mce_SELRES_start">﻿</span>
</iframe>
EOT;
            }else{
                $content = null;
            }
        }

        return $content;
    }

    /**
     * @param array $atts 
     * @param mixed|null $content 
     * @return mixed 
     */
    public function taxcond($atts = [], $content = null)
    {
        $atts = array_change_key_case((array)$atts, CASE_LOWER);
        
        $post = get_post();

        $terms = get_the_terms( $post, $atts['tax'] );

        if (has_term( $atts['name'], $atts['tax'] )) {
            foreach ($terms as $value) {
                if ($value->name == $atts['name']) {
                    $content = do_shortcode($content);
                }
            }
        }else{
            $content = null;
        }

        return $content;
    }

    /** @return void  */
    public function hook() { 
        add_shortcode('acfcond', array($this,'acfcond'));
        add_shortcode('gmapcond', array($this,'gmapcond'));
        add_shortcode('taxcond', array($this,'taxcond'));
    }
    
}
