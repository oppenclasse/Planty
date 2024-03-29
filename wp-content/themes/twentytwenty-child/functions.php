<?php

// Action qui permet de charger des scripts dans notre thème
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles(){
    // Chargement du style.css du thème parent Twenty Twenty
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    
    // Chargement du css/theme.css pour nos personnalisations
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
}
// Fonction pour ajouter un lien "Admin" dans le menu de navigation
function ajouter_lien_admin_au_menu( $items, $args ) {
    if ( is_user_logged_in() && $args->theme_location == 'primary' ) {
        // Récupérer la position du lien "Nous Rencontrer"
        $position_nous_rencontrer = strpos($items, 'Nous Rencontrer');
        
        // Calculer la position pour insérer le lien "Admin"
        $position_insertion = $position_nous_rencontrer + strlen('Nous Rencontrer') + 4; // 4 est la longueur de la balise "</a>"

        // Créer l'élément de menu pour le lien "Admin"
        $admin_link = '<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-41"><a href="' . admin_url() . '">' . __("Admin") . '</a></li>';

        // Insérer le lien "Admin" après le lien "Nous Rencontrer"
        $items = substr_replace($items, $admin_link, $position_insertion, 0);
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'ajouter_lien_admin_au_menu', 10, 2 );
