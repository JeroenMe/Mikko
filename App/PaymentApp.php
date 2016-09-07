<?php

class PaymentApp
{
  /** @var DateTimeInterface */
  private $date;
  public function __construct(DateTimeInterface $date) {
    $this->date = $date;
  }

  public function run() {
    $this->outputAsCsv($this->calculateSalesPayments());
  }

  private function outputAsCsv(array $calculatedPayments)
  {
    $outputFilePath = __DIR__."/../output/due_payments_{$this->date->format('d_m_Y')}.csv";
    $fp = fopen($outputFilePath, 'w');
    foreach($calculatedPayments as $payment) {
      fputcsv($fp, $payment);
    }
    fclose($fp);
  }

  private function calculateSalesPayments()
  {
    $sales = new SalesPaymentDates($this->date->format('Y'));

    return (new Payments($sales))->allForRemainingOfTheYearFrom($this->date);
  }
}