<?php
/**
 * Copyright © 2017 PersonaClick. All rights reserved.
 */
namespace Personaclick\Personalization\Helper;

class Cookie extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_cookie;
    protected $_cookieMetadata;

    public function __construct(
        \Magento\Framework\Stdlib\Cookie\PhpCookieManager $cookie,
        \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadata
    )
    {
        $this->_cookie = $cookie;
        $this->_cookieMetadata = $cookieMetadata;
    }

    public function get($name)
    {
        return $this->_cookie->getCookie($name);
    }

    public function set($name, $value)
    {
        return $this->_cookie->setPublicCookie($name, $value, $this->getMetadata());
    }

    public function delete($name)
    {
        return $this->_cookie->deleteCookie($name, $this->getMetadata());
    }

    protected function getMetadata()
    {
        return $this->_cookieMetadata->createPublicCookieMetadata()->setPath('/');
    }
}
