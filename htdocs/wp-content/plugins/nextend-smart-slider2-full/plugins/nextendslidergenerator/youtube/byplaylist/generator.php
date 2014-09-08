<?php

nextendimportsmartslider2('nextend.smartslider.generator_abstract');

class NextendGeneratorYoutube_ByPlaylist extends NextendGeneratorAbstract {

    function NextendGeneratorYoutube_ByPlaylist($data) {
        parent::__construct($data);
        $this->_variables = array(
            'video_id' => 'Use this with Youtube item! YouTube video code',
            'video_url' => 'Url to the video',
            'title' => 'Video title',
            'description' => 'Video description',
            'channel_title' => 'Channel title',
            'channel_url' => 'Url to the channel',
            'thumbnail_default' => 'Default thumbnail image',
            'thumbnail_medium' => 'Medium thumbnail image',
            'thumbnail_high' => 'High thumbnail image'
        );
    }

    function getData($number) {

        $data = array();

        $a = getNextendYoutube();
        if (!$a) return $data;
        $client = $a[0];
        $youtube = $a[1];
        
        $playlist = $this->_data->get('youtubeplaylist', '');
        if($playlist){
            try {
    
                $videos = $youtube->playlistItems->listPlaylistItems('id,snippet', array(
                    'maxResults' => $number,
                    'playlistId' => $playlist
                ));
                $i = 0;
                foreach ($videos['items'] AS $k => $item) {
                    $data[$i] = array();
    
                    $data[$i]['video_id'] = $item['snippet']['resourceId']['videoId'];
                    $data[$i]['video_url'] = 'http://www.youtube.com/watch?v=' . $item['snippet']['resourceId']['videoId'];
                    $data[$i]['title'] = $item['snippet']['title'];
                    $data[$i]['description'] = $item['snippet']['description'];
                    $data[$i]['thumbnail_default'] = $item['snippet']['thumbnails']['default']['url'];
                    $data[$i]['thumbnail_medium'] = $item['snippet']['thumbnails']['medium']['url'];
                    $data[$i]['thumbnail_high'] = $item['snippet']['thumbnails']['high']['url'];
                    $data[$i]['channel_title'] = $item['snippet']['channelTitle'];
                    $data[$i]['channel_url'] = 'http://www.youtube.com/user/' . $item['snippet']['channelTitle'];
                    $i++;
                }
    
            } catch (Google_ServiceException $e) {
                echo sprintf('<p>A service error occurred: <code>%s</code></p>',
                    htmlspecialchars($e->getMessage()));
            }
    
            catch
            (Google_Exception $e) {
                echo sprintf('<p>An client error occurred: <code>%s</code></p>',
                    htmlspecialchars($e->getMessage()));
            }
        }
        return $data;
    }
}