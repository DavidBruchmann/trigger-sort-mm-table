<?php

declare(strict_types=1);

namespace WDB\Btp\Controller;


/**
 * This file is part of the "bidirectional m:n relation sorting" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 David Bruchmann <david.bruchmann@gmail.com>, Webdevelopment Barlian
 */

/**
 * TeamController
 */
class TeamController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * teamRepository
     *
     * @var \WDB\Btp\Domain\Repository\TeamRepository
     */
    protected $teamRepository = null;

    /**
     * @param \WDB\Btp\Domain\Repository\TeamRepository $teamRepository
     */
    public function injectTeamRepository(\WDB\Btp\Domain\Repository\TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $teams = $this->teamRepository->findAll();
        $this->view->assign('teams', $teams);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \WDB\Btp\Domain\Model\Team $team
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\WDB\Btp\Domain\Model\Team $team): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('team', $team);
        return $this->htmlResponse();
    }
}
