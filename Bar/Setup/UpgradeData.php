<?php

namespace Foo\Bar\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeData implements UpgradeDataInterface
{
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $tableName = $setup->getTable('foo_bar');
            if ($setup->getConnection()->isTableExists($tableName) == true) {
                $data = [
                    [
                        'title' => 'Fist News',
                        'body' => 'This is the long first news about some abstract data',
                        'image_url' => 'http://image.url.com',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                    [
                        'title' => 'Second News',
                        'body' => 'Another article  about some dummy basic ddkasdqd ihwq nwdn le edb wek dfew abstract data',
                        'image_url' => 'http://image.url.com',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],[
                        'title' => 'Third News',
                        'body' => 'lorem ipsum dolor sit amet jhdg kldhqwd fehf ewouhb ughdblew olio hoew b,bd sjd gire orgt ',
                        'image_url' => 'http://image.url.com',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],

                ];

                foreach ($data as $item) {
                    $setup->getConnection()->insert($tableName, $item);
                }
            }
        }

        $setup->endSetup();
    }
}

 