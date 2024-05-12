<?php

namespace App\Models;

use illuminate\Database\Eloquent\Factories\HasFactory;
use illuminate\Database\Eloquent\Model;

/**
 * @property int $customer_id
 * @property int $point
 */
class EloquentCustomerPoint extends Model
{
  use HasFactory;

  protected $table = 'customer_points';
  public $timestamps = false;

  public function addPoint(int $customerId, int $point): bool
  {
    return $this->newQuery()
      ->where('customer_id', $customerId)
      ->increment('point', $point) === 1;
  }

  public function findPoint(int $customerId): int
  {
    return $this->newQuery()
      ->where('customer_id', $customerId)
      ->value('point');
  }
}
