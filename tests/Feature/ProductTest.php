<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->product = [
            'title' => 'test',
            'description' => 'test des',
            'user_id' => '1',
            'size' => '12',
            'color' => 'green',
        ];
    }

    public function test_create_product_without_auth()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->post('api/products', $this->product);
        $response->assertStatus(401);
    }

    public function test_create_product_with_auth()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
            ->actingAs(User::first())
            ->post('api/products', $this->product);
        $response->assertStatus(200);
    }

}
