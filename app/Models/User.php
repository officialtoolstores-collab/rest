<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// якщо використовуєш Filament:
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use Notifiable;

    // Дозволені для масового присвоєння поля
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Сховати в JSON/масивах
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Кастинги (не обов'язково, але корисно)
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Тимчасово пускаємо всіх логінених в адмінку (якщо треба)
    public function canAccessPanel(Panel $panel): bool
    {
        return (bool) $this->is_admin;
    }
}
