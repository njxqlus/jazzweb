<?php
/**
 * Check if a post is a custom post type.
 * @since 2.0.0.5
 * @param  mixed $post Post object or ID
 * @return boolean
 */
function is_custom_post_type($post = null) {
    $all_custom_post_types = get_post_types(array('_builtin' => false ));
    if (empty($all_custom_post_types))
        return false;
    $custom_types = array_keys($all_custom_post_types);
    $current_post_type = get_post_type($post);
    if (!$current_post_type)
        return false;
    return in_array($current_post_type, $custom_types);
}

function add_ajax_action($tag, $function_to_add = false, $priority = 10, $accepted_args = 1) {
if (!$function_to_add) {
$function_to_add = $tag . 'cb';
}
add_action('wp_ajax' . $tag, $function_to_add, $priority, $accepted_args);
add_action('wp_ajax_nopriv_' . $tag, $function_to_add, $priority, $accepted_args);
}
function echoJson($data) {
header('Content-Type: application/json; charset=' . get_option('blog_charset'));

echo (json_encode($data));
wp_die();

}

