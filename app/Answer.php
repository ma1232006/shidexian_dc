<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Answer
 * @package App
 */
class Answer extends Model
{
    /**
     * @var string
     */
    protected $table = 'answer';

    /**
     * @author Jerry
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function title()
    {
        return $this->belongsTo(Title::class);
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
