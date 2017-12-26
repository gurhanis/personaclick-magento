<?php
/**
 * Copyright © 2017 PersonaClick. All rights reserved.
 */
namespace Personaclick\Personalization\Observer;

class OrderStatus implements \Magento\Framework\Event\ObserverInterface
{
    protected $_config;
    protected $_api;

    public function __construct(
        \Personaclick\Personalization\Helper\Config $config,
        \Personaclick\Personalization\Helper\Api $api
    )
    {
        $this->_config = $config;
        $this->_api = $api;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        $old_status = $order->getOrigData('status');
        $new_status = $order->getData('status');

        if ($old_status != $new_status) {
            $order_id = $order->getId();
            $order_status_id = $new_status;

            $personaclick_order_created = explode(',', $this->_config->getValue('personaclick/general/order_created'));;
            $personaclick_order_completed = explode(',', $this->_config->getValue('personaclick/general/order_completed'));
            $personaclick_order_cancelled = explode(',', $this->_config->getValue('personaclick/general/order_cancelled'));

            if ($personaclick_order_created && in_array($order_status_id, $personaclick_order_created)) {
                $status = 0;
            } elseif ($personaclick_order_completed && in_array($order_status_id, $personaclick_order_completed)) {
                $status = 1;
            } elseif ($personaclick_order_cancelled && in_array($order_status_id, $personaclick_order_cancelled)) {
                $status = 2;
            }

            if (isset($status)) {
                $order_data = array(
                    'id' => $order_id,
                    'status' => $status,
                );

                $this->_api->personaclickSyncOrders($order_data, $order_status_id);
            }
        }
    }
}
