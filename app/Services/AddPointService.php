<?php
namespace App\Services;

use App\Models\EloquentCustomerPoint;
use App\Models\EloquentCustomerPointEvent;
use App\Models\PointEvent;
use Illuminate\Database\Connectors\ConnectorInterface;
use Throwable;

final class AddPointService
{
  /** @var EloquentCustomerPointEvent */
  private $eloquentCustomerPointEvent;
  /** @var EloquentCustomerPoint */
  private $eloquentCustomerPoint;
  /** @var ConnectorInterface */
  private $db;

  /**
   * @param EloquentCustomerPointEvent $eloquentCustomerPointEvent
   * @param EloquentCustomerPoint $eloquentCustomerPoint
   */
  public function __construct(
    EloquentCustomerPointEvent $eloquentCustomerPointEvent,
    EloquentCustomerPoint $eloquentCustomerPoint
  ) {
    $this->eloquentCustomerPointEvent = $eloquentCustomerPointEvent;
    $this->eloquentCustomerPoint = $eloquentCustomerPoint;
    $this->db = $eloquentCustomerPointEvent->getConnection();
  }

  /**
   * @param PointEvent $event
   * @throws Throwable
   */
  public function add(PointEvent $event)
  {
    $this->db->transaction(
      function () use ($event) {
        // ポイントイベントを登録
        $this->eloquentCustomerPointEvent->register($event);
        // 保有ポイントを更新
        $this->eloquentCustomerPoint->addPoint(
          $event->getCustomerId(),
          $event->getPoint()
        );
      }
    );
  }
}
