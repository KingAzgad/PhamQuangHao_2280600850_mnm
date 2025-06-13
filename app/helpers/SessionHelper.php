<?php
class SessionHelper
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function isLoggedIn(): bool
    {
        self::start();
        return isset($_SESSION['username']);
    }

    public static function isAdmin(): bool
    {
        self::start();
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    public static function getUsername(): ?string
    {
        self::start();
        return $_SESSION['username'] ?? null;
    }

    public static function getRole(): string
    {
        self::start();
        return $_SESSION['role'] ?? 'guest';
    }

    public static function hasRole(string $role): bool
    {
        self::start();
        return isset($_SESSION['role']) && $_SESSION['role'] === $role;
    }

    public static function logout(): void
    {
        self::start();
        session_unset();
        session_destroy();
    }
}
