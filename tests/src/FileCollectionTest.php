<?php

namespace Live\Collection;

use PHPUnit\Framework\TestCase;

class FileCollectionTest extends TestCase
{
    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function objectCanBeConstructed()
    {
        $collection = new FileCollection();
        return $collection;
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     * @doesNotPerformAssertions
     */
    public function dataCanBeAdded()
    {
        $collection = new FileCollection();
        $collection->set('index1', false, '09:58:01');
        $collection->set('index2', 28.6);
        $collection->set('index3', true);
        $collection->set('index4', 'test value', '12:54:10');
        $collection->set('index5', ['file1', 'file2', 'file3'], '09:55:13');
    }

    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function dataCanBeRetrieved()
    {
        $collection = new FileCollection();
        $collection->set('index1', 'value');
        $collection->set('index2', ['file_1', 'file_2'], '08:17:10');
        $collection->set('index3', 25.6, '23:17:10');

        $this->assertEquals('value', $collection->get('index1'));
        $this->assertEquals(['file_1', 'file_2'], $collection->get('index2'));
        $this->assertEquals(25.6, $collection->get('index3'));
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     */
    public function inexistentIndexShouldReturnDefaultValue()
    {
        $collection = new FileCollection();

        $this->assertNull($collection->get('index1'));
        $this->assertEquals('defaultValue', $collection->get('index1', 'defaultValue'));
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     */
    public function newCollectionShouldNotContainItems()
    {
        $collection = new FileCollection();
        $this->assertEquals(0, $collection->count());
    }

    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function collectionWithItemsShouldReturnValidCount()
    {
        $collection = new FileCollection();
        $collection->set('index1', 'value');
        $collection->set('index2', 5);
        $collection->set('index3', true);

        $this->assertEquals(3, $collection->count());
    }

    /**
     * @test
     * @depends collectionWithItemsShouldReturnValidCount
     */
    public function collectionCanBeCleaned()
    {
        $collection = new FileCollection();
        $collection->set('index', 'value');
        $this->assertEquals(1, $collection->count());

        $collection->clean();
        $this->assertEquals(0, $collection->count());
    }

    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function addedItemShouldExistInCollection()
    {
        $collection = new FileCollection();
        $collection->set('index', 'value');

        $this->assertTrue($collection->has('index'));
    }
}
