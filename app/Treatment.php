<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\TreatmentAnswer;

class Treatment extends Model
{
    const STATUS_OPENED = 'opened';
    const STATUS_CLOSED = 'closed';
    const STATUS_SPAMED = 'spamed';

    protected $fillable = ['status', 'type', 'lastname', 'firstname', 'patronymic', 'gender', 'address', 'email',
        'post_address', 'phone', 'thematic', 'message', 'file', 'fileName', 'file_url'];

    public function scopeNewOnes(Builder $builder)
    {
        return $builder->where('status', self::STATUS_OPENED);
    }

    public function scopeOldOnes(Builder $builder)
    {
        return $builder->where('status', self::STATUS_CLOSED)
            ->orWhere('status', self::STATUS_SPAMED);
    }

    public function answers()
    {
        return $this->hasMany(TreatmentAnswer::class);
    }

    public function createAnswer($data)
    {
        return $this->answers()->create($data);
    }

    public function close()
    {
        $this->status = self::STATUS_CLOSED;
        return $this->save();
    }

    public function spam()
    {
        $this->status = self::STATUS_SPAMED;
        return $this->save();
    }

    public function opened()
    {
        return $this->status === self::STATUS_OPENED;
    }
}
