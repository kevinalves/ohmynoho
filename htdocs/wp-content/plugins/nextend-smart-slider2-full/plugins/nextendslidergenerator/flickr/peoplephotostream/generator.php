<?php

nextendimportsmartslider2('nextend.smartslider.generator_abstract');

class NextendGeneratorFlickr_Peoplephotostream extends NextendGeneratorAbstract {

    var $extraFields;

    function NextendGeneratorFlickr_Peoplephotostream($data) {
        parent::__construct($data);
        $this->_variables = array(
            'id' => 'ID of the photo',
            'title' => 'Title of the photo',
            'description' => 'Description of the photo',
            'owner_username' => 'Username of the photo\'s owner',
            'owner_realname' => 'Real name of the photo\'s owner',
            'owner_photosurl' => 'Photos url of the photo\'s owner',
            'owner_profileurl' => 'Profile url of the photo\'s owner',
            'url_sq' => 'Small square image (75*75)',
            'url_t' => 'Thumbnail image (100 on longest side)',
            'url_s' => 'Small image (240 on longest side)',
            'url_q' => 'Large square image (150*150)',
            'url_m' => 'Medium (500 on longest side)',
            'url_n' => 'Small (320 on longest side)',
            'url_z' => 'Medium (640 on longest side)',
            'url_c' => 'Medium (800 on longest side)',
            'url_l' => 'Large (1024 on longest side)',
            'url_o' => 'Original image'
        );
    }

    function getData($number) {
        $data = array();

        $api = getNextendFlickr();
        if (!$api) return $data;
        $peoplephotostreamprivacy = intval($this->_data->get('peoplephotostreamprivacy', 1));

        $result = $api->people_getPhotos('me', array(
            'per_page' => $number,
            'privacy_filter' => $peoplephotostreamprivacy,
            'extras' => 'description, date_upload, date_taken, owner_name, geo, tags, o_dims, views, media, path_alias, url_sq, url_t, url_s, url_q, url_m, url_n, url_z, url_c, url_l, url_o'
        ));

        $people = array();

        foreach ($result['photos']['photo'] AS $photo) {
            if (!isset($people[$photo['owner']])) {
                $people[$photo['owner']] = $api->people_getInfo($photo['owner']);
            }
            $ow = $people[$photo['owner']];
            $photo['owner_username'] = $ow['username'];
            $photo['owner_realname'] = $ow['realname'];
            $photo['owner_photosurl'] = $ow['photosurl'];
            $photo['owner_profileurl'] = $ow['profileurl'];
            $data[] = $photo;
        }

        return $data;
    }
}