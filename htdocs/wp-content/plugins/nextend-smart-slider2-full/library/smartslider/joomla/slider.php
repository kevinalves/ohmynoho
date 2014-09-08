<?php

nextendimportsmartslider2('nextend.smartslider.slider');
nextendimport('nextend.data.data');
nextendimport('nextend.parse.parse');

class NextendSliderJoomla extends NextendSlider{

    var $_data;
    
    var $_module;

    function NextendSliderJoomla(&$module, &$params, $path, $backend = false) {
        parent::NextendSlider($path, $backend);
        
        $sliderid = 0;
        if(is_numeric($params)){
            $this->_module = new stdClass();
            $sliderid = $params;
            $this->_module->id = $sliderid;
        }else{
            $this->_data = new NextendData();
            $config = $params->toArray();
            $this->_data->loadArray(version_compare(JVERSION, '1.6.0', 'l') || !isset($config['config']) ? $config : $config['config']);
    
            nextendimport('nextend.externals.mobiledetect');
            $detect = new Mobile_Detect();
            $tablet = $detect->isTablet();
            $mobile = !$tablet && $detect->isMobile();
    
            if(intval($this->_data->get('showmobile', 1)) == 0){
                if($mobile){
                    $this->_norender = true;
                    return;
                }
            }
    
            $custommobile = NextendParse::parse($this->_data->get('showcustommobile', '0|*|'));
            if($custommobile[0] == 1){
                if($mobile){
                    $this->_data->set('slider', $custommobile[1]);
                }
            }
    
            if(intval($this->_data->get('showtablet', 1)) == 0){
                if($tablet){
                    $this->_norender = true;
                    return;
                }
            }
    
            $customtablet = NextendParse::parse($this->_data->get('showcustomtablet', '0|*|'));
            if($customtablet[0] == 1){
                if($tablet){
                    $this->_data->set('slider', $customtablet[1]);
                }
            }
            $this->_module = $module;
            $sliderid = $this->_data->get('slider');
        }
        
        $this->loadSlider($sliderid);
        
        $this->setTypePath();
        $this->setInstance();
    }
    
    function setInstance() {
        $this->_instance = $this->_module->id;
    }

    function setTypePath() {
        $type = $this->_slider->get('type', 'default');
        JPluginHelper::importPlugin('nextendslidertype', $type);
        $class = 'plgNextendSlidertype' . $type;
        if (!class_exists($class)) {
            echo 'Error in slider type!';
            return false;
        }
        $this->_typePath = call_user_func(array($class, "getPath"));
    }
    
    function parseSlider($slider){
        if(!$this->_backend && NextendSmartSliderJoomlaSettings::getAll('loadposition', 0)){
            $slider = preg_replace_callback('/(data\-itemvalues=")([^"]*)/S', array($this, 'onAttributeData'), $slider);
            $slider = JHTML::_('content.prepare', $slider);
        }
        return $slider;
    }
    
    function onAttributeData($v){
        return preg_replace('/{loadposition.*?}/', '', $v[0]);
    }
}