<?php


class BonusPaymentTest extends PHPUnit_Framework_TestCase
{
  /**
   * @test
   */
  public function we_pay_bonusses_on_the_fifteenth_of_each_month()
  {
    $fifteenthSeptember2016 = \DateTimeImmutable::createFromFormat('d/m/Y', '15/09/2016');

    $this->assertEquals($fifteenthSeptember2016->format('d/m/Y'), (new SalesPaymentDates(2016))->bonusDateForMonth(9)->format('d/m/Y'));
  }

  /**
   * @test
   */
  public function except_when_the_fifteenth_is_a_weekend()
  {
    $fifteenthOctober2016 = \DateTimeImmutable::createFromFormat('d/m/Y', '15/10/2016');

    $this->assertNotEquals($fifteenthOctober2016->format('d/m/Y'), (new SalesPaymentDates(2016))->bonusDateForMonth(10)->format('d/m/Y'));
  }

  /**
   * @test
   */
  public function then_we_pay_the_next_following_wednesday()
  {
    $nextWednesdayAfterOctoberFifteenth2016 = \DateTimeImmutable::createFromFormat('d/m/Y', '19/10/2016');

    $this->assertEquals($nextWednesdayAfterOctoberFifteenth2016->format('d/m/Y'), (new SalesPaymentDates(2016))->bonusDateForMonth(10)->format('d/m/Y'));
  }
}