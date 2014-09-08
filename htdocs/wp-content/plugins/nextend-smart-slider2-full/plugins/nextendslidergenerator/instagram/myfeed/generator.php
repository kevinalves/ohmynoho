<?php

nextendimportsmartslider2('nextend.smartslider.generator_abstract');

class NextendGeneratorInstagram_Myfeed extends NextendGeneratorAbstract {

    function NextendGeneratorInstagram_Myfeed($data) {
        parent::__construct($data);
        $this->_variables = array(
            'url' => 'Url of the photo',
            'low_res_image' => 'Low resolution image url',
            'thumbnail_image' => 'Thumbnail image url',
            'standard_res_image' => 'Standard resolution image url',
            'caption' => 'Caption of the image',
            'owner_username' => 'Username of the photo\'s owner',
            'owner_website' => 'Website of the photo\'s owner',
            'owner_profile_picture' => 'Profile picture of the photo\'s owner',
            'owner_full_name' => 'Full name of the photo\'s owner',
            'owner_bio' => 'Bio of the photo\'s owner',
            'comment_count' => 'Comment count on the image'
        );
    }

    function getData($number) {
        $data = array();

        $api = getNextendInstagram();
        if (!$api) return $data;
        $result = json_decode($api->getUserFeed(null, null, $number), true);
        if ($result['meta']['code'] == 200) {
            $i = 0;
            foreach ($result['data'] AS $image) {
                if ($image['type'] != 'image') continue;
                $data[$i]['url'] = $image['link'];
                $data[$i]['low_res_image'] = $image['images']['low_resolution']['url'];
                $data[$i]['thumbnail_image'] = $image['images']['thumbnail']['url'];
                $data[$i]['standard_res_image'] = $image['images']['standard_resolution']['url'];
                $data[$i]['caption'] = is_array($image['caption']) ? $image['caption']['text'] : '';
                $data[$i]['owner_username'] = $image['user']['username'];
                $data[$i]['owner_website'] = $image['user']['website'];
                $data[$i]['owner_profile_picture'] = $image['user']['profile_picture'];
                $data[$i]['owner_full_name'] = $image['user']['full_name'];
                $data[$i]['owner_bio'] = $image['user']['bio'];

                $data[$i]['comment_count'] = $image['comments']['count'];
                $i++;
            }
        }
        return $data;
    }
}