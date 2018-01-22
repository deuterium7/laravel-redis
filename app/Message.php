<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Атрибуты для массового заполнения.
     *
     * @var array
     */
    protected $fillable = ['message'];

    /**
     * У сообщения может быть только один пользователь.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
