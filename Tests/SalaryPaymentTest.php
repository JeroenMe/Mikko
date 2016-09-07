<?php

class SalaryPaymentTest extends PHPUnit_Framework_TestCase
{
  /**
   * @test
   */
  public function we_pay_salary_on_the_last_of_each_month()
  {
    $lastDayOfSeptember2016 = \DateTimeImmutable::createFromFormat('d/m/Y', '30/09/2016');

    $this->assertEquals($lastDayOfSeptember2016->format('d/m/Y'), (new SalesPaymentDates(2016))->salaryDateForMonth(9)->format('d/m/Y'));
  }

  /**
   * @test
   */
  public function except_when_the_last_day_is_a_weekend()
  {
    $lastDayOfDecember2016 = \DateTimeImmutable::createFromFormat('d/m/Y', '31/12/2016');

    $this->assertNotEquals($lastDayOfDecember2016->format('d/m/Y'), (new SalesPaymentDates(2016))->salaryDateForMonth(12)->format('d/m/Y'));
  }

  /**
   * @test
   */
  public function then_we_pay_the_last_weekday_of_the_month()
  {
    $lastDayOfDecember2016 = \DateTimeImmutable::createFromFormat('d/m/Y', '30/12/2016');

    $this->assertEquals($lastDayOfDecember2016->format('d/m/Y'), (new SalesPaymentDates(2016))->salaryDateForMonth(12)->format('d/m/Y'));
  }
}