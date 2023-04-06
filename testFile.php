<?php

class BusinessMetrics {
    private $revenue;
    private $customers;
    private $churn_rate;
    private $expenses;

    public function __construct($revenue, $customers, $churn_rate, $expenses) {
        $this->revenue = $revenue;
        $this->customers = $customers;
        $this->churn_rate = $churn_rate;
        $this->expenses = $expenses;
    }

    public function get_total_revenue() {
        return $this->revenue;
    }

    public function get_average_revenue_per_customer() {
        return $this->revenue / $this->customers;
    }

    public function get_monthly_revenue_growth_rate($last_month_revenue) {
        return ($this->revenue - $last_month_revenue) / $last_month_revenue;
    }

    public function get_customer_lifetime_value($average_revenue_per_customer, $churn_rate) {
        return $average_revenue_per_customer / $churn_rate;
    }

    public function get_customer_acquisition_cost($marketing_expenses, $new_customers) {
        return $marketing_expenses / $new_customers;
    }

    public function get_gross_profit_margin() {
        return ($this->revenue - $this->expenses) / $this->revenue;
    }

    public function get_net_promoter_score($promoters, $detractors, $total_responses) {
        return ($promoters - $detractors) / $total_responses * 100;
    }

    public function calculate_metrics_and_insights($last_month_revenue, $marketing_expenses, $new_customers, $promoters, $detractors, $total_responses) {
        $average_revenue_per_customer = $this->get_average_revenue_per_customer();
        $customer_lifetime_value = $this->get_customer_lifetime_value($average_revenue_per_customer, $this->churn_rate);
        $customer_acquisition_cost = $this->get_customer_acquisition_cost($marketing_expenses, $new_customers);
        $monthly_revenue_growth_rate = $this->get_monthly_revenue_growth_rate($last_month_revenue);
        $gross_profit_margin = $this->get_gross_profit_margin();
        $net_promoter_score = $this->get_net_promoter_score($promoters, $detractors, $total_responses);

        echo "Average revenue per customer: $" . number_format($average_revenue_per_customer, 2) . "\n";
        echo "Customer lifetime value: $" . number_format($customer_lifetime_value, 2) . "\n";
        echo "Customer acquisition cost: $" . number_format($customer_acquisition_cost, 2) . "\n";

        if ($monthly_revenue_growth_rate > 0) {
            echo "Monthly revenue growth rate: " . number_format($monthly_revenue_growth_rate * 100, 2) . "% (positive growth)\n";
        } else if ($monthly_revenue_growth_rate == 0) {
            echo "Monthly revenue growth rate: 0% (no growth)\n";
        } else {
            echo "Monthly revenue growth rate: " . number_format($monthly_revenue_growth_rate * 100, 2) . "% (negative growth)\n";
        }

        if ($gross_profit_margin > 0.3) {
            echo "Gross profit margin: " . number_format($gross_profit_margin * 100, 2) . "% (healthy margin)\n";
        } else if ($gross_profit_margin > 0) {
            echo "Gross profit margin: " . number_format($gross_profit_margin * 100, 2) . "% (low margin, need to improve)\n";
        } else {
            echo "Gross profit margin: " . number_format($gross_profit_margin * 100, 2) . "% (negative margin, serious problem)\n";
        }
    
        if ($net_promoter_score >= 50) {
            echo "Net promoter score: " . number_format($net_promoter_score, 2) . "% (good score)\n";
        } else {
            echo "Net promoter score: " . number_format($net_promoter_score, 2) . "% (poor score, need to improve)\n";
        }
    }
}    



// Example usage
$metrics = new BusinessMetrics(10000, 500, 0.2, 4000);
$metrics->calculate_metrics_and_insights(9000, 2000, 50, 100, 20, 200);

// Outputs:
// Average revenue per customer: $20.00
// Customer lifetime value: $100.00
// Customer acquisition cost: $40.00
// Monthly revenue growth rate: 11.11% (positive growth)
// Gross profit margin: 60.00% (healthy margin)
// Net promoter score: 40.00% (poor score, need to improve)