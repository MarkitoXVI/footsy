<?php

use App\Models\User;
use Illuminate\Support\Facades\Notification;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('allows a guest to register a new account', function () {
    Notification::fake();

    // Visit the registration page
    $page = visit(route('register'))
        ->assertSee('Register')
        ->type('name', 'Test User')
        ->type('email', 'testuser@example.com')
        ->type('password', 'password123')
        ->type('password_confirmation', 'password123')
        ->press('Register')
        ->assertUrlIs(route('dashboard'))
        ->assertSee('Welcome, Test User');

    // Assert the user is authenticated
    $this->assertAuthenticated();

    // Assert the user record exists in the database
    $this->assertDatabaseHas('users', [
        'email' => 'testuser@example.com',
        'name'  => 'Test User',
    ]);

    // Optionally: assert a notification was sent
    // Notification::assertSentTo(User::first(), \App\Notifications\WelcomeNotification::class);
})->group('browser');
