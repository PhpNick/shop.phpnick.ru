<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = ['user', 'shipment'];

    /**
     * An order is assigned a shipment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    /**
     * An order is assigned a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }           
}
