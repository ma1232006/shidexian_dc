<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Title
 * @package App
 */
class Title extends Model
{
    /**
     * @var string
     */
    protected $table = 'titles';

    /**
     * @author Jerry
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * @author Jerry
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function message()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @author Jerry
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function memberAnswer()
    {
        return $this->hasMany(MemberAnswer::class);
    }
}
