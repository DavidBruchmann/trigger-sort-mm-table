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
class ExpertiseControllerTest extends UnitTestCase
{
    /**
     * @var \WDB\Btp\Controller\ExpertiseController|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder($this->buildAccessibleProxy(\WDB\Btp\Controller\ExpertiseController::class))
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
    public function listActionFetchesAllExpertisesFromRepositoryAndAssignsThemToView(): void
    {
        $allExpertises = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $expertiseRepository = $this->getMockBuilder(\WDB\Btp\Domain\Repository\ExpertiseRepository::class)
            ->onlyMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $expertiseRepository->expects(self::once())->method('findAll')->will(self::returnValue($allExpertises));
        $this->subject->_set('expertiseRepository', $expertiseRepository);

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('expertises', $allExpertises);
        $this->subject->_set('view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenExpertiseToView(): void
    {
        $expertise = new \WDB\Btp\Domain\Model\Expertise();

        $view = $this->getMockBuilder(ViewInterface::class)->getMock();
        $this->subject->_set('view', $view);
        $view->expects(self::once())->method('assign')->with('expertise', $expertise);

        $this->subject->showAction($expertise);
    }
}
