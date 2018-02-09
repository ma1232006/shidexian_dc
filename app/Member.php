<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Member
 * @package App
 */
class Member extends Model
{
    /**
     * @var string
     */
    protected $table = 'members';

    protected $fillable = [
        'session_id',
    ];

    /**
     * @author Jerry
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answer()
    {
        return $this->hasMany(MemberAnswer::class);
    }
}
