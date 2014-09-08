<?php
nextendimportsmartslider2('nextend.smartslider.settings');

class plgNextendSliderGeneratorInstagram extends NextendPluginBase {

    var $_group = 'instagram';

    function onNextendSliderGeneratorList(&$group, &$list) {
        $group[$this->_group] = 'Instagram';

        if (!isset($list[$this->_group])) $list[$this->_group] = array();
        $list[$this->_group][$this->_group . '_myfeed'] = array('My feed', $this->getPath() . 'myfeed' . DIRECTORY_SEPARATOR);
        $list[$this->_group][$this->_group . '_tagsearch'] = array('Search by tag', $this->getPath() . 'tagsearch' . DIRECTORY_SEPARATOR);
    }

    function onNextendInstagram(&$instagram) {
        $config = $this->params instanceof NextendData ? $this->params->toArray() : (array)$this->params->get('config');

        require_once(dirname(__FILE__) . "/api/Instagram.php");
        $c = array(
            'client_id' => isset($config['apikey']) ? $config['apikey'] : '',
            'client_secret' => isset($config['apisecret']) ? $config['apisecret'] : '',
            'redirect_uri' => '',
            'grant_type' => 'authorization_code',
        );

        $instagram = new Instagram($c);

        $instagram->setAccessToken(isset($config['token']) ? $config['token'] : '');
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR;
    }
}

/**
 * @return Instagram
 */
function getNextendInstagram() {
    $instagram = null;
    NextendPlugin::callPlugin('nextendslidergenerator', 'onNextendInstagram', array(&$instagram));

    $test = json_decode($instagram->getUserFeed(), true);

    if ($test['meta']['code'] != 200) {
        if (NextendSmartSliderSettings::get('debugmessages', 1)) {
            $db = JFactory::getDBO();
            $sql = 'SELECT `extension_id` FROM `#__extensions` WHERE `folder`="nextendslidergenerator" AND `element`="instagram"';
            $db->setQuery($sql);
            $plg = $db->loadObject();
            echo "<span style='line-height: 24px; padding: 0 10px;'>";
            if ($plg) {
                $app = JFactory::getApplication();
                echo 'There are some configuration issues with Flickr API. Please check the <a href="' . JRoute::_(($app->isAdmin() ? '' : 'administrator/').'index.php?option=com_plugins&task=plugin.edit&extension_id=' . $plg->extension_id) . '">settings</a>!<br />';
            } else {
                echo "Unexpected error in Instagram plugin...";
            }
            echo "</span>";
        }
        return false;
    }
    return $instagram;
}

NextendPlugin::addPlugin('nextendslidergenerator', 'plgNextendSliderGeneratorInstagram');