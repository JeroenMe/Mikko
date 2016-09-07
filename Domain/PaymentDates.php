<?php

interface PaymentDates
{
  /**
   * @param $month
   * @return \DateTimeInterface
   */
  public function salaryDateForMonth($month);
  /**
   * @param $month
   * @return \DateTimeInterface
   */
  public function bonusDateForMonth($month);
}