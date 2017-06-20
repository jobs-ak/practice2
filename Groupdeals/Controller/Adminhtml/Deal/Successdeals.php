<?php

namespace Magecian\Groupdeals\Controller\Adminhtml\Deal;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Successdeals extends \Magento\Backend\App\Action
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
          $resultPage->setActiveMenu('Magecian_Groupdeals::successdeals');
          $resultPage->addBreadcrumb(__('Success Deal'), __('Success Deals'));
          $resultPage->getConfig()->getTitle()->prepend(__('Success Deals'));
          return $resultPage;
      }
}

?>
