<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSetting extends Model
{
  protected $fillable = ['key', 'value', 'type'];

  /**
   * Get a setting value by key
   */
  public static function getValue($key, $default = null)
  {
    $setting = self::where('key', $key)->first();
    return $setting ? $setting->value : $default;
  }

  /**
   * Set a setting value
   */
  public static function setValue($key, $value, $type = 'text')
  {
    return self::updateOrCreate(
      ['key' => $key],
      ['value' => $value, 'type' => $type]
    );
  }
}
