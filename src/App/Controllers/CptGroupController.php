<?php
namespace nacsl\App\Controllers;

use nacsl\Wordpress\HooksFrontInterfaces;

/** @package nacsl\App\Controllers */
class CptGroupController implements HooksFrontInterfaces
{

    public function __construct(){
    }
    
    /**
     * @param mixed $post_id 
     * @param mixed $post 
     * @param mixed $update 
     * @return void 
     */
    public function saveGroup($post_id, $post, $update)
    {
        if(empty($update))
            return;
        /**
         * Remove some terms and save post 
         */
        \wp_remove_object_terms($post_id, array('reunion-en-ligne', 'reunions-physiques', 'fermeture-temporaire'), 'nacsl-tx-formats');
        do_action( 'save_post', $post_id, $post, $update );

        /**
         * Get acf fields and term
         */
        $acfFields = \get_fields($post_id, false);
        $terms = \wp_get_post_terms($post_id,array('nacsl-tx-jours', 'nacsl-tx-villes', 'nacsl-tx-formats'));

        /**
         * Get the day slug and metting formats slug
         */
        foreach ($terms as $term) {
            if($term->taxonomy == 'nacsl-tx-jours')
                $day = $term->slug;
            if($term->taxonomy == "nacsl-tx-formats")
                $formats[] = $term->slug;
        }

        /**
         * Set post date
         */
        $hour = $acfFields['heure'];        
        $weekDay = array( 
            'dimanche'  => "01",
            'lundi'     => "02",
            'mardi'     => "03",
            'mercredi'  => "04",
            'jeudi'     => "05",
            'vendredi'  => "06",
            'samedi'    => "07"
        );
        $newPostDate = "2020-03-{$weekDay[$day]} {$hour}.000000";              
        \remove_action('save_post_nacsl-cpt-groupes', array($this, 'saveGroup')); // prevent query loop on update post
        \wp_update_post(array(
            'ID' => $post_id,
            'post_date' => $newPostDate
        ));
        \add_action('save_post_nacsl-cpt-groupes', array($this, 'saveGroup'), 10, 3);

        /**
         * Add terms according to the metting type acf field
         */
        switch ($acfFields['reunion_type']) {
            case 'Hybride':
                \wp_set_post_terms($post_id, array('reunion-en-ligne', 'reunions-physiques'), 'nacsl-tx-formats', true);
                break;
            case 'Physique':
                \wp_set_post_terms($post_id, 'reunions-physiques', 'nacsl-tx-formats', true);
                break;
            case 'Zoom':
                \wp_set_post_terms($post_id, 'reunion-en-ligne', 'nacsl-tx-formats', true);
                break;
            case 'Fermeture temporaire':
                \wp_set_post_terms($post_id, 'fermeture-temporaire', 'nacsl-tx-formats', true);
                break;
        }

        /**
         * Get json test output
         */
        /* $myfile = \fopen(\plugin_dir_path(__DIR__)."Logs/group-change.json", "w");
        \fwrite($myfile, \json_encode(
            array(
                $acfFields,
                $terms
            )
        ));    
        \fclose($myfile); */
        
        /**
         * Unused log change file
         */
        /* $acfType = \get_post_meta($post_id,'reunion_type', \true);

        $acfLocal = \get_post_meta($post_id, 'local', true);
        $acfLocal = !empty($acfLocal) ? "$acfLocal-" : "";

        $acfNo_civique = \get_post_meta($post_id, 'no_civique', \true);
        $acfRue = \get_post_meta($post_id, 'rue', true);
        
        $acfVille = \get_post_meta($post_id, 'ville', true);
        $acfVille = \get_term($acfVille, 'nacsl-tx-villes')->slug;


        $adresse = $acfType == 'Physique'   || $acfType == 'Hybride'    ? "| $acfLocal$acfNo_civique $acfRue $acfVille" : "";
        $acfZoom = $acfType == 'Zoom'       || $acfType == 'Hybride'    ? "| " . \get_post_meta($post_id, 'zoom', true): "";
        $acfClose = $acfType == 'Fermeture temporaire'                  ? $dateFermeture : "";


        $myLog = \fopen(\plugin_dir_path(__DIR__)."Logs/groups-change.log", "a");
        $myDate = date("Y-m-d H:i:s");
        \fwrite($myLog,"$myDate : {$post->post_title} | {$post->post_status} | $jour $acfHeure | $acfType $adresse $acfZoom $acfClose\n");
        \fclose($myLog); */
    }

    public function groupsQuery($query) 
    {
        // do not modify queries in the admin
        if( is_admin() )
           return $query;

        // Next meeting of the current day
        if( \is_archive('nacsl-cpt-groupes')
            && $query->is_main_query()
            && \key_exists('var', $_GET) 
            && $_GET['var'] == 'aujourdhui' 
            ):

            $query->set( 'posts_per_page', 100 );
            /* $query->set( 
                'meta_query' , array(
                    'relation' => 'AND',
                    'jour_clause' => array(
                        'key' => 'jour',
                        'value' => date('w') + 37,
                        'compare' => 'LIKE'
                    ),
                    'heure_clause' => array(
                        'key' => 'heure',
                        'value' => date('h'),
                        'compare' => '>'
                    )
                ) ); */

            $today = date('w') + 1;
            $tomorrow = $today +1;
            $hour = date('H:i', time() - 3600);
            $query->set(
                'date_query',
                array(
                    'after' => "2020-03-0$today 00:00:00",
                    'before' => "2020-03-0$tomorrow 00:00:00"
                )
            );
            
            $query->set( 'orderby', array(
                /* 'jour_clause' => 'ASC',
                'heure_clause' => 'ASC', */
                'post_date' => 'ASC',
                'post_name' => 'ASC'
            ));

            add_filter('get_the_archive_title', function($title){
                echo<<<EOT
<h1 class="page-title"><span style="color: #CFCF2E;font-weight: bold;line-height: 3rem;">Les réunion d'aujourd'hui</span><br>$title</h1>
EOT;
            });
        
        /**
         * Query archive by date and slug name
         */
        elseif( $query->is_main_query()
                && (\is_archive('nacsl-cpt-groupes') 
                || \get_post_type() == 'nacsl-cpt-groupes' )   
                ):
            $query->set( 'posts_per_page', 100 );
            /* $query->set( 
                'meta_query' , array(
                    'relation' => 'AND',
                    'jour_clause' => array(
                        'key' => 'jour'
                    ),
                    'heure_clause' => array(
                        'key' => 'heure'
                    )
                ) 
            ); */
            $query->set( 
                'orderby', array(
                /* 'jour_clause' => 'ASC',
                'heure_clause' => 'ASC', */
                'post_date' => 'ASC',
                'post_name' => 'ASC'
                )
            );
        endif;
        return $query;
    }

    /** @return void  */
    public function nextPost()
    {  
        \add_filter(
            'get_next_post_where',
            function($where){
                $currentPage = \explode('/',$_SERVER['REQUEST_URI']);
                $currentPage = $currentPage[\count($currentPage)-2];
                $currentPage = \get_posts([
                    'name'      => $currentPage,
                    'post_type' => 'nacsl-cpt-groupes'
                ])[0];
                if( ! is_admin() && \is_singular('nacsl-cpt-groupes') )
                    return <<<EOT
WHERE p.post_type = 'nacsl-cpt-groupes'
AND ( p.post_status = 'publish' OR p.post_status = 'private' )
AND ( (p.post_date >= '{$currentPage->post_date}' AND p.post_name > '{$currentPage->post_name}') OR p.post_date > '{$currentPage->post_date}' )
EOT;
            }
        );
        
        \add_filter(
            'get_next_post_sort', 
            function($orderby){
                if( ! is_admin() && \is_singular('nacsl-cpt-groupes') )
                    return ' ORDER BY (p.post_date - SECOND(p.post_date)) ASC, p.post_name ASC LIMIT 1';
            }
        );
    }
    
    /** @return void  */
    public function previousPost()
    {   
        \add_filter(
            'get_previous_post_where',
            function($where){
                $currentPage = \explode('/',$_SERVER['REQUEST_URI']);
                $currentPage = $currentPage[\count($currentPage)-2];
                $currentPage = \get_posts([
                    'name'      => $currentPage,
                    'post_type' => 'nacsl-cpt-groupes'
                ])[0];
                if( ! is_admin() && \is_singular('nacsl-cpt-groupes') )
                    return <<<EOT
WHERE p.post_type = 'nacsl-cpt-groupes'
AND ( p.post_status = 'publish' OR p.post_status = 'private' )
AND ( (p.post_date <= '{$currentPage->post_date}' AND p.post_name < '{$currentPage->post_name}') OR p.post_date < '{$currentPage->post_date}' )
EOT;
            }
        );
        
        \add_filter(
            'get_previous_post_sort', 
            function($orderby){
                if( ! is_admin() && \is_singular('nacsl-cpt-groupes') )
                    return ' ORDER BY (p.post_date - SECOND(p.post_date)) DESC, p.post_name DESC LIMIT 1';
            }
        );
    }

    public function hook() {
        \add_action( 'pre_get_posts', array($this, 'groupsQuery') );
        $this->nextPost();
        $this->previousPost();
        \add_action('save_post_nacsl-cpt-groupes', array($this, 'saveGroup'), 10, 3);
    }
    
}