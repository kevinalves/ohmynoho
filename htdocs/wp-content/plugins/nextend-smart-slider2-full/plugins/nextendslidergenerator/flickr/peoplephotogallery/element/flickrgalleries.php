<?php

nextendimport('nextend.form.element.list');

class NextendElementFlickrGalleries extends NextendElementList {

    function fetchElement() {

        $this->_xml->addChild('option', 'Please choose')->addAttribute('value', '0');
        ob_start();
        $api = getNextendFlickr();
        if ($api) {
            ob_end_clean();
            $result = $api->galleries_getList('');

            if (isset($result['galleries']) && isset($result['galleries']['gallery'])) {
                $galleries = $result['galleries']['gallery'];

                if (count($galleries)) {
                    foreach ($galleries AS $gallery) {
                        $this->_xml->addChild('option', htmlentities($gallery['title']))->addAttribute('value', $gallery['id']);
                    }
                }
            }
        }
        $this->_value = $this->_form->get($this->_name, $this->_default);
        $html = parent::fetchElement();

        if (!$api) {
            $html .= ob_get_clean();
        }
        return $html;
    }

}
