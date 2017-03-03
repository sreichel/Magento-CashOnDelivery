<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category   Phoenix
 * @package    Phoenix_CashOnDelivery
 * @copyright  Copyright (c) 2010 - 2013 PHOENIX MEDIA GmbH (http://www.phoenix-media.eu)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * delete database changes made by PHOENIX MEDIA - Cash On Delivery
 */
require 'app/Mage.php';
Mage::app('admin');

$setup = Mage::getModel('eav/entity_setup', 'core_setup');
$setup->startSetup();

$setup->removeAttribute('order', 'cod_fee');
$setup->removeAttribute('order', 'base_cod_fee');
$setup->removeAttribute('order', 'cod_tax_amount');
$setup->removeAttribute('order', 'base_cod_tax_amount');

$setup->removeAttribute('order', 'cod_fee_invoiced');
$setup->removeAttribute('order', 'base_cod_fee_invoiced');
$setup->removeAttribute('order', 'cod_tax_amount_invoiced');
$setup->removeAttribute('order', 'base_cod_tax_amount_invoiced');

$setup->removeAttribute('order', 'cod_fee_refunded');
$setup->removeAttribute('order', 'base_cod_fee_refunded');
$setup->removeAttribute('order', 'cod_tax_amount_refunded');
$setup->removeAttribute('order', 'base_cod_tax_amount_refunded');

$setup->removeAttribute('order', 'cod_fee_canceled');
$setup->removeAttribute('order', 'base_cod_fee_canceled');
$setup->removeAttribute('order', 'cod_tax_amount_canceled');
$setup->removeAttribute('order', 'base_cod_tax_amount_canceled');

$setup->removeAttribute('creditmemo', 'cod_fee');
$setup->removeAttribute('creditmemo', 'base_cod_fee');
$setup->removeAttribute('creditmemo', 'cod_tax_amount');
$setup->removeAttribute('creditmemo', 'base_cod_tax_amount');

$setup->removeAttribute('invoice', 'cod_fee');
$setup->removeAttribute('invoice', 'base_cod_fee');
$setup->removeAttribute('invoice', 'cod_tax_amount');
$setup->removeAttribute('invoice', 'base_cod_tax_amount');

$setup->removeAttribute('quote', 'cod_fee');
$setup->removeAttribute('quote', 'base_cod_fee');
$setup->removeAttribute('quote', 'cod_tax_amount');
$setup->removeAttribute('quote', 'base_cod_tax_amount');

$setup->removeAttribute('quote_address', 'cod_fee');
$setup->removeAttribute('quote_address', 'base_cod_fee');
$setup->removeAttribute('quote_address', 'cod_tax_amount');
$setup->removeAttribute('quote_address', 'base_cod_tax_amount');

$setup->getConnection()->dropColumn($setup->getTable('sales/flat_quote'), 'cod_fee');
$setup->getConnection()->dropColumn($setup->getTable('sales/flat_quote'), 'base_cod_fee');
$setup->getConnection()->dropColumn($setup->getTable('sales/flat_quote'), 'cod_tax_amount');
$setup->getConnection()->dropColumn($setup->getTable('sales/flat_quote'), 'base_cod_tax_amount');

$setup->getConnection()->dropColumn($setup->getTable('sales/flat_quote_address'), 'cod_fee');
$setup->getConnection()->dropColumn($setup->getTable('sales/flat_quote_address'), 'base_cod_fee');
$setup->getConnection()->dropColumn($setup->getTable('sales/flat_quote_address'), 'cod_tax_amount');
$setup->getConnection()->dropColumn($setup->getTable('sales/flat_quote_address'), 'base_cod_tax_amount');

$setup->run("
    DELETE FROM {$setup->getTable('core_config_data')} WHERE path = 'sales/totals_sort/phoenix_cashondelivery';
    DELETE FROM {$setup->getTable('core_config_data')} WHERE path LIKE 'payment/phoenix_cashondelivery/%';
    DELETE FROM {$setup->getTable('core_config_data')} WHERE path = 'tax/classes/phoenix_cashondelivery_tax_class';
    DELETE FROM {$setup->getTable('core_config_data')} WHERE path = 'tax/calculation/phoenix_cashondelivery_includes_tax';
    DELETE FROM {$setup->getTable('core_config_data')} WHERE path = 'tax/display/phoenix_cashondelivery_fee';
    DELETE FROM {$setup->getTable('core_resource')} WHERE code = 'cashondelivery_setup';
");

$setup->endSetup();