<?php

namespace Mastering\SampleModule\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
//use Psr\Log\LoggerInterface;

class InstallSchema implements InstallSchemaInterface
{
//    protected $logger;
//	
//	public function __construct(LoggerInterface $logger){
//       $this->logger = $logger; 
//    }
	
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
//		$this->logger->info("Testing install"); var/log/system.log
        $setup->startSetup();
		if (!$setup->tableExists('mastering_sample_item')) {
			$table = $setup->getConnection()->newTable(
				$setup->getTable('mastering_sample_item')
			)->addColumn(
				'id',
				Table::TYPE_INTEGER,
				null,
				[
					'identity' => true, 
					'nullable' => false, 
					'primary' => true
				],
				'Item ID'
			)->addColumn(
				'name',
				Table::TYPE_TEXT,
				255,
				['nullable' => false],
				'Item Name'
			)->addIndex(
				$setup->getIdxName('mastering_sample_item', ['name']),
				['name']
			)->setComment(
				'Sample Items'
			);
			$setup->getConnection()->createTable($table);
			
//			$setup->getConnection()->addIndex(
//                $setup->getTable('mastering_sample_item'),
//                $setup->getIdxName(
//                    $setup->getTable('mastering_sample_item'),
//                    ['name'],
//                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
//                ),
//                ['name'],
//                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
//          );
		}
        $setup->endSetup();
    }
}
