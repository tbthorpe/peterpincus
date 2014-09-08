<?php

App::import('Vendor', 'classTextile', array('file' => 'classTextile.php'));

/**
 *
 * Textile Helper
 *
 * @author nojimage
 * @see http://bakery.cakephp.org/articles/walker/2006/10/17/textile-2-0-0-helper
 *
 * =====
 *
 * You need classTextile.php
 *
 * http://code.google.com/p/textpattern/source/browse/development/4.x/textpattern/lib/classTextile.php
 *
 * download and save to APP/vendors/
 *
 */
class TextileHelper extends AppHelper {

    public $settings = array(
        'lite' => '',
        'encode' => '',
        'noimage' => '',
        'strict' => '',
        'rel' => '',
    );

    public function __construct($config = array()) {
        $this->settings = am($this->settings, $config);
    }

    /**
     *
     * @return Textile
     */
    public function getTextile() {
        static $textile = null;
        if (empty($textile)) {
            $textile = new Textile();
        }
        return $textile;
    }

    /**
     * parse textile string
     *
     * @param string $text
     * @param array  $options
     * @return string
     */
    public function parse($text = '', $options = array()) {
        extract(am($this->settings, $options));
        return $this->getTextile()->TextileThis($text, $lite, $encode, $noimage, $strict, $rel);
    }

}