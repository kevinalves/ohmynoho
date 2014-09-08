<?php

nextendimport('nextend.form.element.text');

class NextendElementFacebookToken extends NextendElementText {

    function fetchElement() {
        $js = NextendJavascript::getInstance();
        $js->addLibraryJsAssetsFile('dojo', 'element.js');
        $js->addLibraryJsFile('dojo', dirname(__FILE__).'/facebooktoken.js');
        $js->addLibraryJs('dojo', '
            new NextendElementFacebookToken({
              hidden: "' . $this->_id . '",
              link: "nextend-facebook-request-token",
              callback: "nextend-facebook-callback",
              folder: "'.NextendFilesystem::pathToRelativePath(realpath(dirname(__FILE__).'/..')).'/'.'"
            });
        ');
        $html = parent::fetchElement();

        $html.='<a href="#" id="nextend-facebook-request-token" style="line-height: 24px;">Request token</a>';

        $html.='<span id="nextend-facebook-callback" style="line-height: 24px;clear: both;float:left;"></span>';

        return $html;
    }
}
