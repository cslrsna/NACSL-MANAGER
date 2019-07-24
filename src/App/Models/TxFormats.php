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

/**
 * Class TxFormats
 * @package nacsl\App\Models
 */
abstract class TxFormats implements CustomsDataInterface
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
        self::$_name = strtolower(Config::getInstance()->getPrefix() . "tx-Formats");
    }


    /**
     * @return array
     */
    public static function data(): array
    {
        self::setName();

        $labels = array(
            'name'                       => _x( 'Formats de groupes NA', 'Taxonomy General Name', 'nacsl' ),
            'singular_name'              => _x( 'Format de groupe NA', 'Taxonomy Singular Name', 'nacsl' ),
            'menu_name'                  => __( 'Formats des groupes', 'nacsl' ),
            'all_items'                  => __( 'Tous les formats', 'nacsl' ),
            'parent_item'                => __( 'Format parent:', 'nacsl' ),
            'parent_item_colon'          => __( 'Format parent:', 'nacsl' ),
            'new_item_name'              => __( 'Nouveau format', 'nacsl' ),
            'add_new_item'               => __( 'Ajouter un nouveau format', 'nacsl' ),
            'edit_item'                  => __( 'Modifier un format', 'nacsl' ),
            'update_item'                => __( 'Mettre à jour le format', 'nacsl' ),
            'view_item'                  => __( 'Voir le format', 'nacsl' ),
            'separate_items_with_commas' => __( 'Séparé les formats avec une virgule', 'nacsl' ),
            'add_or_remove_items'        => __( 'Ajouter ou retirer des formats', 'nacsl' ),
            'choose_from_most_used'      => __( 'Choisir parmi les plus populaires', 'nacsl' ),
            'popular_items'              => __( 'Formats populaires', 'nacsl' ),
            'search_items'               => __( 'Rechercher de formats', 'nacsl' ),
            'not_found'                  => __( 'Format introuvable', 'nacsl' ),
            'no_terms'                   => __( 'Aucun format', 'nacsl' ),
            'items_list'                 => __( 'Liste de formats', 'nacsl' ),
            'items_list_navigation'      => __( 'Menu de la liste de formats', 'nacsl' ),
        );
        $rewrite = array(
            'slug'                       => 'formats',
            'with_front'                 => true,
            'hierarchical'               => false,
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'query_var'                  => 'formats',
            'rewrite'                    => $rewrite,
            'show_in_rest'               => true,
        );
        $terms = array(
            __("12 ans et plus", "nacsl"),
            __("16 ans et plus", "nacsl"),
            __("Anglais", "nacsl"),
            __("Bilingue", "nacsl"),
            __("Brochures", "nacsl"),
            __("Chaise libre", "nacsl"),
            __("Chandelle", "nacsl"),
            __("Discussion", "nacsl"),
            __("Discussion à la pige", "nacsl"),
            __("Débutants", "nacsl"),
            __("Dépendants seulement", "nacsl"),
            __("Enfants bienvenus", "nacsl"),
            __("Fauteuil roulant", "nacsl"),
            __("Femmes", "nacsl"),
            __("Fermeture temporaire", "nacsl"),
            __("Fermé jours feries.", "nacsl"),
            __("Formats variés", "nacsl"),
            __("LGBT", "nacsl"),
            __("Guide des Étapes", "nacsl"),
            __("Hommes", "nacsl"),
            __("Juste pour aujourd'hui", "nacsl"),
            __("Méditation", "nacsl"),
            __("Partage", "nacsl"),
            __("Pas d'animaux", "nacsl"),
            __("Pas d'enfant", "nacsl"),
            __("Public", "nacsl"),
            __("Texte de Base", "nacsl"),
            __("Thématique", "nacsl"),
            __("Traditions", "nacsl"),
            __("Travail écrit sur les étapes", "nacsl"),
            __("Ça marche, Comment et Pourquoi", "nacsl"),
            __("Étapes NA", "nacsl"),
            __("Études de littératures NA", "nacsl"),
            __("Fermé", "nacsl" ),
            __("Ouvert", "nacsl")
        );

        return array(
            "name"      => self::getName(),
            "labels"    => $labels,
            "args"      => $args,
            "terms"     => $terms
        );
    }

}