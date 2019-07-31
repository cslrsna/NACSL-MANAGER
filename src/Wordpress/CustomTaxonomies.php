<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/22/19
 * Time: 10:29 AM
 */

namespace nacsl\Wordpress;

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
    }

    /***********************************************************************  METHODS  */

    public function showTag($atts)
    {
        $content = get_the_content();
        echo $content . get_the_term_list( get_the_ID(), $this->getName(), " ", " | ", " " );
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
    }

}