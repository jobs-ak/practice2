<?php
namespace Magecian\Groupdeals\Block\Adminhtml\Deal\Edit\Tab;

class Details extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{

  public function __construct(
       \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
       \Magento\Config\Model\Config\Source\Yesno $booleanOptions,
       \Magento\Store\Model\System\Store $systemStore,
       \Magento\Backend\Block\Template\Context $context,
       \Magento\Framework\Registry $registry,
   \Magento\Backend\Model\Auth\Session $authSession,
       \Magento\Framework\Data\FormFactory $formFactory,
       array $data = []
   ) {

       $this->wysiwygConfig     = $wysiwygConfig;
       $this->booleanOptions    = $booleanOptions;
       $this->systemStore = $systemStore;
       $this->authSession = $authSession;
       parent::__construct($context, $registry, $formFactory, $data);
   }

  protected function _prepareForm()
  {
     
      //$deal = $this->_coreRegistry->registry('magecian_groupdeals_deal');
      $form   = $this->_formFactory->create();
      //$form->setHtmlIdPrefix('deal_');
      //$form->setFieldNameSuffix('deal');
      $fieldset = $form->addFieldset(
          'base_fieldset',
          [
              'legend'=>__('Details'),
              'class' => 'fieldset-wide'
          ]
      );
      $fieldset->addField(
            'deal_name',
            'text',
            [
                'name' => 'deal_name',
                'label' => __('Name'),
                'title' => __('Name'),
                'required' => true,
            ]
        );
        $fieldset->addField(
              'description',
              'text',
              [
                  'name' => 'description',
                  'label' => __('short_description'),
                  'title' => __('short_description'),
                  'required' => true,
              ]
          );
          $fieldset->addField(
            'deal_image',
            'image',
            [
                'name'  => 'deal_image',
                'label' => __('Image'),
                'title' => __('Image'),
            ]
        );
        $fieldset->addField(
            'full_description',
            'editor',
            [
                'name'  => 'full_description',
                'label' => __('Description'),
                'title' => __('Description'),
                'note' => __('Description'),
                'config'    => $this->wysiwygConfig->getConfig()
            ]
        );

      
     // $form->addValues($deal->getData());
      $this->setForm($form);
      return parent::_prepareForm();
  }

  /**
   * Prepare label for tab
   *
   * @return string
   */
  public function getTabLabel()
  {
      return __('Details');
  }

  /**
   * Prepare title for tab
   *
   * @return string
   */
  public function getTabTitle()
  {
      return $this->getTabLabel();
  }

  /**
   * Can show tab in tabs
   *
   * @return boolean
   */
  public function canShowTab()
  {
      return true;
  }

  /**
   * Tab is hidden
   *
   * @return boolean
   */
  public function isHidden()
  {
      return false;
  }

}
