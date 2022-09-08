<?php

namespace Tests\Feature;

use App\Models\Category;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $cat = Category::find(2);
        try {
            echo $cat->parent->id;
        } catch(Exception $e) {
            echo null;
        }
        
    }
}
