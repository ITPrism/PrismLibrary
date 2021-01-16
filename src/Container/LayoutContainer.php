<?php
/**
 * @package      Prism
 * @subpackage   Container
 * @author       FunFex <opensource@funfex.com>
 * @copyright    Copyright (C) 2020 FunFex LTD. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */
namespace Prism\Library\Prism\Container;

/**
 * This class transfers data between layouts.
 *
 * @package      Prism
 * @subpackage   Container
 */
final class LayoutContainer
{
    private array $items = [];

    public function set(string $key, $value)
    {
        $this->items[$key] = $value;

        return $this;
    }

    public function get(string $key, $default = null)
    {
        return $this->items[$key] ?? $default;
    }
}