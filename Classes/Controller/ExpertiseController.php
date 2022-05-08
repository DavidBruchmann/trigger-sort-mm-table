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
 * ExpertiseController
 */
class ExpertiseController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * expertiseRepository
     *
     * @var \WDB\Btp\Domain\Repository\ExpertiseRepository
     */
    protected $expertiseRepository = null;

    /**
     * @param \WDB\Btp\Domain\Repository\ExpertiseRepository $expertiseRepository
     */
    public function injectExpertiseRepository(\WDB\Btp\Domain\Repository\ExpertiseRepository $expertiseRepository)
    {
        $this->expertiseRepository = $expertiseRepository;
    }

    /**
     * action list
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAction(): \Psr\Http\Message\ResponseInterface
    {
        $expertises = $this->expertiseRepository->findAll();
        $this->view->assign('expertises', $expertises);
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param \WDB\Btp\Domain\Model\Expertise $expertise
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\WDB\Btp\Domain\Model\Expertise $expertise): \Psr\Http\Message\ResponseInterface
    {
        $this->view->assign('expertise', $expertise);
        return $this->htmlResponse();
    }
}
