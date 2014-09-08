<?php

nextendimportsmartslider2('nextend.smartslider.generator_abstract');

class NextendGeneratorPosts_Posts extends NextendGeneratorAbstract {

    function NextendGeneratorPosts_Posts($data) {
        parent::__construct($data);
        $this->_variables = array(
            'id' => 'ID of the post',
            'link' => 'Link to the post',
            'title' => 'Title of the post',
            'content' => 'Content of the post',
            'featured_image' => 'Featured image of the post',
            'author' => 'Name of the author',
            'category_name' => 'Post\'s category name',
            'category_link' => 'Post\'s category link'
        );
    }

    function getData($number) {
        global $post;
        $tmpPost = $post;
        
        $data = array();
        
        $postscategory = (array)NextendParse::parse($this->_data->get('postscategory'));
        
        $cat = '';
        if(!in_array(0, $postscategory)){
            $cat = implode(',',$postscategory);
        }
        
        $order = NextendParse::parse($this->_data->get('postscategoryorder', 'post_date|*|desc'));
        $args = array(
            'posts_per_page'   => $number,
            'offset'           => 0,
            'category'         => $cat,
            'orderby'          => $order[0],
            'order'            => $order[1],
            'include'          => '',
            'exclude'          => '',
            'meta_key'         => '',
            'meta_value'       => '',
            'post_type'        => 'post',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => false
        );
  
        $posts_array = get_posts( $args );
        $i = 0;
        foreach ( $posts_array as $post ){
            setup_postdata( $post );
            $data[$i] = array();
            $data[$i]['id'] = $post->ID;
            $data[$i]['link'] = get_permalink();
            $data[$i]['title'] = apply_filters('the_title', get_the_title());
            $data[$i]['content'] = apply_filters('the_content', get_the_content());
            $data[$i]['author'] = get_the_author();
            
            $cat = get_the_category($post->ID);
            if(isset($cat[0])){
                $data[$i]['category_name'] = $cat[0]->name;
                $data[$i]['category_link'] = get_category_link( $cat[0]->cat_ID );
            }else{
                $data[$i]['category_name'] = '';
                $data[$i]['category_link'] = '';
            }
            
            $data[$i]['featured_image'] = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            if(!$data[$i]['featured_image']) $data[$i]['featured_image'] = '';
            $i++;
        }
        wp_reset_postdata();
        $post = $tmpPost;
        if($post) setup_postdata( $post );
        return $data;
    }
}