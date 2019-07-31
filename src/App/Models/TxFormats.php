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

        $td = Config::TEXTDOMAINE;

        $labels = array(
            'name'                       => _x( 'Formats de groupes NA', 'Taxonomy General Name', $td ),
            'singular_name'              => _x( 'Format de groupe NA', 'Taxonomy Singular Name', $td ),
            'menu_name'                  => __( 'Formats des groupes', $td ),
            'all_items'                  => __( 'Tous les formats', $td ),
            'parent_item'                => __( 'Format parent:', $td ),
            'parent_item_colon'          => __( 'Format parent:', $td ),
            'new_item_name'              => __( 'Nouveau format', $td ),
            'add_new_item'               => __( 'Ajouter un nouveau format', $td ),
            'edit_item'                  => __( 'Modifier un format', $td ),
            'update_item'                => __( 'Mettre à jour le format', $td ),
            'view_item'                  => __( 'Voir le format', $td ),
            'separate_items_with_commas' => __( 'Séparé les formats avec une virgule', $td ),
            'add_or_remove_items'        => __( 'Ajouter ou retirer des formats', $td ),
            'choose_from_most_used'      => __( 'Choisir parmi les plus populaires', $td ),
            'popular_items'              => __( 'Formats populaires', $td ),
            'search_items'               => __( 'Rechercher de formats', $td ),
            'not_found'                  => __( 'Format introuvable', $td ),
            'no_terms'                   => __( 'Aucun format', $td ),
            'items_list'                 => __( 'Liste de formats', $td ),
            'items_list_navigation'      => __( 'Menu de la liste de formats', $td ),
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
            __("12 ans et plus", $td ),
            __("16 ans et plus", $td ),
            __("Anglais", $td ),
            __("Bilingue", $td ),
            __("Brochures", $td ),
            __("Chaise libre", $td ),
            __("Chandelle", $td ),
            __("Discussion", $td ),
            __("Discussion à la pige", $td ),
            __("Débutants", $td ),
            __("Dépendants seulement", $td ),
            __("Enfants bienvenus", $td ),
            __("Fauteuil roulant", $td ),
            __("Femmes seulement", $td ),
            __("Fermeture temporaire", $td ),
            __("Fermé jours feries.", $td ),
            __("Formats variés", $td ),
            __("LGBT", $td ),
            __("Guide des Étapes", $td ),
            __("Hommes seulement", $td ),
            __("Juste pour aujourd'hui", $td ),
            __("Méditation", $td ),
            __("Partage", $td ),
            __("Pas d'animaux", $td ),
            __("Pas d'enfant", $td ),
            __("Public", $td ),
            __("Texte de Base", $td ),
            __("Thématique", $td ),
            __("Traditions", $td ),
            __("Travail écrit sur les étapes", $td ),
            __("Ça marche, Comment et Pourquoi", $td ),
            __("Étapes NA", $td ),
            __("Études de littératures NA", $td ),
            __("Fermé; membres seulement", $td ),
            __("Ouvert au public", $td )
        );

        return array(
            "name"      => self::getName(),
            "labels"    => $labels,
            "args"      => $args,
            "terms"     => $terms
        );
    }

}