<?php
nextendimportsmartslider2('nextend.smartslider.settings');

class plgNextendSliderGeneratorFlickr extends NextendPluginBase {

    var $_group = 'flickr';

    function onNextendSliderGeneratorList(&$group, &$list) {
        $group[$this->_group] = 'Flickr';

        if (!isset($list[$this->_group])) $list[$this->_group] = array();
        $list[$this->_group][$this->_group . '_peoplephotostream'] = array('My photostream', $this->getPath() . 'peoplephotostream' . DIRECTORY_SEPARATOR);
        $list[$this->_group][$this->_group . '_peoplephotoset'] = array('My photoset', $this->getPath() . 'peoplephotoset' . DIRECTORY_SEPARATOR);
        $list[$this->_group][$this->_group . '_peoplephotogallery'] = array('My gallery', $this->getPath() . 'peoplephotogallery' . DIRECTORY_SEPARATOR);
    }

    function onNextendFlickr(&$flickr) {
        $config = $this->params instanceof NextendData ? $this->params->toArray() : (array)$this->params->get('config');
        
        require_once(dirname(__FILE__) . "/api/phpFlickr.php");
        $flickr = new phpFlickr(isset($config['apikey']) ? $config['apikey'] : '', isset($config['apisecret']) ? $config['apisecret'] : '');
        $flickr->setToken(isset($config['token']) ? $config['token'] : '');
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR;
    }
}

/**
 * @return phpFlickr
 */
function getNextendFlickr() {

    $flickr = null;
    NextendPlugin::callPlugin('nextendslidergenerator', 'onNextendFlickr', array(&$flickr));
    
    if ($flickr->auth_checkToken() === false) {
        if (NextendSmartSliderSettings::get('debugmessages', 1)) {
            if(nextendIsJoomla()){
                $db = JFactory::getDBO();
                $sql = 'SELECT `extension_id` FROM `#__extensions` WHERE `folder`="nextendslidergenerator" AND `element`="flickr"';
                $db->setQuery($sql);
                $plg = $db->loadObject();
                echo "<span style='line-height: 24px; padding: 0 10px;'>";
                if ($plg) {
                    $app = JFactory::getApplication();
                    echo 'There are some configuration issues with Flickr API. Please check the <a href="' . JRoute::_(($app->isAdmin() ? '' : 'administrator/').'index.php?option=com_plugins&task=plugin.edit&extension_id=' . $plg->extension_id) . '">settings</a>!<br />';
                } else {
                    echo "Unexpected error in Flickr plugin...";
                }
                echo "</span>";
            }else if(nextendIsWordPress()){
                echo "<span style='line-height: 24px; padding: 0 10px;'>";
                echo 'There are some configuration issues with Flickr API. Please check the settings!<br />';
                echo "</span>";
            }
        }
        return false;
    }
    return $flickr;
}

NextendPlugin::addPlugin('nextendslidergenerator', 'plgNextendSliderGeneratorFlickr');