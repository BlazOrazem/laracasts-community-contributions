<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{
    /**
     * Fillable fields for the table.
     *
     * @var array
     */
    protected $fillable = [
        'channel_id', 'title', 'link'
    ];

    /**
     * Create a new instance and associate it with the given user.
     *
     * @param User $user
     * @return static
     */
    public static function from(User $user)
    {
        $link = new static;

        $link->user_id = $user->id;

        if ($user->isTrusted()) {
            $link->approve();
        }

        return $link;
    }

    /**
     * Contribute the given community link.
     *
     * @param $attributes
     * @return bool
     */
    public function contribute($attributes)
    {
        return $this->fill($attributes)->save();
    }

    /**
     * Approve a link.
     *
     * @return $this
     */
    public function approve()
    {
        $this->approved = true;

        return $this;
    }

    /**
     * A community link has a creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A community link is assigned a channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
