<?php

class Esmart_PayPalBrasil_Block_Adminhtml_Sales_Creditmemo_Totals extends Mage_Sales_Block_Order_Creditmemo_Totals {

    protected function _initTotals() {
        parent::_initTotals();

        $order = $this->getSource();

        if($order->getEsmartPaypalbrasilCostAmount() == 0){
            return $this;
        }


        if(Mage::getModel('esmart_paypalbrasil/installments')->getStatusInstallments() == true) {
            $this->addTotalBefore(new Varien_Object(array(
                'code'      => 'paypal_plus',
                'value'     => $order->getEsmartPaypalbrasilCostAmount(),
                'base_value'=> $order->getEsmartPaypalbrasilCostAmount(),
                'label'     => $this->helper('sales')->__(Mage::getModel('esmart_paypalbrasil/installments_config')->getCustomizeText()),
            ), array('grand_total', 'tax')));
        }

        return $this;
    }
}