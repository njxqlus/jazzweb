<?php

class breadcrumbs {

    function __construct() {

    }

    /**
     * Main page
     * @return object name, url
     */
    public function main() {
        $main_name = get_bloginfo('name');
        $main_url = get_bloginfo('url');
        return (object)array(
            'name' => $main_name,
            'url' => $main_url
        );

    }

    /**
     * Post type
     * @return object name, url
     */
    public function post_type() {
        $post_type = get_post()->post_type;
        $post_type_obj = get_post_type_object($post_type);
        if($post_type == 'page' || $post_type == 'post') {
            $post_type_name = null;
            $post_type_url = null;
        }
        else {
            $post_type_name = $post_type_obj->labels->name;
            $post_type_url = get_post_type_archive_link($post_type);
        }
        return (object)array(
            'name' => $post_type_name,
            'url' => $post_type_url
        );
    }

    /**
     * Parent page
     * @return object name, url
     */
    public function parent_page() {
        $parent_name = null;
        $parent_url = null;
        if(!is_null(get_post())) {
            $id = get_post()->ID;
            $post_type = get_post()->post_type;

            $parents = get_ancestors($id, $post_type);
            if(!empty($parents)) {
                $parent_id = $parents[0];
                $parent_post = get_post($parent_id);
                if($parent_id) {
                    $parent_name = $parent_post->post_title;
                    $parent_url = get_permalink($parent_id);
                }
                else {
                    $parent_name = null;
                    $parent_url = null;
                }
            }
        }
        return (object)array(
            'name' => $parent_name,
            'url' => $parent_url
        );
    }

    /**
     * Post
     * @return object name, url
     */
    public function post() {
        $post_name = get_post()->post_title;
        $post_url = get_permalink();
        return (object)array(
            'name' => $post_name,
            'url' => $post_url
        );
    }

    /**
     * Archive
     * @return object name, url
     */
    public function archive() {
        $archive = get_queried_object();
        $archive_name = null;
        $archive_url = null;
        if(is_archive() && is_tax()) {
            $archive_name = $archive->labels->name;
            $archive_url = get_post_type_archive_link($archive->name);
        }
        return (object)array(
            'name' => $archive_name,
            'url' => $archive_url
        );
    }

    /**
     * Taxonomy
     * @return object name, url
     */
    public function tax() {
        $term = get_queried_object();
        $term_name = null;
        $term_url = null;
        if(is_tax()) {
            $term_name = $term->name;
            $term_url= get_term_link($term->slug, $term->taxonomy);
        }
        return (object)array(
            'name' => $term_name,
            'url' => $term_url
        );
    }

    /**
     * Categories
     * @return object name, url
     */
    public function category() {
        $categories = get_the_category();
        $category_name = null;
        $category_url = null;
        if(is_category() || is_singular('post')) {
            $category_name = $categories[0]->cat_name;
            $category_url = get_category_link($categories[0]->cat_ID);
        }
        return (object)array(
            'name' => $category_name,
            'url' => $category_url
        );
    }

    /**
     * 404 page
     * @return object name
     */
    public function page404() {
        $current_page = ''; 
        $default_port = 80; 
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
            $current_page .= 'https://';
            $default_port = 443;
        } else {
            $current_page .= 'http://';
        }
        $current_page .= $_SERVER['SERVER_NAME'];
        if ($_SERVER['SERVER_PORT'] != $default_port) {
            $current_page .= ':'.$_SERVER['SERVER_PORT'];
        }
        $current_page .= $_SERVER['REQUEST_URI'];
        return (object)array(
            'name' => '404',
            'url' => $current_page
        );
    }

    /**
     * @param $bitem
     * @param bool $link
     * @return string
     */
    public function bitem($bitem, $link = true) {
        if(!method_exists(jazzweb()->breadcrumbs(),$bitem)) { return ''; }
        $bitem = @eval('return jazzweb()->breadcrumbs()->'.$bitem.'();');
        if(is_string($bitem->url) && !empty($bitem->url)) {
            ob_start();
            ?><li class="item"><?php
            if($link == true) {
                ?><a href="<?php echo $bitem->url;?>" title="<?php echo $bitem->name;?>"><?php echo $bitem->name;?></a><?php
            }
            else {
                echo $bitem->name;
            }
            ?></li><?php

            $r = ob_get_clean();
            return $r;
        }
        return '';
    }

    /**
     * @param string $sep
     * @return null|string
     */
    public function get($sep = '/') {
        $sep = '<span class="separator">'.$sep.'</span>';
        $breadcrumbs = null;
        $parent_page = $this->parent_page();
        if(is_404()) {
            $breadcrumbs = implode($sep, array($this->bitem('main'), $this->bitem('page404', false)));
        }
        elseif(is_front_page()) {
            $breadcrumbs = null;
        }
        elseif(is_page()) {
            if(is_null($parent_page->url)) {
                $breadcrumbs = implode($sep, array($this->bitem('main'), $this->bitem('post', false)));
            }
            else {
                $breadcrumbs = implode($sep, array($this->bitem('main'), $this->bitem('parent_page'), $this->bitem('post', false)));
            }
        }

        elseif(is_singular() && !is_page()) {
            if(is_custom_post_type()) {
                $breadcrumbs = implode($sep, array($this->bitem('main'), $this->bitem('post_type'), $this->bitem('post', false)));
            }
            else {
                $breadcrumbs = implode($sep, array($this->bitem('main'), $this->bitem('category'), $this->bitem('post', false)));
            }

        }
        elseif(is_archive()) {
            if(is_tax()) {
                $breadcrumbs = implode($sep, array($this->bitem('main'), $this->bitem('tax', false)));
            }
            elseif(is_post_type_archive()) {
                $breadcrumbs = implode($sep, array($this->bitem('main'), $this->bitem('post_type', false)));
            }
            elseif(is_category()) {
                $breadcrumbs = implode($sep, array($this->bitem('main'), $this->bitem('category', false)));
            }
            else {
                $breadcrumbs = implode($sep, array($this->bitem('main'), $this->bitem('archive', false)));
            }
        }
        return $breadcrumbs;
    }

    /**
     * Echo breadcrumbs
     * @param string $sep
     */
    public function the($sep = '/') {
        if(!is_null($this->get())) {
            ?><ol class="breadcrumb">
                <?php echo $this->get($sep);?>
            </ol><?php
        }
    }

}