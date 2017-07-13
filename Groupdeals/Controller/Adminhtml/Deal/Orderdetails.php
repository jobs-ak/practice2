<?php

namespace  Magecian\Groupdeals\Controller\Adminhtml\Deal;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Orderdetails extends \Magento\Backend\App\Action
{

     protected $resultPageFactory;

      public function __construct(
          Context $context,
          PageFactory $resultPageFactory
      ) {
          parent::__construct($context);
          $this->resultPageFactory = $resultPageFactory;
      }


      public function execute()
      {
          /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
          $resultPage = $this->resultPageFactory->create();
          $resultPage->setActiveMenu('Magecian_Groupdeals::Orderdetails');
          $resultPage->addBreadcrumb(__('Deal Order'), __('Deal Order'));
          $resultPage->getConfig()->getTitle()->prepend(__('Deals Order'));
          return $resultPage;
      }
}
