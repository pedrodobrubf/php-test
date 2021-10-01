<?php

namespace Live\Collection;

use PHPUnit\Framework\TestCase;

class MemoryCollectionTest extends TestCase
{
    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function objectCanBeConstructed()
    {
        $collection = new MemoryCollection();
        return $collection;
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     * @doesNotPerformAssertions
     */
    public function dataCanBeAdded()
    {
        $collection = new MemoryCollection();
        $collection->set('index1', 'value');
        $collection->set('index2', 5, '09:58:01');
        $collection->set('index3', true);
        $collection->set('index4', 6.5, '23:17:10');
        $collection->set('index5', ['data'], '08:17:10');
    }

    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function dataCanBeRetrieved()
    {
        $collection = new MemoryCollection();
        $collection->set('index1', 'value');
        $collection->set('index2', ['data_1', 'data_2'], '08:17:10');
        $collection->set('index3', 25.6, '23:17:10');

        $this->assertEquals('value', $collection->get('index1'));
        $this->assertEquals(null, $collection->get('index2'));
        $this->assertEquals(25.6, $collection->get('index3'));
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     */
    public function inexistentIndexShouldReturnDefaultValue()
    {
        $collection = new MemoryCollection();

        $this->assertNull($collection->get('index1'));
        $this->assertEquals('defaultValue', $collection->get('index1', 'defaultValue'));
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     */
    public function newCollectionShouldNotContainItems()
    {
        $collection = new MemoryCollection();
        $this->assertEquals(0, $collection->count());
    }

    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function collectionWithItemsShouldReturnValidCount()
    {
        $collection = new MemoryCollection();
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
        $collection = new MemoryCollection();
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
        $collection = new MemoryCollection();
        $collection->set('index', 'value');

        $this->assertTrue($collection->has('index'));
    }
}
