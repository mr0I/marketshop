<?php

namespace Tests\Unit;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testCategory()
    {
        $first = factory(\App\Category::class)->create();
        $second = factory(\App\Category::class)->create([
            'created_at' => \Carbon\Carbon::now()->subMonth()
        ]);
        $category = Category::all();
        $this->assertCount(2, $category);
    }
}
