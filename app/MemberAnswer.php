<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MemberAnswer
 * @package App
 */
class MemberAnswer extends Model
{
    /**
     * @var string
     */
    protected $table = 'member_answer';

    /**
     * @var array
     */
    protected $fillable = [
        'member_id', 'answer_id', 'title_id', 'text',
    ];

    /**
     * @author Jerry
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
