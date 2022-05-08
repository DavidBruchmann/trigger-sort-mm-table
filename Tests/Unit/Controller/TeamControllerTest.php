<?php

declare(strict_types=1);

namespace WDB\Btp\Tests\Unit\Controller;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Test case
 *
 * @author David Bruchmann <david.bruchmann@gmail.com>
 */
class TeamControllerTest extends UnitTestCase
{
    /**
     * @var \WDB\Btp\Controller\TeamController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\WDB\Btp\Controller\TeamController::class))
            ->onlyMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllTeamsFromRepositoryAndAssignsThemToView(): void
    {
        $allTeams = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $teamRepository = $this->getMockBuilder(\WDB\Btp\Domain\Repository\TeamRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $teamRepository->expects(self::once())->method('findAll')->will(self::returnValue($allTeams));
        $this->subject->_set('teamRepository', $teamRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('teams', $allTeams);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenTeamToView(): void
    {
        $team = new \WDB\Btp\Domain\Model\Team();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('team', $team);

        $this->subject->showAction($team);
    }
}
