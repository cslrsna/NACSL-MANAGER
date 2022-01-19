<?php
namespace nacsl\App\Views;

use nacsl\Wordpress\HooksFrontInterfaces;

class CptGroupView implements HooksFrontInterfaces
{

    public function __construct(){}

    public function nacsl_paypal_button ($post){
        $title = get_the_title( $post->ID );
        $paypal_btn = <<<EOT
[paypal-donation reference="$title"]
<h2>Contribution minimum 1$</h2>
<p><strong>Toutes contributions seront administrés par le CSLRSNA, ce qui permettra de supporter et d’assurer la continuité des groupes NA de la rive-sud de Montréal après la situation exceptionnelle que nous vivons actuellement.</strong></p>
EOT;
        return do_shortcode( $paypal_btn );
    }

    public function render( $content ) {

        global $post;
        !\is_archive('nacsl-cpt-groupes') ? $paypal_btn = $this->nacsl_paypal_button( $post ) : $paypal_btn="";
    
        $local = do_shortcode( "[acf field='field_5f80c906a250a']" );
        if ( isset( $local ) && $local != "" ) {
            $local = " local $local";
        }else{
            $local = null;
        }
    
        switch( $post->post_type ) {
            case 'nacsl-cpt-groupes':
                $email = do_shortcode("[acf field='field_5f79f4cfc8886']");
                $content = <<<EOT
<div>
[taxcond tax="nacsl-tx-formats" name="Fermeture temporaire"]
<h4 style="color: #cf2e2e !important; text-transform: uppercase; font-weight: 900 !important;">Réunion fermée temporairement</h4>
<strong>Date de fermeture:</strong><br> [acf field="field_5f750b9b8d6fc"]<br>
<strong>Réouverture prévue:</strong><br> [acf field="field_5f750d85d1fb2"]
[/taxcond]

[acfcond field="field_5f74cdb6fdb99" test="Physique"]
<h2 style="color: #26a324 !important; font-weight: 900 !important;">Réunion Physique</h2>
<h5>Adresse:<br>
[acf field="field_5f74fc7265056"] [acf field="field_5f74fdc13be36"], [nacsl-tx-villes] Québec<br>
$local</h5>
[/acfcond]

[acfcond field="field_5f74cdb6fdb99" test="Zoom"]
<h2 style="color: #1e90ff !important; font-weight: 900 !important;">Réunion en ligne zoom</h2>
[/acfcond]

[acfcond field="field_5f74cdb6fdb99" test="Hybride"]
<h2 style="font-weight: 900 !important;">Réunion hybride:<br>
<span style="color: #26a324 !important; font-weight: 900 !important;">physique</span> <small>et</small> <span style="color: #1e90ff !important; font-weight: 900 !important;">en ligne</span></h2>
<h5>Adresse:<br>
[acf field="field_5f74fc7265056"] [acf field="field_5f74fdc13be36"], [nacsl-tx-villes] Québec<br>
$local</h5>
[/acfcond]
<h5>Horaire:
[nacsl-tx-jours] <small>à</small> [acf field="field_5f7516d7d1139"]<br><br>
<small>[nacsl-tx-formats]<strong>Formats de la réunion:</strong>
[/nacsl-tx-formats]</small>
</h5>
[acfcond field="field_5f778e0c6fb80"]
<h5><small>Informations supplémentaires:</small></h5>
[acf field="field_5f778e0c6fb80"][/acfcond]

<!--[acfcond field="field_5f79f4cfc8886"]
<h5><small>Courriel du groupe: <br><a style="text-transform: lowercase;" href="mailto:$email">[acf field="field_5f79f4cfc8886"]</a></small></h5>[/acfcond] -->

[acfcond field="field_5f74cdb6fdb99" test="Zoom"]
<br><a class="button wp-block-button__link zoom_btn" href="[acf field='field_5f7505549a2d0']" target="_blank">Rejoindre la réunion Zoom</a><br><br>
$paypal_btn<br>
[/acfcond]

[acfcond field="field_5f74cdb6fdb99" test="Hybride"]
<br><a class="button wp-block-button__link zoom_btn" href="[acf field='field_5f7505549a2d0']" target="_blank">Rejoindre la réunion Zoom</a><br><br>
$paypal_btn<br>
<!-- <h5>Google Maps</h5> -->
[gmapcond no="field_5f74fc7265056" rue="field_5f74fdc13be36"][/acfcond]

[acfcond field="field_5f74cdb6fdb99" test="Physique"]
<!-- <h5>Google Maps</h5> -->
<p>
[gmapcond no="field_5f74fc7265056" rue="field_5f74fdc13be36"]
[/acfcond]
</p>
</div>
EOT;
            break;
            case 'nacsl-cpt-comites':
                $content = <<<EOT
<div>
[acf field="field_5f7a16959118a"]

[acfcond field="field_5f7a1bc2b9e2c" test="Fermeture temporaire"]
<h4 style="color: #cf2e2e !important; text-transform: uppercase; font-weight: 900 !important;">La réunion est fermée temporairement</h4>
<strong>Date de fermeture:</strong><br> [acf field="field_5f750b9b8d6fc"]<br>
<strong>Réouverture prévue:</strong><br> [acf field="field_5f750d85d1fb2"]
[/acfcond]
[acfcond field="field_5f79f158d3b16"]
<h5>Date de la prochaine réunion:<br>
[acf field="field_5f79f158d3b16"] <small>à</small> [acf field="field_5f7516d7d1139"]</h5>
[/acfcond]

[acfcond field="field_5f7a1bc2b9e2c" test="Physique"]
<h2 style="color: #26a324 !important; font-weight: 900 !important;">Réunion Physique</h2>
<h5>Adresse:<br>
[acf field="field_5f7a1bc2b9e7e"] [acf field="field_5f7a1bc2b9ece"], [nacsl-tx-villes] Québec<br>
$local</h5>
[/acfcond]

[acfcond field="field_5f7a1bc2b9e2c" test="Zoom"]
<h2 style="color: #1e90ff !important; font-weight: 900 !important;">Réunion en ligne zoom</h2>
[/acfcond]

[acfcond field="field_5f7a1bc2b9e2c" test="Hybride"]
<h2 style="font-weight: 900 !important;">Réunion hybride:<br>
<span style="color: #26a324 !important; font-weight: 900 !important;">physique</span> <small>et</small> <span style="color: #1e90ff !important; font-weight: 900 !important;">en ligne</span></h2>
<h5>Adresse:<br>
[acf field="field_5f7a1bc2b9e7e"] [acf field="field_5f7a1bc2b9ece"], [nacsl-tx-villes] Québec<br>
$local</h5>
[/acfcond]
<h5>Horaire régulière:<br>
[nacsl-tx-jours] <small>à</small> [acf field="field_5f7516d7d1139"]
</h5>

[acfcond field="field_5f7a1bc2b9e2c" test="Zoom"]
<br>
<p><a class="button wp-block-button__link zoom_btn" href="[acf field='field_5f7a1bc2b9f52']">Rejoindre la réunion Zoom</a></p>
[/acfcond]

[acfcond field="field_5f7a1bc2b9e2c" test="Hybride"]
<p><a class="button wp-block-button__link zoom_btn" href="[acf field='field_5f7a1bc2b9f52']">Rejoindre la réunion Zoom</a></p>
<!-- <h5>Google Maps</h5> -->
<p>[gmapcond no="field_5f7a1bc2b9e7e" rue="field_5f7a1bc2b9ece"]</p>
[/acfcond]

[acfcond field="field_5f7a1bc2b9e2c" test="Physique"]
<!-- <h5>Google Maps</h5> -->
<p>[gmapcond no="field_5f7a1bc2b9e7e" rue="field_5f7a1bc2b9ece"]</p>
[/acfcond]
<br>
$content
[acfcond field="field_5f7a16cd9118c"]
<h5><small>Informations supplémentaires:</small></h5>
<p>[acf field="field_5f7a16cd9118c"]</p>[/acfcond]
</div>
EOT;
            break;
            case 'pictures':
                $content = 'your content';
            break;
            default:
                // $content = 'your default content';
            break;
        }
    
        return do_shortcode( $content );;
    }

    public function hook() { 
        add_filter( 'the_content', array($this, 'render') );
    }
    
}
