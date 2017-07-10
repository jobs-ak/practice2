<?php 

namespace Magecian\Groupdeals\Observer;

use Magento\Framework\Event\ObserverInterface;

class AfterPlaceDeal implements ObserverInterface
{
    /**
     * Order Model
     *
     * @var \Magento\Sales\Model\Order $order
     */
    protected $order;

    protected $orderCollectionFactory;

     public function __construct(
        \Magento\Sales\Model\Order $order,
        \Magecian\Groupdeals\Helper\Data $dataHelper,
        \Magecian\Groupdeals\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magecian\Groupdeals\Model\ResourceModel\Deal\CollectionFactory $dealCollectionFactory,
        \Magento\Checkout\Model\Cart $cartModel
    )
    {
         $this->order = $order;
         $this->dataHelper = $dataHelper;
         $this->_orderCollectionFactory = $orderCollectionFactory;
         $this->_dealCollectionFactory = $dealCollectionFactory;
         $this->_cartModel = $cartModel;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {  
       $orderId = $observer->getEvent()->getOrderIds();
       $order = $this->order->load($orderId);
       //print_r($order->getData());die;
       $quote = $this->_cartModel->getQuote()->load($order->getQuoteId());
       $cartAllItems = $quote->getAllItems(); 
       foreach ($cartAllItems as $items) {
       $ProOrder = $items->getProductId();
       $ProQty   = $items->getQty();
       $checkdeal = $this->dataHelper->getDealstatus($ProOrder);
       if($checkdeal == 1):
       $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
       $dealorder = $objectManager->create('Magecian\Groupdeals\Model\Order');
       //print_r($orderId[0]);die;
       $dealorder->setData('deal_id',$ProOrder);
       $dealorder->setData('order_id',$order->getIncrementId());
       $dealorder->setData('order_item_id',$ProOrder);
       $dealorder->setData('qty_purchased',$ProQty);
       $dealorder->setData('shipping_amount',$order->getShippingAmount());
       $dealorder->setData('purchase_date_time',$order->getCreatedAt());
       $dealorder->setData('subtotal_incl_tax',$order->getSubtotalInclTax());
       $dealorder->setData('customer_email',$order->getCustomerEmail());
       $dealorder->setData('status',$order->getStatus());
       $dealorder->save();
       $this->dataHelper->getUpdateDealQty($ProOrder,$ProQty);
       endif;
       }
    }
}
