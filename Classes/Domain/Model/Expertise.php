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
 * Expertise
 */
class Expertise extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * team
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WDB\Btp\Domain\Model\Team>
     */
    protected $team = null;

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
        $this->team = $this->team ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Adds a Team
     *
     * @param \WDB\Btp\Domain\Model\Team $team
     * @return void
     */
    public function addTeam(\WDB\Btp\Domain\Model\Team $team)
    {
        $this->team->attach($team);
    }

    /**
     * Removes a Team
     *
     * @param \WDB\Btp\Domain\Model\Team $teamToRemove The Team to be removed
     * @return void
     */
    public function removeTeam(\WDB\Btp\Domain\Model\Team $teamToRemove)
    {
        $this->team->detach($teamToRemove);
    }

    /**
     * Returns the team
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WDB\Btp\Domain\Model\Team>
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Sets the team
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WDB\Btp\Domain\Model\Team> $team
     * @return void
     */
    public function setTeam(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $team)
    {
        $this->team = $team;
    }
}
