<?php

namespace Magecian\Groupdeals\Controller\Adminhtml\Deal;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Newdeal extends \Magento\Backend\App\Action
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
          $resultPage->setActiveMenu('Magecian_Groupdeals::newdeal');
          $resultPage->addBreadcrumb(__('New Deal'), __('New Deal'));
          $resultPage->getConfig()->getTitle()->prepend(__('Select Product For New Deal'));
          return $resultPage;
      }
}

?>
