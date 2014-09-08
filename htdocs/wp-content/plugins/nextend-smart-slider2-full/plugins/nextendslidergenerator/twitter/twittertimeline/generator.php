<?php

nextendimportsmartslider2('nextend.smartslider.generator_abstract');

class NextendGeneratorTwitter_Timeline extends NextendGeneratorAbstract {

    function NextendGeneratorTwitter_Timeline($data) {
        parent::__construct($data);
        $this->_variables = array(
            'tweet' => 'Tweet',
            'source' => 'Source',
            'userid' => 'ID of the user',
            'user_name' => 'Name of the user',
            'user_screen_name' => 'Screen name of the user',
            'user_description' => 'Description of the user',
            'user_location' => 'Location of the user',
            'user_image' => 'Image of the user',
            'user_url' => 'Url of the user'
        );
    }

    function getData($number) {
        $data = array();

        $twitter = getNextendTwitter();
        if (!$twitter) return $data;
        $result = $twitter->request('GET', 'https://api.twitter.com/1.1/statuses/user_timeline.json' , array(
            'count' => $number
        ));
        
        if ($result == 200) {
            $result = json_decode($twitter->response['response'], true);
            $i = 0;
            foreach ($result AS $tweet) {
            
                $data[$i]['tweet'] = $this->makeClickableLinks($tweet['text']);
                $data[$i]['source'] = $tweet['source'];
                $data[$i]['userid'] = $tweet['user']['id'];
                $data[$i]['user_name'] = $tweet['user']['name'];
                $data[$i]['user_screen_name'] = $tweet['user']['screen_name'];
                $data[$i]['user_description'] = $tweet['user']['description'];
                $data[$i]['user_location'] = $tweet['user']['location'];
                $data[$i]['user_image'] = $tweet['user']['profile_image_url_https'];
                $data[$i]['user_url'] = $tweet['user']['url'];
                $i++;
            }
        }
        return $data;
    }
    
    function makeClickableLinks($s) {
        return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $s);
    }
}