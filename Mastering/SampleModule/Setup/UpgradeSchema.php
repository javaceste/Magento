<?php

namespace Mastering\SampleModule\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Psr\Log\LoggerInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    protected $logger;

	public function __construct(LoggerInterface $logger){
       $this->logger = $logger; 
    }
	
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
		$this->logger->info('[Mastering_SampleModule] [UpdateSchema] - Is Running', [ 'CurrentVersion' => $context->getVersion()]);
		
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('mastering_sample_item'),
                'description',
                [
                    'type' => Table::TYPE_TEXT,
                    'nullable' => true,
                    'comment' => 'Item Description'
                ]
            );
        }
		
		if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('sales_order_grid'),
                'base_tax_amount',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'comment' => 'Base Tax Amount'
                ]
            );
        }

        $setup->endSetup();
    }
}