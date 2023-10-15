<?php
/**
 * Copyright &copy; LotsofPixels.io, Inc. All rights reserved.
 */

declare(strict_types=1);

namespace LotsofPixels\CategoryBottomText\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\Category;

/**
 *
 */
class bottomdesciptionAttribute implements DataPatchInterface {

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory          $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Validator\ValidateException
     */
    public function apply() {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(Category::ENTITY, 'bottom_description', [
            'type' => 'text',
            'label' => 'Description',
            'input' => 'textarea',
            'required' => false,
            'sort_order' => 4,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'wysiwyg_enabled' => true,
            'is_html_allowed_on_front' => true,
            'group' => 'General Information',
        ]);
    }

    /**
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return void
     */
    public function revert()
    {
    }

    /**
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }
}
