<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace SprykerFeature\Zed\Library;

class Translate extends \Zend_Translate
{

}

/**
 * @param $string
 *
 * @throws \ErrorException
 *
 * @return mixed
 */
function __($string)
{
    $registry = \Zend_Registry::getInstance();
    /* @var Translate $instance */
    if ($registry->isRegistered('Zend_Translate')) {
        $instance = $registry->get('Zend_Translate');

        return $instance->_($string);
    } else {
        throw new \ErrorException('No instance of Zend_Translate initiated.');
    }
}
