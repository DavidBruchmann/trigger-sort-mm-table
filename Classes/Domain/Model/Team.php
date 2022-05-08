<?php

declare(strict_types=1);

namespace WDB\Btp\Domain\Model;


/**
 * This file is part of the "bidirectional m:n relation sorting" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 David Bruchmann <david.bruchmann@gmail.com>, Webdevelopment Barlian
 */

/**
 * Team
 */
class Team extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * expertise
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WDB\Btp\Domain\Model\Expertise>
     */
    protected $expertise = null;

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->expertise = $this->expertise ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Adds a Expertise
     *
     * @param \WDB\Btp\Domain\Model\Expertise $expertise
     * @return void
     */
    public function addExpertise(\WDB\Btp\Domain\Model\Expertise $expertise)
    {
        $this->expertise->attach($expertise);
    }

    /**
     * Removes a Expertise
     *
     * @param \WDB\Btp\Domain\Model\Expertise $expertiseToRemove The Expertise to be removed
     * @return void
     */
    public function removeExpertise(\WDB\Btp\Domain\Model\Expertise $expertiseToRemove)
    {
        $this->expertise->detach($expertiseToRemove);
    }

    /**
     * Returns the expertise
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WDB\Btp\Domain\Model\Expertise>
     */
    public function getExpertise()
    {
        return $this->expertise;
    }

    /**
     * Sets the expertise
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WDB\Btp\Domain\Model\Expertise> $expertise
     * @return void
     */
    public function setExpertise(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $expertise)
    {
        $this->expertise = $expertise;
    }
}
