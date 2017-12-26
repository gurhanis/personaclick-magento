<?php
/**
 * Copyright © 2017 PersonaClick. All rights reserved.
 */
namespace Personaclick\Personalization\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_resourceConfig;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Config\Model\ResourceModel\Config $resourceConfig
    )
    {
        $this->_resourceConfig = $resourceConfig;

        parent::__construct($context);
    }

    public function getValue($path, $scope = 'default', $scopeId = 0)
    {
        return $this->scopeConfig->getValue($path, $scope, $scopeId);
    }

    public function setValue($path, $value, $scope = 'default', $scopeId = 0)
    {
        return $this->_resourceConfig->saveConfig($path, $value, $scope, $scopeId);
    }

    public function deleteValue($path, $scope = 'default', $scopeId = 0)
    {
        return $this->_resourceConfig->deleteConfig($path, $scope, $scopeId);
    }

    public function isLogEnabled()
    {
        return $this->getValue('personaclick/general/log_status');
    }

    public function isCronEnabled()
    {
        return $this->getValue('personaclick/general/cron_status');
    }

    public function isPersonaclickEnabled()
    {
        if ($this->getValue('personaclick/actions/action_auth') && $this->getValue('personaclick/general/store_key') && $this->getValue('personaclick/general/secret_key')) {
            return true;
        }
    }

    public function isLeadTracking()
    {
        if ($this->getValue('personaclick/actions/action_lead')) {
            return true;
        }
    }
}
