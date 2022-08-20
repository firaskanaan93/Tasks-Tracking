<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class TaskTest extends TestCase
{

    public function test_create_form()
    {
        $response = $this->get('/tasks/create');

        $response->assertStatus(200);
    }

    public function test_create_task()
    {
        $response = $this->post('/tasks',[
            '_token' => csrf_token(),
            'assigned_by_id' => User::where('role','admin')->inRandomOrder()->take(1)->value('id'),
            'assigned_to_id' => User::where('role','normal')->inRandomOrder()->take(1)->value('id'),
            'title' => 'created by PhpUint test',
            'description' => 'created by PhpUint test'
        ]);

        $response->assertStatus(302);
    }
}
