<?php

nextendimport('nextend.form.element.list');

class NextendElementSliderLayerAnimation extends NextendElementList {

    function fetchElement() {

        $options = array(
            0 => 'No_animation',
            'fade' => 'Fade',
            'slidelefttoright' => 'Slide_left_to_right',
            'sliderighttoleft' => 'Slide_right_to_left',
            'slidetoptobottom' => 'Slide_top_to_bottom',
            'slidebottomtotop' => 'Slide_bottom_to_top',
            'flipx' => 'Flip_X',
            'fadeup' => 'Fade_up',
            'fadedown' => 'Fade_down',
            'fadeleft' => 'Fade_left',
            'faderight' => 'Fade_right',
            'bounce' => 'Bounce',
            'rotate' => 'Rotate',
            'rotateupleft' => 'Rotate_up_left',
            'rotatedownleft' => 'Rotate_down_left',
            'rotateupright' => 'Rotate_up_right',
            'rotatedownright' => 'Rotate_down_right',
            'rollin' => 'Roll_in',
            'rollout' => 'Roll_out',
            'scale' => 'Scale',
            'kenburnsleftbottom' => 'Ken_Burns_left_bottom',
            'kenburnslefttop' => 'Ken_Burns_left_top',
            'kenburnsrightbottom' => 'Ken_Burns_right_bottom',
            'kenburnsrighttop' => 'Ken_Burns_right_top',
			
            'zoomoutfromtop' => 'Zoom_out_from_top',
            'zoomoutfromleft' => 'Zoom_out_from_right',
            'zoomoutfromright' => 'Zoom_out_from_bottom',
            'zoomoutfrombottom' => 'Zoom_out_from_left',
			
            'zoomoutfromrighttop' => 'Zoom_out_from_right_top',
            'zoomoutfromlefttop' => 'Zoom_out_from_left_top',
            'zoomoutfromrightbottom' => 'Zoom_out_from_right_bottom',
            'zoomoutfromleftbottom' => 'Zoom_out_from_left_bottom'
        );


        if (count($options)) {
            foreach ($options AS $k => $v) {
                $this->_xml->addChild('option', $v)->addAttribute('value', $k);
            }
        }
        $this->_value = $this->_form->get($this->_name, $this->_default);
        $html = parent::fetchElement();
        return $html;
    }

}
