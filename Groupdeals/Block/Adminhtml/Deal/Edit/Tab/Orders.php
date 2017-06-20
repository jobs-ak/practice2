<?php

namespace Magecian\Groupdeals\Block\Adminhtml\Deal\Edit\Tab;

use Magecian\Groupdeals\Model\DealFactory;

class Orders extends \Magento\Backend\Block\Widget\Grid\Extended
{
    
    
    protected $orderCollectionFactory;

   
    protected $dealFactory;

    
    protected $registry;

    protected $_objectManager = null;

    
   
    protected function _construct()
    {
        parent::_construct();
        $this->setId('ordersGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
        
    }

    /**
     * add Column Filter To Collection
     
    protected function _addColumnFilterToCollection($column)
    {
        if ($column->getId() == 'in_order') {
            $orderIds = $this->_getSelectedOrders();

            if (empty($orderIds)) {
                $orderIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', array('in' => $orderIds));
            } else {
                if ($orderIds) {
                    $this->getCollection()->addFieldToFilter('entity_id', array('nin' => $orderIds));
                }
            }
        } else {
            parent::_addColumnFilterToCollection($column);
        }

        return $this;
    }*/

    /**
     * prepare collection
     */
    protected function _prepareCollection()
    {
         $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
         $orderDatamodel = $objectManager->get('Magento\Sales\Model\Order')->getCollection();
     
         $this->setCollection($orderDatamodel);
         return parent::_prepareCollection();
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
      
        //$model = $this->_objectManager->get('\Magecian\Groupdeals\Model\Deal');

        $this->addColumn(
            'entity_id',
            [
                'header' => __('IDs'),
                'type' => 'number',
                'index' => 'entity_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );
         $this->addColumn(
            'created_at',
            [
                'header' => __('Purchase Date'),
                'type' => 'date',
                'index' => 'created_at',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );

        $this->addColumn(
            'billing_name',
            [
                'header' => __('Bill-to Name'),
                'index' => 'billing_name',
                'class' => 'xxx',
                'width' => '50px',
            ]
        );
        $this->addColumn(
            'shipping_name',
            [
                'header' => __('Ship-to Name'),
                'index' => 'shipping_name',
                'class' => 'xxx',
                'width' => '50px',
            ]
        );
        $this->addColumn(
            'base_grand_total',
            [
                'header' => __('Grand Total (Base)'),
                'type' => 'currency',
                'index' => 'base_grand_total',
                'width' => '50px',
            ]
        );
        $this->addColumn(
            'grand_total',
            [
                'header' => __('Grand Total (Purchased)'),
                'type' => 'currency',
                'index' => 'grand_total',
                'width' => '50px',
            ]
        );
        $this->addColumn(
            'status',
            [
                'header' => __('Grand Total (Purchased)'),
                'type' => 'select',
                'index' => 'status',
                'width' => '50px',
            ]
        );

       $this->addColumn(
        'action',
              [
                    'header'    => __('Action'),
                    'width'     => '50px',
                    'type'      => 'action',
                    'getter'     => 'getId',
                    'actions'   => [
                        [
                            'caption' => _('View'),
                            'url'     => ['base'=>'adminhtml/sales_order/view'],
                            'field'   => 'order_id'
                        ]
                    ],
                    'filter'    => false,
                    'sortable'  => false,
                    'index'     => 'stores',
                    'is_system' => true,
            ]
            );
        return parent::_prepareColumns();
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/ordersgrid', ['_current' => true]);
    }

    /**
     * @param  object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return '';
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
        return true;
    }
}
