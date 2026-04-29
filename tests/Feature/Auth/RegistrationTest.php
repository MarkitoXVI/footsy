<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('registration page is accessible', function () {
    $response = $this->get(route('register'));

    $response->assertStatus(200);
    $response->assertSee('Register');   // Change text if your register page has different wording
});

test('user can register with valid data', function () {
    $response = $this->post(route('register'), [
        'name'                  => 'John Doe',
        'email'                 => 'john@example.com',
        'password'              => 'Password123!',
        'password_confirmation' => 'Password123!',
    ]);

    $response->assertRedirect(route('dashboard')); // Change if your redirect is different

    $this->assertDatabaseHas('users', [
        'name'  => 'John Doe',
        'email' => 'john@example.com',
    ]);

    $this->assertAuthenticated();
});

test('user cannot register with invalid data', function () {
    $response = $this->post(route('register'), [
        'name'                  => '',
        'email'                 => 'invalid-email',
        'password'              => '123',
        'password_confirmation' => '456',
    ]);

    $response->assertSessionHasErrors(['name', 'email', 'password']);
    $this->assertGuest();
});

test('email must be unique', function () {
    User::factory()->create(['email' => 'existing@example.com']);

    $response = $this->post(route('register'), [
        'name'                  => 'Jane Doe',
        'email'                 => 'existing@example.com',
        'password'              => 'Password123!',
        'password_confirmation' => 'Password123!',
    ]);

    $response->assertSessionHasErrors('email');
});

test('password must be confirmed', function () {
    $response = $this->post(route('register'), [
        'name'                  => 'Test User',
        'email'                 => 'testexample.com',
        'password'              => 'Password123!',
        'password_confirmation' => 'WrongPass123!',
    ]);

    $response->assertSessionHasErrors('password');
});

test('password must be at least 8 characters', function () {
    $response = $this->post(route('register'), [
        'name'                  => 'Test User',
        'email'                 => 'test@example.com',
        'password'              => 'short',
        'password_confirmation' => 'short',
    ]);

    $response->assertSessionHasErrors('password');
});