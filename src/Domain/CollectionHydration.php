<?php
/**
 * @package      Prism
 * @subpackage   Domain
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Prism\Library\Domain;

/**
 * Interface CollectionHydration
 * @package Prism\Library\Domain
 * @deprecated
 */
interface CollectionHydration
{
    /**
     * Hydrate data to the collection.
     *
     * @param array $data
     */
    public function hydrate(array $data): void;
}
