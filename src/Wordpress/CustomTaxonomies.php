<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/22/19
 * Time: 10:29 AM
 */

namespace nacsl\Wordpress;

use WP_Query;

/**
 * Class CustomTaxonomies
 * @package nacsl\Wordpress
 */
class CustomTaxonomies implements HooksInterfaces
{

    private $_name = "";
    private $_labels = array();
    private $_args = array();
    private $_terms = array();
    private $_showPage;
    private $_cpt;

    /***********************************************************************  GETTER */

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * @return array
     */
    public function getLabels(): array
    {
        return $this->_labels;
    }

    /**
     * @return array
     */
    public function getArgs(): array
    {
        return $this->_args;
    }

    /**
     * @return array
     */
    public function getTerms(): array
    {
        return $this->_terms;
    }

    /**
     * @return mixed
     */
    public function getShowPage()
    {
        return $this->_showPage;
    }

    /**
     * @return mixed
     */
    public function getCpt()
    {
        return $this->_cpt;
    }


    /***********************************************************************  SETTER  */

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->_name = $name;
    }

    /**
     * @param array $labels
     */
    public function setLabels(array $labels): void
    {
        $this->_labels = $labels;
        $this->_args[ 'labels' ] = $this->getLabels();
    }

    /**
     * @param array $args
     */
    public function setArgs(array $args): void
    {
        $this->_args = $args;
    }

    /**
     * @param array $terms
     */
    public function setTerms(array $terms): void
    {
        $this->_terms = $terms;
    }

    /**
     * @param mixed $showPage
     */
    public function setShowPage($showPage): void
    {
        $this->_showPage = $showPage;
    }

    /**
     * @param mixed $cpt
     */
    public function setCpt($cpt): void
    {
        $this->_cpt = $cpt;
    }


    /***********************************************************************  MAGIC METHODS  */

    /**
     * CustomPostTypes constructor.
     * @param $cpt
     * @param array $data
     */
    public function __construct( $cpt, array $data )
    {
        $this->setCpt   ( $cpt );
        $this->setName  ( $data[ 'name' ] );
        $this->setLabels( $data[ 'labels' ] );
        $this->setArgs  ( $data[ 'args' ] );
        if ( key_exists( 'terms', $data ) ){
            $this->setTerms( $data['terms'] );
        }
        if ( key_exists('showPage', $data) ){
            //TODO: show taxo page
        }
    }

    /***********************************************************************  METHODS  */

    /**
     * @param $atts
     * @param $content
     * @return string
     */
    public function showTag($atts, $content)
    {
        if ( get_terms($this->getName()) ){
            return $content . get_the_term_list( get_the_ID(), $this->getName(), " ", " | ", " " );
        }
    }

    public function ShowTagList($atts, $content)
    {

        $terms = get_terms( $this->getName(), array(
            'taxonomy' => $this->getName(),
            'hide_empty' => 0,
            "order" => "count"
        ) );
        $html = "<section class='widget widget_tag_cloud'>";
        $html .= "<div class='tagcloud'>";
        $html .= "<ul class='wp-tag-cloud'>";

        foreach( $terms as $term ) {

            // Define the query
            $args = array(
                $this->getName() => $term->slug
            );
            $query = new WP_Query( $args );
            // output the term name in a heading tag
            $html .= '<li><a class="tag-cloud-link" href="/' . $this->getArgs()["rewrite"]["slug"] . "/" . $term->slug  . '">' . $term->name . ' ' .  $term->count . '</a> </li> ';

            // use reset postdata to restore orginal query
            wp_reset_postdata();

        }

        $html .= "</ul></div></section>";

        return $html;

    }

    public function register()
    {
        register_taxonomy( $this->getName(), $this->getCpt(), $this->getArgs() );
        if ( ! empty( $this->_terms ) ){
            foreach ( $this->getTerms() as $term ) {
                wp_insert_term( $term, $this->getName());
            }
        }
    }

    public function hook()
    {
        add_action( 'init', array( $this, 'register' ), 0 );
        add_shortcode( $this->getName(), array($this,'showTag') );
        add_shortcode( $this->getName() . "-list", array($this,'showTagList') );
    }

}