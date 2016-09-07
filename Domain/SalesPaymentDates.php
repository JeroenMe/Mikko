<?php

final class SalesPaymentDates implements PaymentDates
{
  const SATURDAY = 6;
  const SUNDAY = 0;

  // The year we want to calculate payment dates for
  private $year;

  public function __construct($year)
  {
    $this->year = $year;
  }

  /**
   * @param int $month
   * @return \DateTimeInterface
   */
  public function salaryDateForMonth($month)
  {
    $adayInMonth =(\DateTimeImmutable::createFromFormat('d/m/Y', "1/$month/{$this->year}"));
    $lastDayOfTheMonth = $adayInMonth->modify('last day of this month');

    return $this->isWeekend($lastDayOfTheMonth)
      ? $lastDayOfTheMonth->modify('last weekday')
      : $lastDayOfTheMonth
    ;
  }

  public function bonusDateForMonth($month)
  {
    $fifteenthInMonth =(\DateTimeImmutable::createFromFormat('d/m/Y', "15/$month/{$this->year}"));

    return $this->isWeekend($fifteenthInMonth)
      ? $fifteenthInMonth->modify('next wednesday')
      : $fifteenthInMonth
    ;
  }

  private function isWeekend(\DateTimeImmutable $day)
  {
    $dayOfWeek = (int)$day->format('w');

    return $dayOfWeek === self::SATURDAY || $dayOfWeek === self::SUNDAY;
  }
}