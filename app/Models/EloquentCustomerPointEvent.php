<?php

namespace App\Models;

use illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $customer_id
 * @property string $event
 * @property int $point
 * @property string $created_at
 */
class EloquentCustomerPointEvent extends Model
{
  protected $table = 'customer_point_events';
  public $timestamps = false;

  /**
   * @param PointEvent $event
   */
  public function register(PointEvent $event)
  {
    $new = $this->newInstance();
    $new->customer_id = $event->getCustomerId();
    $new->event = $event->getEvent();
    $new->point = $event->getPoint();
    $new->created_at = $event->getCreatedAt();
    $new->save();
  }
}
