<?php
/**
 * Belgian Police Web Platform - Districts Component
 *
 * @copyright	Copyright (C) 2012 - 2013 Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/belgianpolice/internet-platform
 */

namespace Nooku\Component\Forms;
use Nooku\Library;

class DatabaseRowEntry extends Library\DatabaseRowTable
{
    public function save()
    {
        $validation = true;

        // Validate the reCaptcha response
        $validation = $this->recaptcha($this->_data['g-recaptcha-response']);

        $text = array();

        foreach($this->_data as $key => $value)
        {
            if(!$this->getTable()->getColumn($key) && $key !== '_token')
            {
                $text[$key] = $value;
            }
        }

        $this->text = $text;

        // enable user error handling
        libxml_use_internal_errors(true);

        $html = file_get_contents('http://police.dev/5388/forms?view=form&id='.$this->forms_form_id);

        $dom = new \DOMDocument();
        $dom->loadHTML($html);

        foreach($dom->getElementsByTagName('input') as $element)
        {
            $type = $element->getAttribute('type');

            if($type == 'email'){
                $validation = $this->validateEmail($this->{$element->getAttribute('name')});
            }
        }

        if($validation)
        {
            return parent::save();
        }

        return false;
    }

    public function validateEmail($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

    public function recaptcha($gRecaptchaResponse, $remoteIp = false)
    {
        require_once(JPATH_VENDOR . '/autoload.php');

        $recaptcha = new \ReCaptcha\ReCaptcha(\JFactory::getConfig()->getValue('config.reCaptchaSecret'));
        $response = $recaptcha->verify($gRecaptchaResponse, $remoteIp);

        if ($response->isSuccess())
        {
            return true;
        } else {
            $errors = $response->getErrorCodes();
        }

        return $errors;
    }
}