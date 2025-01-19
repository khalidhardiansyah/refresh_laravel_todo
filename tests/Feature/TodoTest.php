<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_cant_create_todo_without_authentication(): void
    {
        $todo = Todo::factory()->make();
        $response = $this->post('/', [
            'todo' => $todo->todo,
            'user_id'=>1
        ]);
        
        $response->assertRedirect('/login');
    }

    public function test_user_can_create_todo_with_authentication(): void
    {
        $user = User::factory()->make();
        $todo = Todo::factory()->make();
        $response = $this->actingAs($user)->post('/', [
            'todo' => $todo->todo,
            'user_id'=>1
        ]);
        
        $response->assertRedirect('/');
    }

    public function test_user_delete_todo():void{
        $user = User::factory()->create();
        $todo = Todo::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(route('todos.eventAction', $todo->id), [
            'action' => 'delete',
        ]);

        $response->assertRedirect('/');
    }

    public function test_user_checked_todo():void{
        $user = User::factory()->create();
        $todo = Todo::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(route('todos.eventAction', $todo->id), [
            'action' => 'checked',
        ]);

        $response->assertRedirect('/');
    }
    
    public function test_user_update_todo():void{
        $user = User::factory()->create();
        $todo = Todo::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->patch(route('todos.update', $todo->id), [
            'activity' => 'New Activity',
        ]);

        $response->assertRedirect('/');
    }

}
