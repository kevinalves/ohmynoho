<?php

class plgNextendSliderGeneratorNextgenGallery extends NextendPluginBase {

    var $_group = 'nextgengallery';

    function onNextendSliderGeneratorList(&$group, &$list) {
    
        if(class_exists('nggGallery') || class_exists('C_Component_Registry')){
            
            $group[$this->_group] = 'Nextgen';
    
            if (!isset($list[$this->_group])) $list[$this->_group] = array();
            $list[$this->_group][$this->_group . '_gallery'] = array('Nextgen Gallery', $this->getPath() . 'gallery' . DIRECTORY_SEPARATOR);
        }
    }

    function getPath() {
        return dirname(__FILE__) . DIRECTORY_SEPARATOR;
    }
}

NextendPlugin::addPlugin('nextendslidergenerator', 'plgNextendSliderGeneratorNextgenGallery');