<?php
namespace Magecian\Groupdeals\Block\Adminhtml\Deal\Edit\Tab;

class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $store;

    /**
    * @var \Webspeaks\ProductsGrid\Helper\Data $helper
    */
    protected $helper;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    protected $_productloader;  


    public function __construct(
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Config\Model\Config\Source\Yesno $booleanOptions,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
		\Magento\Backend\Model\Auth\Session $authSession,
		\Magecian\Groupdeals\Helper\Data $helper,
        \Magento\Framework\Data\FormFactory $formFactory,
         \Magento\Catalog\Model\ProductFactory $_productloader,
        array $data = []
    ) {
        $this->helper = $helper;
        $this->wysiwygConfig     = $wysiwygConfig;
        $this->booleanOptions    = $booleanOptions;
        $this->systemStore = $systemStore;
		$this->authSession = $authSession;
        $this->_productloader = $_productloader;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('magecian_groupdeals');
        
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('deal_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Deal Information')]);
        
        if ($model) {
            $fieldset->addField('deal_id', 'hidden', ['name' => 'deal_id','value' => $model->getDealId()]);
            $fieldset->addField('product_id', 'hidden', ['name' => 'product_id','value' => $model->getProductId()]);
          //$fieldset->addField('product_name', 'hidden', ['name' => 'product_name','value' => $model->getProductName()]);

        }

        $fieldset->addField(
            'product_name',
            'text',
            [
                'name' => 'product_name',
                'label' => __('Product Name'),
                'title' => __('Product Name'),
                'required' => true,
                'value' =>__($model->getProductName()),
                'readonly' => true,
            ]
        );
        $fieldset->addField(
            'store_ids',
            'multiselect',
            [
                'name'  => 'store_ids',
                'label' => __('Store Views'),
                'title' => __('Store Views'),
                'note' => __('Select Store Views'),
                'values' => $this->systemStore->getStoreValuesForForm(false, true),
            ]
        );
        $fieldset->addField(
            'is_active',
            'select',
            [
                'name'  => 'is_active',
                'label' => __('Is active'),
                'title' => __('Is active'),
                'values' => $this->booleanOptions->toOptionArray(),
            ]
        );
        $fieldset->addField(
            'is_featured',
            'select',
            [
                'name'  => 'is_featured',
                'label' => __('Is Featured'),
                'title' => __('Is Featured'),
                'values' => $this->booleanOptions->toOptionArray(),
            ]
        );
        $fieldset->addField(
            'qty_to_reach_deal',
            'text',
            [
                'name' => 'qty_to_reach_deal',
                'label' => __('Qty to reach deal'),
                'title' => __('Qty to reach deal'),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'maximum_allowed_purchases',
            'text',
            [
                'name' => 'maximum_allowed_purchases',
                'label' => __('Maximum allowed purchases'),
                'title' => __('Maximum allowed purchases'),
                'required' => true,
                'note'     => __('Leave empty for unlimited'),
            ]
        );
        $fieldset->addField(
		    'available_from',
		    'date',
		    [
		        'name' => 'available_from', 
		        'label' => __('Available From'), 
		        'title' => __('Available From'),
		        'date_format' => $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT),
		        //'time_format' => $this->_localeDate->getTimeFormat(\IntlDateFormatter::SHORT),
		        'class' => 'validate-date', 
		        'required' => true
		    ]
		);
		 $fieldset->addField(
		    'available_to',
		    'date',
		    [
		        'name' => 'available_to', 
		        'label' => __('Available TO'), 
		        'title' => __('Available TO'),
		        'date_format' => $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT),
		        //'time_format' => $this->_localeDate->getTimeFormat(\IntlDateFormatter::SHORT),
		        'class' => 'validate-date', 
		        'required' => true
		    ]
		);
		 $fieldset->addField(
            'price',
            'text',
            [
                'name' => 'price',
                'label' => __('Deal price'),
                'title' => __('Deal price'),
                'required' => true,
            ]
        );
		 $fieldset->addField(
            'auto_close',
            'select',
            [
                'name'  => 'auto_close',
                'label' => __('Auto close deal on success'),
                'title' => __('Auto close deal on success'),
                'values' => $this->booleanOptions->toOptionArray(),
            ]
        );
		 $fieldset->addField(
            'url_key',
            'text',
            [
                'name' => 'url_key',
                'label' => __('Url key'),
                'title' => __('Url key'),
                'required' => true,
                'note'     => __('Leave empty to use the URL of the related product. Note, only Latin symbols, numbers, hyphens and underscores are allowed in the url key'),
            ]
        );


      //  $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    public function getLoadProduct($id)
    {
        return $this->_productloader->create()->load($id);
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('General Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('General Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
