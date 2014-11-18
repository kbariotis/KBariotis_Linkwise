<?php

class KBariotis_Linkwise_Block_Script extends Mage_Core_Block_Template
{
    public function isEnabled() {
        return Mage::getStoreConfig('linkwise/general/enabled');
    }
}