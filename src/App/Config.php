<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/21/19
 * Time: 3:20 PM
 */

namespace nacsl\App;


class Config
{

    const TEXTDOMAINE = "nacsl";

    private static $_isInit = false;
    private static $_instance = null;

    private $_rootPath  = "";
    private $_paths = array();
    private $_urls = array();
    private $_pluginData = array();

    private $_prefix = "";

    /*******************************************************************  GETTER  **/

    /**
     * @return string
     */
    public function getRootPath(): string
    {
        return $this->_rootPath;
    }

    /**
     * @param null $name
     * @return mixed
     */
    public function getPluginData( $name = null )
    {
        if ( $name ){
            return $this->_pluginData[ $name ];
        }else{
            return $this->_pluginData;
        }

    }

    /**
     * @param string $name
     * @return string
     */
    public function getPaths( string $name ): string
    {
        return $this->_paths[ $name ];
    }

    /**
     * @param string $name
     * @return string
     */
    public function getUrls( string $name ): string
    {
        return $this->_urls[ $name ];
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->_prefix;
    }


    /*******************************************************************  SETTER  **/

    /**
     * @param string $rootPath
     */
    public function setRootPath(string $rootPath): void
    {
        $this->_rootPath = $rootPath;
    }

    /**
     * @param array $pluginData
     */
    public function setPluginData(array $pluginData): void
    {
        $this->_pluginData = $pluginData;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setPaths( string $key, string $value ): void
    {
        $this->_paths[ $key ] = $value;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setUrls( string $key, string $value): void
    {
        $this->_urls[ $key ] = $value;
    }

    public function setPrefix(): void
    {
        $this->_prefix = self::TEXTDOMAINE . "-";
    }


    /*******************************************************************  CONSTRUCT  **/

    /**
     * Config Singleton constructor
     */
    private function __construct(){}

    /**
     * Config Singleton instance
     * @return Config
     */
    public static function getInstance(): Config
    {
        if ( ! self::$_instance ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /*******************************************************************  METHODS  **/

    /**
     * @param string $root
     */
    public function init( string $root)
    {
        if ( ! self::$_isInit ){

            $this->setPrefix();

            $this->setRootPath( $root );
            $this->setPluginData( get_plugin_data( $root ) );

            $this->setPaths( "root",    plugin_dir_path( $root ) );
            $this->setPaths( "main",    $this->getPaths('root') . "src/" );
            $this->setPaths( "app",     $this->getPaths('main') . "App/" );
            $this->setPaths( "img",     $this->getPaths('main') . "Images/" );
            $this->setPaths( "css",     $this->getPaths('main') . "Stylesheets/" );
            $this->setPaths( "wp",      $this->getPaths('main') . "Wordpress/" );

            $this->setUrls( "root",     plugin_dir_url( $root) );
            $this->setUrls( "main",     $this->getUrls( 'root') . "src/" );
            $this->setUrls( "app",      $this->getUrls( 'main') . "App/" );
            $this->setUrls( "img",      $this->getUrls( 'main') . "Images/" );
            $this->setUrls( "css",      $this->getUrls( 'main') . "Stylesheets/" );
            $this->setUrls( "wp",       $this->getUrls( 'main') . "Wordpress/" );

            self::$_isInit = true;

        }
    }

}