<?php

declare(strict_types=1);

namespace WDB\Btp\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author David Bruchmann <david.bruchmann@gmail.com>
 */
class ExpertiseTest extends UnitTestCase
{
    /**
     * @var \WDB\Btp\Domain\Model\Expertise|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \WDB\Btp\Domain\Model\Expertise::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle(): void
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('title'));
    }

    /**
     * @test
     */
    public function getTeamReturnsInitialValueForTeam(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getTeam()
        );
    }

    /**
     * @test
     */
    public function setTeamForObjectStorageContainingTeamSetsTeam(): void
    {
        $team = new \WDB\Btp\Domain\Model\Team();
        $objectStorageHoldingExactlyOneTeam = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneTeam->attach($team);
        $this->subject->setTeam($objectStorageHoldingExactlyOneTeam);

        self::assertEquals($objectStorageHoldingExactlyOneTeam, $this->subject->_get('team'));
    }

    /**
     * @test
     */
    public function addTeamToObjectStorageHoldingTeam(): void
    {
        $team = new \WDB\Btp\Domain\Model\Team();
        $teamObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $teamObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($team));
        $this->subject->_set('team', $teamObjectStorageMock);

        $this->subject->addTeam($team);
    }

    /**
     * @test
     */
    public function removeTeamFromObjectStorageHoldingTeam(): void
    {
        $team = new \WDB\Btp\Domain\Model\Team();
        $teamObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $teamObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($team));
        $this->subject->_set('team', $teamObjectStorageMock);

        $this->subject->removeTeam($team);
    }
}
