<?php

final class Payments
{
  /** @var PaymentDates paymentDates */
  private $paymentDates;

  public function __construct(PaymentDates $paymentDates)
  {
    $this->paymentDates = $paymentDates;
  }

  public function allForRemainingOfTheYearFrom(\DateTimeInterface $dateToCalculateFrom) {
    $duePaymentsForThisYear = [];

    foreach($this->remainingMonthsInYear($dateToCalculateFrom) as $month) {
      $duePaymentsForThisYear[] = [
        'month' => $month,
        'salary' => $this->paymentDates->salaryDateForMonth($month)->format('d/m/Y'),
        'bonus' => $this->paymentDates->bonusDateForMonth($month)->format('d/m/Y')
      ];
    }

    return $duePaymentsForThisYear;
  }

  private function remainingMonthsInYear(\DateTimeInterface $dateToCalculateFrom)
  {
    return range($dateToCalculateFrom->format('m'), 12);
  }
}