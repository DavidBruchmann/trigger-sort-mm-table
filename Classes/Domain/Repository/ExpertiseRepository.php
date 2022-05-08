<?php

declare(strict_types=1);

namespace WDB\Btp\Domain\Repository;


/**
 * This file is part of the "bidirectional m:n relation sorting" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 David Bruchmann <david.bruchmann@gmail.com>, Webdevelopment Barlian
 */

/**
 * The repository for Expertises
 */
class ExpertiseRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
}
