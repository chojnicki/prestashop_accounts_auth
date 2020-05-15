<?php
/**
 * 2007-2020 PrestaShop and Contributors.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShop\AccountsAuth\Presenter\Store;

use PrestaShop\AccountsAuth\Presenter\PresenterInterface;
use PrestaShop\AccountsAuth\Presenter\Store\Modules\FirebaseModule;
use PrestaShop\Module\PsAccounts\Presenter\PsAccountsModule;

/**
 * Present the store to the vuejs app.
 */
class StorePresenter implements PresenterInterface
{
    /**
     * @var \ContextCore
     */
    private $context;

    /**
     * @var \Module
     */
    private $module;

    /**
     * @var array
     */
    private $store;

    public function __construct(\Module $module, \ContextCore $context, array $store = null)
    {
        // Allow to set a custom store for tests purpose
        if (null !== $store) {
            $this->store = $store;
        }

        $this->module = $module;
        $this->context = $context;
    }

    /**
     * Build the store required by vue.
     *
     * @return array
     */
    public function present()
    {
        $this->store = array_merge(
            (new PsAccountsModule($this->module, $this->context))->present(),
            (new FirebaseModule())->present()
        );

        return $this->store;
    }
}
