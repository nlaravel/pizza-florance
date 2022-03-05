<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TasksTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function a_user_can_read_all_the_tasks()
    {
        //Given we have task in the database
        $task = factory('App\Product')->create();

        //When user visit the tasks page
        $response = $this->get('/product');

        //He should be able to read the task
        $response->assertSee($task->name);
    }


}