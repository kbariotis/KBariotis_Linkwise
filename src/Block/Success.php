<?php

/**
 * @package    KBariotis_Linkwise
 * @author     Kostas Bariotis
 * @copyright  Copyright (c) 2014 Kostas Bariotis (http://www.kostasbariotis.com)
 * @licence  https://github.com/stakisko/KBariotis_Linkwise/blob/master/LICENCE MIT
 */

class KBariotis_Linkwise_Block_Success extends Mage_Core_Block_Template
{

    public function getLinkwiseId() {
        return Mage::getStoreConfig('linkwise/general/linkwise_id');
    }

    public function isEnabled() {;
        return Mage::getStoreConfig('linkwise/general/enabled');
    }

    public function getTotal() {
        if(Mage::getStoreConfig('linkwise/general/products_has_tax'))
            return $this->getLastOrderTotalWithoutVat();
        else
            return $this->getLastOrderTotal();
    }

    public function getLastOrderTotalWithoutVat()
    {
        $orderId = Mage::getSingleton('checkout/session')
                        ->getLastOrderId();
        $order   = Mage::getModel('sales/order')
                        ->load($orderId);
        $items    = $order->getAllItems();
        $total    = 0;
        foreach ($items as $product) {
            $price = $product->getSpecialPrice() ?
                $product->getSpecialPrice() :
                $product->getPrice();

            /* excluding vat */
            $total += ($price / 1.23) * $product->getData('qty_ordered');
        }

        return number_format($total, 2, '.', ',');
    }

    public function getLastOrderTotal()
    {
        $orderId = Mage::getSingleton('checkout/session')
                        ->getLastOrderId();
        $order   = Mage::getModel('sales/order')
                        ->load($orderId);

        return $order->getGrandTotal() - $order->getShippingAmount() - $order->getTaxAmount();
    }

    public function getLastOrderId()
    {
        return Mage::getSingleton('checkout/session')
                   ->getLastOrderId();
    }

    public function getLastOrderIncrementId()
    {
        $orderId = Mage::getSingleton('checkout/session')
                        ->getLastOrderId();
        $order   = Mage::getModel('sales/order')
                        ->load($orderId);

        return $order->getIncrementId();
    }
}