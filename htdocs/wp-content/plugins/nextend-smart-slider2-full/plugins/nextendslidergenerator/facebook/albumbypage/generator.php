<?php

nextendimportsmartslider2('nextend.smartslider.generator_abstract');

class NextendGeneratorFacebook_Albumbypage extends NextendGeneratorAbstract {

    function NextendGeneratorFacebook_Albumbypage($data) {
        parent::__construct($data);
        $this->_variables = array(
            'from_name' => 'Creator name',
            'description' => 'Image description',
            'link' => 'Url to the image post',
            'likes' => 'Likes on the image',
            'comments' => 'Comments on the image',
            'icon' => 'Icon of the image',
            'picture' => 'Picture of the image',
            'source' => 'Source of the image',
            'image1' => 'Image original size',
            'image2' => 'Image (960 longest side)',
            'image3' => 'Image (720 longest side)',
            'image4' => 'Image (600 longest side)',
            'image5' => 'Image (480 longest side)',
            'image6' => 'Image (320 longest side)',
            'image7' => 'Image (215 longest side)',
            'image8' => 'Image (130 longest side)',
            'image9' => 'Image (75 width)'
        );
    }

    function getData($number) {
        $data = array();

        $api = getNextendFacebook();
        if (!$api) return $data;

        $facebookalbumsbypage = (array)NextendParse::parse($this->_data->get('facebookalbumsbypage', 'nextendweb|*|'));

        try {
            $result = $api->api($facebookalbumsbypage[1] . '/photos');
            $i = 0;
            foreach ($result['data'] AS $post) {
                $data[$i]['from_name'] = $post['from']['name'];
                $data[$i]['description'] = isset($post['name']) ? $post['name'] : '';
                $data[$i]['link'] = $post['link'];
                $data[$i]['likes'] = isset($post['likes']) && isset($post['likes']['data']) ? count($post['likes']['data']) : 0;
                $data[$i]['comments'] = isset($post['comments']) && isset($post['comments']['data']) ? count($post['comments']['data']) : 0;

                $data[$i]['icon'] = $post['icon'];
                $data[$i]['picture'] = $post['picture'];
                $data[$i]['source'] = $post['source'];
                $x = 1;
                foreach($post['images'] AS $img){
                    if($x == 2 && $img["height"] < 960 && $img["width"] < 960){
                        $data[$i]['image'.$x] = $img['source'];
                        $x++;
                    }
                    $data[$i]['image'.$x] = $img['source'];
                    $x++;
                }
                $i++;

            }
        } catch (Exception $e) {

        }
        return $data;
    }

    function makeClickableLinks($s) {
        return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
    }
}