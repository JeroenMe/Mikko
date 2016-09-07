<?php


class PaymentTest extends PHPUnit_Framework_TestCase
{
  /**
   * @test
   * @dataProvider dayInYearWithExpectedRemainingMonths
   */
  public function the_app_calculates_remaining_months_in_the_year(DateTimeInterface $date, $expecedRemainingMonths)
  {
    $sales = new SalesPaymentDates($date->format('Y'));
    $payments = (new Payments($sales))->allForRemainingOfTheYearFrom($date);
    $paymentMonts = array_map(function($payment){
      return $payment['month'];
    }, $payments);

    $this->assertEquals($expecedRemainingMonths, $paymentMonts);
  }

  /**
   * @test
   */
  public function with_salary_and_bonus_dates()
  {
    $sales = new SalesPaymentDates(2016);
    $payments = (new Payments($sales))->allForRemainingOfTheYearFrom(\DateTimeImmutable::createFromFormat('d/m/Y', '16/06/2016'));
    $expectedPayments = [
      ['month' => '6', 'salary' => '30/06/2016', 'bonus' => '15/06/2016'],
      ['month' => '7', 'salary' => '29/07/2016', 'bonus' => '15/07/2016'],
      ['month' => '8', 'salary' => '31/08/2016', 'bonus' => '15/08/2016'],
      ['month' => '9', 'salary' => '30/09/2016', 'bonus' => '15/09/2016'],
      ['month' => '10', 'salary' => '31/10/2016', 'bonus' => '19/10/2016'],
      ['month' => '11', 'salary' => '30/11/2016', 'bonus' => '15/11/2016'],
      ['month' => '12', 'salary' => '30/12/2016', 'bonus' => '15/12/2016'],
    ];

    $this->assertEquals($expectedPayments, $payments);
  }

  /**
   * @test
   */
  public function and_outputs_it_as_csv()
  {
    (new PaymentApp(\DateTimeImmutable::createFromFormat('d/m/Y', '06/09/2016')))->run();
    $this->assertFileExists(__DIR__.'/../output/due_payments_06_09_2016.csv');
  }

  public function dayInYearWithExpectedRemainingMonths()
  {
    return [
      [\DateTimeImmutable::createFromFormat('d/m/Y', '05/03/2016'), range(3,12)],
      [\DateTimeImmutable::createFromFormat('d/m/Y', '18/06/2016'), range(6,12)],
      [\DateTimeImmutable::createFromFormat('d/m/Y', '30/12/2016'), range(12,12)]
    ];
  }
}