<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ItemTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItemsApi()
    {
        $dataForm = ['page'=> 1, 'per_page'=> 5, 'sort' => 'stars', 'order' => 'desc'];
        $this->json('GET', route('items'), $dataForm)
            ->assertResponseStatus(200);
    }
}
