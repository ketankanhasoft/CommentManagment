<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_a_comment_in_the_database()
    {
        $payload = [
            'client_id' => 'aabbccdd-1234-5678-1234-aabbccddeeff',
            'email' => 'test@example.com',
            'phone_number' => '1234567890',
            'name' => 'John Doe',
            'comment' => 'This is a test comment.',
        ];
        $response = $this->post('/api/comments', $payload);
        $response->assertStatus(201);
        $this->assertDatabaseHas('comments', $payload);
    }

    /** @test */
    public function it_should_not_store_a_invalid_details_in_the_database()
    {
        $payload = [
            'client_id' => 'aabbccdd123456781234-aabbccddeeff',
            'email' => 'testing',
            'phone_number' => '1234567',
            'name' => 12345,
            'comment' => 23464,
        ];
        $response = $this->post('/api/comments', $payload);
        $response->assertStatus(400)->assertJsonValidationErrors(['client_id']);
        $response->assertStatus(400)->assertJsonValidationErrors(['email']);
        $response->assertStatus(400)->assertJsonValidationErrors(['phone_number']);
        $response->assertStatus(400)->assertJsonValidationErrors(['name']);
        $response->assertStatus(400)->assertJsonValidationErrors(['comment']);
    }

    /** @test */
    public function it_should_not_store_blank_details_in_the_database()
    {
        $payload = [
            'client_id' => 'aabbccdd123456781234-aabbccddeeff',
            'email' => '',
            'phone_number' => '',
            'name' => '',
            'comment' => '',
        ];
        $response = $this->post('/api/comments', $payload);
        $response->assertStatus(400)->assertJsonValidationErrors(['client_id']);
        $response->assertStatus(400)->assertJsonValidationErrors(['email']);
        $response->assertStatus(400)->assertJsonMissingValidationErrors(['phone_number']);
        $response->assertStatus(400)->assertJsonValidationErrors(['name']);
        $response->assertStatus(400)->assertJsonValidationErrors(['comment']);
    }
}
