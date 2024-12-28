<?php

namespace Modules\Users\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Database\factories\AdminFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['user_id', 'mobile', 'address'];
    
    // protected static function newFactory(): AdminFactory
    // {
    //     //return AdminFactory::new();
    // }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
