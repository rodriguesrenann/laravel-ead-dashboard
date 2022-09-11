<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportReply extends Model
{
    use UuidTrait;
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'support_id',
        'user_id',
        'admin_id',
        'description'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function support()
    {
        return $this->belongsTo(Support::class);
    }
}
