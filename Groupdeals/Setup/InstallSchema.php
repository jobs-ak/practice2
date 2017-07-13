<?php
/**
 */
namespace Magecian\Groupdeals\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     * install tables
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     *
     * @return void
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        $installer = $setup;
        $contextInstall = $context;
        $contextInstall->getVersion();
        $installer->startSetup();
        if (! $installer->tableExists('groupdeals_deal')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('groupdeals_deal')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                        'type' => 'unique',
                    ],
                    'ID'
                )
                ->addColumn(
                    'deal_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                     ['nullable' => false],
                    'Deal ID'
                )
                ->addColumn(
                    'product_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    ['type' => 'unique'],
                    'Product ID'
                )
                ->addColumn(
                    'product_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Product Name'
                )
                ->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'nullable' => false
                    ],
                    'Store ID'
                )
                ->addColumn(
                    'is_active',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => false,
                        'nullable' => false,
                        'primary'  => false,
                        'unsigned' => false,
                    ],
                    'Is Active'
                )
                ->addColumn(
                    'is_success',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => false,
                        'nullable' => false,
                        'primary'  => false,
                        'unsigned' => false,
                    ],
                    'Is Success'
                )
                ->addColumn(
                    'close_state',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => false,
                        'nullable' => false,
                        'primary'  => false,
                        'unsigned' => false,
                    ],
                    'Close State'
                )
                ->addColumn(
                    'qty_to_reach_deal',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [],
                    'Qty To Reach Deal'
                )
                ->addColumn(
                    'purchases_left',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    ['default' => 0 ],
                    'Purchases Left'
                )
                ->addColumn(
                    'maximum_allowed_purchases',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [],
                    'Maximum Allowed Purchases'
                )
                ->addColumn(
                    'available_from',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [
                          'nullable' => true,
                          'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                      ],
                    'Available From'
                )
                ->addColumn(
                    'available_to',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => true,
                        'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                    ],
                    'Available To'
                )
                ->addColumn(
                    'price',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [],
                    'Price'
                )
                ->addColumn(
                    'auto_close',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [],
                    'Auto Close'
                )
                ->addColumn(
                    'deal_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Deal Name'
                )
                ->addColumn(
                    'description',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Description'
                )
                ->addColumn(
                    'full_description',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [],
                    'full Description'
                )
                ->addColumn(
                    'deal_image',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '255',
                    [],
                    'Deal Image'
                )
                ->addColumn(
                    'is_featured',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [],
                    'Is Featured'
                )
                ->addColumn(
                    'enable_coupons',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [],
                    'Enable Coupons'
                )
                ->addColumn(
                    'coupon_prefix',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                        'unsigned' => true,
                    ],
                    'Coupon Prefix'
                )
                ->addColumn(
                    'coupon_expire_after_days',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [],
                    'Coupon Expire After Days'
                )
                ->addColumn(
                    'expired_flag',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [],
                    'Expired Flag'
                )
                ->addColumn(
                    'sent_before_flag',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [],
                    'Sent Before Flag'
                )
                ->addColumn(
                    'is_successed_flag',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [],
                    'Is Successed Flag'
                )
                ->addColumn(
                    'deal_created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Deal Created At'
                )
                ->addColumn(
                    'deal_updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Deal Updated At'
                )
                 ->addIndex(
                    $installer->getIdxName(
                        'groupdeals_deal',
                        [
                            'deal_id',
                            'product_id',
                            'store_id'
                        ],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    [
                        'deal_id',
                        'product_id',
                        'store_id'
                    ],
                    [
                        'type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ]
                )
                ->setComment('Deal Table');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('groupdeals_deal'),
                $setup->getIdxName(
                    $installer->getTable('groupdeals_deal'),
                    ['product_name','deal_name','description','full_description','deal_image','coupon_prefix','coupon_expire_after_days'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['product_name','deal_name','description','full_description','deal_image','coupon_prefix','coupon_expire_after_days'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }

         if (! $installer->tableExists('groupdeals_rewrite')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('groupdeals_rewrite')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                        'type' => 'unique',
                    ],
                    'ID'
                )
                ->addColumn(
                    'deal_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                     [
                      'nullable' => false
                     ],
                    'Deal ID'
                )
                ->addColumn(
                    'store_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'nullable' => false
                    ],
                    'Store ID'
                )
               ->addColumn(
                    'identifier',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Identifier'
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'groupdeals_deal',
                        'deal_id',
                        'groupdeals_rewrite',
                        'deal_id'
                    ),
                    'deal_id',
                    $installer->getTable('groupdeals_deal'),
                    'deal_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment('Deal Rewite');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('groupdeals_rewrite'),
                $setup->getIdxName(
                    $installer->getTable('groupdeals_rewrite'),
                    ['identifier'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['identifier'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
   
         if (! $installer->tableExists('groupdeals_dealpurchases')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('groupdeals_dealpurchases')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                        'type' => 'unique',
                    ],
                    'ID'
                )
                ->addColumn(
                    'deal_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                     ['nullable' => false],
                    'Deal ID'
                )
                ->addColumn(
                    'order_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                     ['nullable' => false],
                    'Order ID'
                )
                ->addColumn(
                    'increment_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    10,
                     ['nullable' => false],
                    'Increment ID'
                )
                ->addColumn(
                    'order_item_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    ['nullable' => false],
                    'Order Item ID'
                )
                ->addColumn(
                    'qty_purchased',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    ['nullable' => false],
                    'Qty Purchased'
                )
                ->addColumn(
                    'qty_with_coupons',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    ['nullable' => false],
                    'Qty With Coupons'
                )
               ->addColumn(
                    'customer_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Customer Name'
                )
               ->addColumn(
                    'customer_email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Customer Email'
                )
                 ->addColumn(
                    'customer_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    ['nullable' => false],
                    'Customer Id'
                )
               ->addColumn(
                    'purchase_date_time',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Purchase Date Time'
                )
               ->addColumn(
                    'shipping_amount',
                    \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    12,
                    [
                      'nullable' => false,
                      'default'=> 0.00,
                    ],
                    'Shipping Amount'
                )
               ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    12,
                    [
                      'nullable' => false,
                    ],
                    'Order Status'
                )
                ->addColumn(
                    'subtotal_incl_tax',
                    \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    12,
                    [
                      'nullable' => false,
                      'default'=>  0,
                    ],
                    'subtotal_incl_tax'
                    )
               ->addColumn(
                    'refund_state',
                    \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    12,
                    [
                      'nullable' => false,
                      'unsigned' => true,
                      'default'=>  0,
                    ],
                    'Refund State'
                )
               ->addColumn(
                    'Is_successed_flag',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    4,
                    [
                      'nullable' => false,
                      'unsigned' => true,
                      'default'=>  0,
                    ],
                    'Is Successed_flag'
                )
               /* ->addIndex(
                    $installer->getIdxName('groupdeals_rewrite', ['deal_id']),
                    ['deal_id']
                )
                
                ->addForeignKey(
                    $installer->getFkName(
                        'groupdeals_dealpurchases',
                        'deal_id',
                        'groupdeals_deal',
                        'deal_id'
                    ),
                    'deal_id',
                    $installer->getTable('groupdeals_dealpurchases'),
                    'deal_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addIndex(
                    $installer->getIdxName(
                        'groupdeals_dealpurchases',
                        [
                            'deal_id'
                        ],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    [
                        'deal_id'

                    ],
                    [
                        'type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ]
                )*/
                ->setComment('Deal Purchases');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('groupdeals_dealpurchases'),
                $setup->getIdxName(
                    $installer->getTable('groupdeals_dealpurchases'),
                    ['customer_name'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['customer_name'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
         if (! $installer->tableExists('groupdeals_coupon')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('groupdeals_coupon')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                        'type' => 'unique',
                    ],
                    'ID'
                )
                ->addColumn(
                    'deal_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                     ['nullable' => false],
                    'Deal ID'
                )
                ->addColumn(
                    'purchase_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    10,
                    ['nullable' => false],
                    'Store ID'
                )
               ->addColumn(
                    'coupon_code',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Coupon Code'
                )
               ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    10,
                    ['nullable' => false],
                    'status'
                )
               ->addColumn(
                    'coupon_delivery_datetime',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Coupon Delivery Datetime'
                )
                ->addColumn(
                    'coupon_date_updated',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Coupon Date Updated'
                )
                ->addIndex(
                    $installer->getIdxName('groupdeals_coupon', ['deal_id']),
                    ['deal_id']
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'groupdeals_coupon',
                        'deal_id',
                        'groupdeals_deal',
                        'deal_id'
                    ),
                    'deal_id',
                    $installer->getTable('groupdeals_deal'),
                    'deal_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->addIndex(
                    $installer->getIdxName(
                        'groupdeals_coupon',
                        [
                            'deal_id'
                            
                        ],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    [
                        'deal_id'
                    ],
                    [
                        'type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ]
                )
                ->setComment('Deal Coupon');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('groupdeals_coupon'),
                $setup->getIdxName(
                    $installer->getTable('groupdeals_coupon'),
                    ['coupon_code','status'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['coupon_code','status'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
         

      $installer->endSetup();
    }
}
