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
class TeamTest extends UnitTestCase
{
    /**
     * @var \WDB\Btp\Domain\Model\Team|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \WDB\Btp\Domain\Model\Team::class,
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
    public function getNameReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName(): void
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('name'));
    }

    /**
     * @test
     */
    public function getExpertiseReturnsInitialValueForExpertise(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getExpertise()
        );
    }

    /**
     * @test
     */
    public function setExpertiseForObjectStorageContainingExpertiseSetsExpertise(): void
    {
        $expertise = new \WDB\Btp\Domain\Model\Expertise();
        $objectStorageHoldingExactlyOneExpertise = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneExpertise->attach($expertise);
        $this->subject->setExpertise($objectStorageHoldingExactlyOneExpertise);

        self::assertEquals($objectStorageHoldingExactlyOneExpertise, $this->subject->_get('expertise'));
    }

    /**
     * @test
     */
    public function addExpertiseToObjectStorageHoldingExpertise(): void
    {
        $expertise = new \WDB\Btp\Domain\Model\Expertise();
        $expertiseObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $expertiseObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($expertise));
        $this->subject->_set('expertise', $expertiseObjectStorageMock);

        $this->subject->addExpertise($expertise);
    }

    /**
     * @test
     */
    public function removeExpertiseFromObjectStorageHoldingExpertise(): void
    {
        $expertise = new \WDB\Btp\Domain\Model\Expertise();
        $expertiseObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $expertiseObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($expertise));
        $this->subject->_set('expertise', $expertiseObjectStorageMock);

        $this->subject->removeExpertise($expertise);
    }
}
