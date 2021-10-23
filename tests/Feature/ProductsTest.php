<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

class ProductsTest extends TestCase
{
    /** @test */
    public function getAllProducts()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/products');
        $response->assertOk();
    }

    /** @test */
    public function getProductsByPrice()
    {
        $this->withoutExceptionHandling();
        $response = $this->call('GET', '/products', ['price' => [1, 2]]);
        $response->assertOk();
    }

    /** @test */
    public function getProductsByManufacturer()
    {
        $this->withoutExceptionHandling();
        $response = $this->call(
            'GET',
            '/products',
            [
                'manufacturer' => [1, 2]
            ]
        );
        $response->assertOk();
    }

    /** @test */
    public function getProductsCategory()
    {
        $this->withoutExceptionHandling();
        $response = $this->call(
            'GET',
            '/products',
            [
                'categories' => [1, 2]
            ]
        );
        $response->assertOk();
    }

    /** @test */
    public function getProductsDate()
    {
        $this->withoutExceptionHandling();
        $response = $this->call(
            'GET',
            '/products',
            [
                'from' => Carbon::now()->subYear(),
                'to' => Carbon::now(),
            ]
        );
        $response->assertOk();
    }
}
