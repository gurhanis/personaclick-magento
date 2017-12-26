<?php
/**
 * Copyright © 2017 PersonaClick. All rights reserved.
 */
namespace Personaclick\Personalization\Helper;

class Logger extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_logger;
    protected $_config;
    protected $_status;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Personaclick\Personalization\Helper\Config $config
    )
    {
        $this->_logger = $logger;
        $this->_config = $config;
        $this->_status = $this->_config->isLogEnabled();
    }

    public function log($message = '')
    {
        if ($this->_status) {
            $this->_logger->addDebug($message);
        }
    }
}
