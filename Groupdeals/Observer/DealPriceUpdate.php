<?php
    /**

     */
    namespace Magecian\Groupdeals\Observer;
 
    use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\App\RequestInterface;
    use Magento\Checkout\Model\Session;
 
    class DealPriceUpdate implements ObserverInterface
    {
        
     public function __construct(\Magecian\Groupdeals\Helper\Data $dataHelper,
        \Magecian\Groupdeals\Model\ResourceModel\Deal\CollectionFactory $dealCollectionFactory,
        \Magento\Catalog\Model\ProductFactory $_productloader,
        \Magento\Framework\Message\ManagerInterface $messageManager,
         Session $session)
       {
          $this->dataHelper = $dataHelper;
          $this->_productloader = $_productloader;
          $this->_dealCollectionFactory = $dealCollectionFactory;
          $this->messageManager = $messageManager;
          $this->_session = $session;
       }

        public function execute(\Magento\Framework\Event\Observer $observer) {
            
            $item = $observer->getEvent()->getData('quote_item');         
            $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
            $dealPrice = $this->dataHelper->getDealProductId($item->getProductId());
            $product = $this->_productloader->create()->load($item->getProductId());
            if($dealPrice > 0){
            $price = $dealPrice;
            }else{$price = $product->getPrice();}
            $item->setCustomPrice($price);
            $item->setOriginalCustomPrice($price);
            $item->getProduct()->setIsSuperMode(true);
            }
} 