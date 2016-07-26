<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\CommunityLinkAlreadySubmitted;

class CommunityLink extends Model
{
    /**
     * Fillable fields for the table.
     *
     * @var array
     */
    protected $fillable = ['channel_id', 'title', 'link'];

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
     * @param array $attributes
     * @return bool
     * @throws CommunityLinkAlreadySubmitted
     */
    public function contribute($attributes)
    {
        if ($existing = $this->hasAlreadyBeenSubmitted($attributes['link'])) {
            $existing->touch();

            throw new CommunityLinkAlreadySubmitted;
        }

        return $this->fill($attributes)->save();
    }

    /**
     * Scope the query to records from a particular channel.
     *
     * @param Builder $builder
     * @param Channel $channel
     * @return Builder
     */
    public function scopeForChannel($builder, $channel)
    {
        if ($channel->exists) {
            return $builder->where('channel_id', $channel->id);
        }

        return $builder;
    }
    
    /**
     * Mark the community link as approved.
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

    /**
     * Determine if the link has already been submitted.
     *
     * @param string $link
     * @return mixed
     */
    protected function hasAlreadyBeenSubmitted($link)
    {
        return static::where('link', $link)->first();
    }
}
