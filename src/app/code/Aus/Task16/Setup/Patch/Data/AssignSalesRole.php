<?php
declare(strict_types=1);

namespace Aus\Task16\Setup\Patch\Data;

use Magento\Authorization\Model\Acl\Role\Group as RoleGroup;
use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AssignSalesRole implements DataPatchInterface
{

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * Factory for user role model
     *
     * @var \Magento\Authorization\Model\RoleFactory
     */
    protected $_roleFactory;

    /**
     * Rules model factory
     *
     * @var \Magento\Authorization\Model\RulesFactory
     */
    protected $_rulesFactory;

    /**
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Authorization\Model\RoleFactory $roleFactory
     * @param \Magento\Authorization\Model\RulesFactory $rulesFactory
     */
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Authorization\Model\RoleFactory $roleFactory,
        \Magento\Authorization\Model\RulesFactory $rulesFactory,
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->_roleFactory = $roleFactory;
        $this->_rulesFactory = $rulesFactory;
    }

    /**
     * @return void
     */
    public function apply()
    {
        $resource = ["Magento_Sales::sales", "Magento_Sales::sales_operation", "Magento_Sales::sales_order",
            "Magento_Sales::actions", "Magento_Sales::create", "Magento_Sales::actions_view", "Magento_Sales::email",
            "Magento_Sales::reorder", "Magento_Sales::actions_edit", "Magento_Sales::cancel",
            "Magento_Sales::review_payment", "Magento_Sales::capture", "Magento_Sales::invoice",
            "Magento_Sales::creditmemo", "Magento_Sales::hold", "Magento_Sales::unhold", "Magento_Sales::ship",
            "Magento_Sales::comment", "Magento_Sales::emails", "Magento_Paypal::authorization",
            "Magento_Sales::sales_invoice", "Magento_Sales::shipment", "Magento_Sales::sales_creditmemo",
            "Magento_Paypal::billing_agreement", "Magento_Paypal::billing_agreement_actions",
            "Magento_Paypal::billing_agreement_actions_view", "Magento_Paypal::actions_manage",
            "Magento_Paypal::use", "Magento_Sales::transactions", "Magento_Sales::transactions_fetch"];
        $role = $this->initRole();
        $role->setName('task16')
            ->setPid(false)
            ->setRoleType(RoleGroup::ROLE_TYPE)
            ->setUserType(UserContextInterface::USER_TYPE_ADMIN);
        $role->save();
        $this->_rulesFactory->create()->setRoleId($role->getId())->setResources($resource)->saveRel();

    }

    public function initRole(){
        $role = $this->_roleFactory->create();
        $this->_coreRegistry->register('current_role', $role);
        return $this->_coreRegistry->registry('current_role');
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
