<?php

namespace Asgard\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable = ['key'];

    public static function get($key)
    {
        $result = self::where('key', '=', $key)->first();

        if(!$result)
            return null;

        return $result->value;
    }

    public static function set($key, $val)
    {
        $instance = self::firstOrNew(['key' => $key]);
        $instance->value = $val;
        $instance->save();
    }
}
