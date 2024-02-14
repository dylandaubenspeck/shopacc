<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $guarded = [];

    public static function getSetting(string $name)
    {
        return self::where('settingName', $name)->first()->settingValue ?? false;
    }

    public static function createSetting(string $name, string $value)
    {
        $result = self::create([
            'settingName' => $name,
            'settingValue' => $value
        ]);

        return $result->id ?? false;
    }

    public static function editSetting(string $name, string $value)
    {
        $model = self::where('settingName', $name)->first();
        if (!$model) {
            return false;
        }

        $model->update([
            'settingValue' => $value
        ]);

        return $model->id ?? false;
    }
}
