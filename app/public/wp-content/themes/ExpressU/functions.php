<?php

function university_files() {
//enable js script
  wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
//enable font
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    //enable css
  wp_enqueue_style('university_main_styles', get_stylesheet_uri(),NULL, microtime()); //disable css cashe
}
//Title For Page
function university_features(){
    //disabled dynamic menu
//    register_nav_menu('headerMenuLocation', 'Header Menu Location');
//    register_nav_menu('footerLocationOne', 'Footer Location One');
//    register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');
    
}
//adjust queries to wp_query objects of events archive 
function university_adjust_queries($query){
    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
         $query->set('meta_key', 'event_date');
         $query->set('orderby', 'meta_value_num');
         $query->set('order','ASC');
         $query->set('meta_query' , array(
                    array(
                         $today = date('Ymd'),
                        'key' => 'event_date',
                        'compare' => ('>='),
                        'value' => $today,
                        'type' => 'numeric'
                    )
                ));
    }
   
    
}

add_action('wp_enqueue_scripts', 'university_files');
add_action('after_setup_theme', 'university_features');
add_action('pre_get_posts', 'university_adjust_queries');