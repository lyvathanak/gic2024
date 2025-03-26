<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_categories_created_success(): void
    {
        $response = $this->get('/api/categories');

        $response->assertStatus(200)->assertJsonFragment(["message" => "Categories retrieved successfully."]);
    }
}
