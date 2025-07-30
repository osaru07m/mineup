<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'value'
    ];

    public static function get(string $name, mixed $default = null): mixed
    {
        $setting = static::where('name', $name)->first();
        return $setting?->value ?? $default;
    }
}
