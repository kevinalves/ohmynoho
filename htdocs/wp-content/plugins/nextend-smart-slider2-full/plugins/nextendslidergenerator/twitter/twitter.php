<?php
nextendimportsmartslider2('nextend.smartslider.settings');

class plgNextendSliderGeneratorTwitter extends NextendPluginBase {

    var $_group = 'twitter';

    function onNextendSliderGeneratorList(&$group, &$list) {
        $group[$this->_group] = 'Twitter';

        if (!isset($list[$this->_group])) $list[$this->_group] = array();
        $list[$this->_group][$this->_group . '_timeline'] = array('Timeline', $this->getPath() . 'twittertimeline' . DIRECTORY_SEPARATOR);
    }

    function onNextendTwitter(&$twitter) {
        $config = $this->params instanceof NextendData ? $this->params->toArray() : (array)$this->params->get('config');

        require_once(dirname(__FILE__) . "/api/tmhOAuth.php");
        $twitter = new tmhOAuth(array(
          'consumer_key'    => isset($config['apikey']) ? $config['apikey'] : '',
          'consumer_secret' => isset($config['apisecret']) ? $config['apisecret'] : '',
          'user_token'    => isset($config['token']) ? $config['token'] : '',
          'user_secret' => isset($config['tokensecret']) ? $config['tokensecret'] : ''
        ));
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR;
    }
}


function getNextendTwitter() {

    $twitter = null;
    NextendPlugin::callPlugin('nextendslidergenerator', 'onNextendTwitter', array(&$twitter));
    
    $test = $twitter->request('GET', 'https://api.twitter.com/1.1/statuses/user_timeline.json' , array(
    ));    

    if ($test != 200) {
        if (NextendSmartSliderSettings::get('debugmessages', 1)) {
            if(nextendIsJoomla()){
                $db = JFactory::getDBO();
                $sql = 'SELECT `extension_id` FROM `#__extensions` WHERE `folder`="nextendslidergenerator" AND `element`="twitter"';
                $db->setQuery($sql);
                $plg = $db->loadObject();
                echo "<span style='line-height: 24px; padding: 0 10px;'>";
                if ($plg) {
                    $app = JFactory::getApplication();
                    echo 'There are some configuration issues with Twitter API. Please check the <a href="' . JRoute::_(($app->isAdmin() ? '' : 'administrator/').'index.php?option=com_plugins&task=plugin.edit&extension_id=' . $plg->extension_id) . '">settings</a>!<br />';
                } else {
                    echo "Unexpected error in Twitter plugin...";
                }
                echo "</span>";
            }else if(nextendIsWordPress()){
                echo "<span style='line-height: 24px; padding: 0 10px;'>";
                echo 'There are some configuration issues with Twitter API. Please check the settings!<br />';
                echo "</span>";
            }
        }
        return false;
    }
    return $twitter;
}

NextendPlugin::addPlugin('nextendslidergenerator', 'plgNextendSliderGeneratorTwitter');