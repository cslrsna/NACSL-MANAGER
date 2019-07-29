<?php
/**
 * Created by Bruno Pouliot.
 * Email: dev.lecanardnoir@gmail.com
 * Date: 7/21/19
 * Time: 11:29 PM
 */

namespace nacsl\App\Models;

use nacsl\App\Config;
use nacsl\App\Helpers\CustomsDataInterface;

abstract class CptSousComites implements CustomsDataInterface
{
    private static $_name = "";

    /**
     * @return string
     */
    public static function getName(): string
    {
        return self::$_name;
    }

    /**
     */
    public static function setName(): void
    {
        self::$_name = strtolower(Config::getInstance()->getPrefix() . "cpt-comites");
    }


    /**
     * @return array
     */
    public static function data(): array
    {

        self::setName();

        $labels = array(
            'name'                  => _x( 'Gestionnaire des sous-comités du CSL de Narcotiques Anonymes', 'Post Type General Name', 'nacsl' ),
            'singular_name'         => _x( 'sous-comité', 'Post Type Singular Name', 'nacsl' ),
            'menu_name'             => __( 'Sous-comités', 'nacsl' ),
            'name_admin_bar'        => __( 'Sous-comités', 'nacsl' ),
            'archives'              => __( 'Archives des sous-comités', 'nacsl' ),
            'attributes'            => __( 'Attributs du sous-comité', 'nacsl' ),
            'parent_item_colon'     => __( 'Groupe parent:', 'nacsl' ),
            'all_items'             => __( 'Tous les sous-comités', 'nacsl' ),
            'add_new_item'          => __( 'Ajouter un sous-comité', 'nacsl' ),
            'add_new'               => __( 'Ajouter un sous-comité', 'nacsl' ),
            'new_item'              => __( 'Nouveau sous-comité', 'nacsl' ),
            'edit_item'             => __( 'Modifier un sous-comité', 'nacsl' ),
            'update_item'           => __( 'Mettre à jour le sous-comité', 'nacsl' ),
            'view_item'             => __( 'Voir le sous-comité', 'nacsl' ),
            'view_items'            => __( 'Voir les sous-comités', 'nacsl' ),
            'search_items'          => __( 'Rechercher un sous-comité', 'nacsl' ),
            'not_found'             => __( 'Aucun sous-comité', 'nacsl' ),
            'not_found_in_trash'    => __( 'Aucun groupe dans la corbeille', 'nacsl' ),
            'featured_image'        => __( 'Images du sous-comité', 'nacsl' ),
            'set_featured_image'    => __( 'Attribuer une image au sous-comité', 'nacsl' ),
            'remove_featured_image' => __( 'Retirer l\'image du sous-comité', 'nacsl' ),
            'use_featured_image'    => __( 'Utiliser l\'image du sous-comité', 'nacsl' ),
            'insert_into_item'      => __( 'Insérer dans un sous-comité', 'nacsl' ),
            'uploaded_to_this_item' => __( 'Téléverser au sous-comité', 'nacsl' ),
            'items_list'            => __( 'Liste des sous-comités', 'nacsl' ),
            'items_list_navigation' => __( 'Liste des sous-comités', 'nacsl' ),
            'filter_items_list'     => __( 'Filtrer la liste de sous-comités', 'nacsl' ),
        );

        $rewrite = array(
            'slug'                  => 'sous-comités',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );

        $args = array(
            'label'                 => __( 'sous-comité', 'nacsl' ),
            'description'           => __( 'Registre des sous-comités CSL de Narcotiques Anonymes.', 'nacsl' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies'            => array( 'category' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => -1,
            'menu_icon'             => Config::getInstance()->getUrls('img') . 'logo-na.png',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'post',
            'show_in_rest'          => false,
        );

        return array(
            "name"      => self::getName(),
            "labels"    => $labels,
            "args"      => $args
        );
    }

}
