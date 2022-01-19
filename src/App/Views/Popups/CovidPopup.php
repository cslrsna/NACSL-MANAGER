<?php
namespace nacsl\App\Views\Popups;
use nacsl\Wordpress\HooksInterfaces;

class CovidPopup implements HooksInterfaces
{

	public function __construct(){}

	public function covid_advice() {
		echo file_get_contents(plugins_url( "covid_webcomponent.html", __FILE__ ));
	}

	public function covid_js() {
		wp_enqueue_script('covid_popup', plugins_url( "covid_popup.js", __FILE__ ), [], null, true);
		wp_enqueue_style( "covid_style", plugins_url( "covid_popup.css", __FILE__ ), array(), false, 'all' );
	}

    public function hook() {
		add_action( 'wp_footer', array($this,'covid_advice') );
		add_action('wp_enqueue_scripts', array($this,'covid_js'));
	 }
	
}



