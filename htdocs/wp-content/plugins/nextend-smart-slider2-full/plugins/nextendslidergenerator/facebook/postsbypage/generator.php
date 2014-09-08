<?php

nextendimportsmartslider2('nextend.smartslider.generator_abstract');

class NextendGeneratorFacebook_Postsbypage extends NextendGeneratorAbstract {

    function NextendGeneratorFacebook_Postsbypage($data) {
        parent::__construct($data);
        $this->_variables = array(
            'link' => 'Url of post',
            'message' => 'Message of the post',
            'picture' => 'Picture of the post',
            'story' => 'Story of the post (only for status type)'
        );
    }

    function getData($number) {
        $data = array();

        $api = getNextendFacebook();
        if (!$api) return $data;

        $facebookpostbypage = (array)explode('||', $this->_data->get('facebookpostbypage', 'photo'));

        try {
            $result = $api->api($this->_data->get('facebookpostbypagepage', 'nextendweb').'/posts');
            $i = 0;
            foreach ($result['data'] AS $post) {
                if (!in_array($post['type'], $facebookpostbypage)) continue;
                $data[$i]['link'] = isset($post['link']) ? $post['link'] : '';
                $data[$i]['message'] = isset($post['message']) ? str_replace("\n", "<br/>", $this->makeClickableLinks($post['message'])) : '';
                $data[$i]['message'] = isset($post['message']) ? str_replace("\n", "<br/>", $this->makeClickableLinks($post['message'])) : '';
                $data[$i]['story'] = isset($post['story']) ? $this->makeClickableLinks($post['story']) : '';
                $data[$i]['type'] = $post['type'];
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