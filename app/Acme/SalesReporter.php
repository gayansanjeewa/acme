<?php

namespace Acme;

class SalesReporter
{

    /**
     * @param string $startDate
     * @param string $endDate
     * @throws \Exception
     */
    public function between($startDate, $endDate)
    {
        if (!Auth::chrck()) {
            throw new \Exception('Authentication required');
        }

        $sales = $this->queryDbForSalesBetween($startDate, $endDate);
        
        $this->format($sales);
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @return float
     */
    private function queryDbForSalesBetween(string $startDate, string $endDate)
    {
        return DB::table('sales')->whereBetween($startDate, $endDate)->sum() / 100;
    }

    private function format(float $sales)
    {
        return '<h1>'.$sales.'</h1>';
    }
}