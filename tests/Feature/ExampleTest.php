<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_employees_page_loads_successfully(): void
    {
        $response = $this->get('/employees');

        $response->assertStatus(200);
        $response->assertSee('Employee');
        $response->assertSee('Department');
    }
}
