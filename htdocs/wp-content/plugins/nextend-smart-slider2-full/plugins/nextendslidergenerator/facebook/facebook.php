<?php
nextendimportsmartslider2('nextend.smartslider.settings');

class plgNextendSliderGeneratorFacebook extends NextendPluginBase {

    var $_group = 'facebook';

    function onNextendSliderGeneratorList(&$group, &$list) {
        $group[$this->_group] = 'Facebook';

        if (!isset($list[$this->_group])) $list[$this->_group] = array();
        $list[$this->_group][$this->_group . '_postsbypage'] = array('Posts by page', $this->getPath() . 'postsbypage' . DIRECTORY_SEPARATOR);
        $list[$this->_group][$this->_group . '_albumbypage'] = array('Photos by page album', $this->getPath() . 'albumbypage' . DIRECTORY_SEPARATOR);
        $list[$this->_group][$this->_group . '_albumbyuser'] = array('Photos by user album', $this->getPath() . 'albumbyuser' . DIRECTORY_SEPARATOR);
    }

    function onNextendFacebook(&$facebook) {
        $config = $this->params instanceof NextendData ? $this->params->toArray() : (array)$this->params->get('config');

        require_once(dirname(__FILE__) . "/api/facebook.php");

        $facebook = new Facebook(array(
            'appId' => isset($config['apikey']) ? $config['apikey'] : '',
            'secret' => isset($config['apisecret']) ? $config['apisecret'] : '',
        ));

        $facebook->setAccessToken(isset($config['token']) ? $config['token'] : '');
    }

    function onNextendFacebookPageAlbums(&$data){
        $page = NextendRequest::getVar('fbpage', '');
        $api = getNextendFacebook();
        $data = array();
        if ($api) {
            try {
                $result = $api->api($page.'/albums');
                if (count($result['data'])) {
                    foreach ($result['data'] AS $album) {
                        $data[$album['id']] = $album['name'];
                    }
                }
            } catch (Exception $e) {
                $data = null;
            }
        }
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR;
    }
}

/**
 * @return Facebook
 */
function getNextendFacebook() {

    $facebook = null;
    NextendPlugin::callPlugin('nextendslidergenerator', 'onNextendFacebook', array(&$facebook));

    try {
        $test = $facebook->api('/me');
    } catch (Exception $e) {
        if (NextendSmartSliderSettings::get('debugmessages', 1)) {
            if(nextendIsJoomla()){
                $db = JFactory::getDBO();
                $sql = 'SELECT `extension_id` FROM `#__extensions` WHERE `folder`="nextendslidergenerator" AND `element`="facebook"';
                $db->setQuery($sql);
                $plg = $db->loadObject();
                echo "<span style='line-height: 24px; padding: 0 10px;'>";
                if ($plg) {
                    $app = JFactory::getApplication();
                    echo 'There are some configuration issues with Facebook API. Please check the <a href="' . JRoute::_(($app->isAdmin() ? '' : 'administrator/') . 'index.php?option=com_plugins&task=plugin.edit&extension_id=' . $plg->extension_id) . '">settings</a>!<br />';
                } else {
                    echo "Unexpected error in Facebook plugin...";
                }
                echo "</span>";
            }else if(nextendIsWordPress()){
                echo "<span style='line-height: 24px; padding: 0 10px;'>";
                echo 'There are some configuration issues with Facebook API. Please check the settings!<br />';
                echo "</span>";
            }
        }
        return false;
    }

    return $facebook;
}

NextendPlugin::addPlugin('nextendslidergenerator', 'plgNextendSliderGeneratorFacebook');