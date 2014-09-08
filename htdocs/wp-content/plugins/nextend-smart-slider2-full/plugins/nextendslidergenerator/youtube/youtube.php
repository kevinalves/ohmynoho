<?php
nextendimportsmartslider2('nextend.smartslider.settings');

class plgNextendSliderGeneratorYoutube extends NextendPluginBase {

    var $_group = 'youtube';

    function onNextendSliderGeneratorList(&$group, &$list) {
        $group[$this->_group] = 'YouTube';

        if (!isset($list[$this->_group])) $list[$this->_group] = array();
        $list[$this->_group][$this->_group . '_bysearch'] = array('By search', $this->getPath() . 'bysearch' . DIRECTORY_SEPARATOR);
        $list[$this->_group][$this->_group . '_byplaylist'] = array('By playlist', $this->getPath() . 'byplaylist' . DIRECTORY_SEPARATOR);
    }

    function onNextendYoutube(&$google, &$youtube) {
        $config = $this->params instanceof NextendData ? $this->params->toArray() : (array)$this->params->get('config');
        
        if (!class_exists('Google_Client')) require_once dirname(__FILE__) . '/googleclient/Google_Client.php';
        if (!class_exists('Google_YouTubeService')) require_once dirname(__FILE__) . '/googleclient/contrib/Google_YouTubeService.php';

        $google = new Google_Client();
        $google->setClientId(isset($config['apikey']) ? $config['apikey'] : '');
        $google->setClientSecret(isset($config['apisecret']) ? $config['apisecret'] : '');
        isset($config['token']) ? $google->setAccessToken($config['token']) : null;
        $youtube = new Google_YouTubeService($google);

        if ($google->isAccessTokenExpired()) {
            $token = json_decode($google->getAccessToken(), true);
            if(isset($token['refresh_token'])){
                $google->refreshToken($token['refresh_token']);
                $config['token'] = $google->getAccessToken();
                if(nextendIsJoomla()){
                    $this->params->set('config', $config);
                    $db = JFactory::getDBO();
                    $sql = 'UPDATE `#__extensions` SET params = '.$db->quote($this->params->toString()).' WHERE `folder`="nextendslidergenerator" AND `element`="youtube"';
                    $db->setQuery($sql);
                    $db->query();
                }else if(nextendIsWordPress()){
                    $class = get_class($this);
                    if(!add_option($class, $config, '', 'yes')){
                        update_option($class, $config);
                        $this->loadConfig();
                    }
                }
            }
        }
        
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR;
    }
}

/**
 * @return array(Google_Client,Google_Client_YouTube)
 */
function getNextendYoutube() {
    static $google = null, $youtube = null;
    if($google === null){
        NextendPlugin::callPlugin('nextendslidergenerator', 'onNextendYoutube', array(&$google, &$youtube));
    }
    
    if ($google->isAccessTokenExpired()) {
        if (NextendSmartSliderSettings::get('debugmessages', 1)) {
            if(nextendIsJoomla()){
                $db = JFactory::getDBO();
                $sql = 'SELECT `extension_id` FROM `#__extensions` WHERE `folder`="nextendslidergenerator" AND `element`="youtube"';
                $db->setQuery($sql);
                $plg = $db->loadObject();
                echo "<span style='line-height: 24px; padding: 0 10px;'>";
                if ($plg) {
                    $app = JFactory::getApplication();
                    echo 'There are some configuration issues with Youtube API. Please check the <a href="' . JRoute::_(($app->isAdmin() ? '' : 'administrator/').'index.php?option=com_plugins&task=plugin.edit&extension_id=' . $plg->extension_id) . '">settings</a>!<br />';
                } else {
                    echo "Unexpected error in Youtube plugin...";
                }
                echo "</span>";
            }else if(nextendIsWordPress()){
                echo "<span style='line-height: 24px; padding: 0 10px;'>";
                echo 'There are some configuration issues with YouTube API. Please check the settings!<br />';
                echo "</span>";
            }
        }
        return false;
    }
    return array($google, $youtube);
}

NextendPlugin::addPlugin('nextendslidergenerator', 'plgNextendSliderGeneratorYoutube');