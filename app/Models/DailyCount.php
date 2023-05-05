<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyCount extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'count'];

    public static function dailyCount()
    {
        if (DailyCount::count() > 0) {
            $count = DailyCount::firstOrNew(['date' => date('Y-m-d')]);
            $count->count = $count->count + 1;
            $count->save();
        } else {
            $count = DailyCount::firstOrNew(['date' => date('Y-m-d')]);
            $count->count = 1;
            $count->save();
        }
        return $count;
    }
}
