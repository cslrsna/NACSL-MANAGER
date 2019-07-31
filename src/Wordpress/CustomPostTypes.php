<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/21/19
 * Time: 3:14 PM
 */

namespace nacsl\Wordpress;

use nacsl\App\Models\TxFormats;

/**
 * Class CustomPostTypes
 * @package nacsl\Wordpress
 */
class CustomPostTypes implements HooksInterfaces
{

    private $_name = "";
    private $_labels = array();
    private $_args = array();

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

    /***********************************************************************  MAGIC METHODS  */

    /**
     * CustomPostTypes constructor.
     * @param array $data
     */
    public function __construct( array $data )
    {
        $this->setName  ( $data[ 'name' ] );
        $this->setLabels( $data[ 'labels' ] );
        $this->setArgs  ( $data[ 'args' ] );
    }

    /***********************************************************************  METHODS  */

    public function showTag($atts)
    {
        get_the_tag_list( null, " | ", null, get_posts($atts) );
    }

    public function register()
    {
        register_post_type( $this->getName(), $this->getArgs() );
    }

    public function hook()
    {
        add_action( 'init', array( $this,'register' ), 0 );
        add_shortcode( 'cpt_tags', array($this, 'showTag') );
    }
}