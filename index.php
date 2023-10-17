<!DOCTYPE html>
<html>
<head>
    <title>Payroll System for Mukwano Industries</title>
</head>
<body>
    <h1>Payroll System for Mukwano Industries</h1>
    <form method="post" action="">
        Enter Employee's Basic Pay: <input type="text" name="basic_pay">
        <input type="submit" value="Calculate Salary">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $basic_pay = $_POST["basic_pay"];

        // Constants
        $overtime_rate = 30000; // UGX per hour
        $housing_allowance_percentage = 0.08;
        $transport_allowance_percentage = 0.05;
        $medical_allowance_percentage = 0.06;
        $nssf_percentage = 0.15;

        // Calculate Overtime
        $overtime_hours = 10;
        $overtime = $overtime_hours * $overtime_rate;

        // Calculate Allowances
        $housing_allowance = $basic_pay * $housing_allowance_percentage;
        $transport_allowance = $basic_pay * $transport_allowance_percentage;
        $medical_allowance = $basic_pay * $medical_allowance_percentage;

        // Calculate Gross Pay
        $gross_pay = $basic_pay + $overtime + $housing_allowance + $transport_allowance + $medical_allowance;

        // Calculate NSSF
        $nssf = $gross_pay * $nssf_percentage;

        // Calculate PAYEE
        $gross_payee = 0;
        if ($gross_pay >= 200000 && $gross_pay < 350000) {
            $gross_payee = 20000 + 0.2 * ($gross_pay - 350000);
        } elseif ($gross_pay >= 350000 && $gross_pay < 500000) {
            $gross_payee = 20000 + 0.2 * (350000 - 200000) + 0.3 * ($gross_pay - 350000);
        } elseif ($gross_pay >= 500000) {
            $gross_payee = 60500 + 0.3 * ($gross_pay - 500000);
        }

        // Calculate Net Pay
        $total_allowances = $housing_allowance + $transport_allowance + $medical_allowance;
        $total_deductions = $nssf + $gross_payee;
        $net_pay = $gross_pay - $total_deductions;

        echo "<h2>Salary Details</h2>";
        echo "Basic Pay: UGX " . number_format($basic_pay) . "<br>";
        echo "Overtime: UGX " . number_format($overtime) . "<br>";
        echo "Housing Allowance: UGX " . number_format($housing_allowance) . "<br>";
        echo "Transport Allowance: UGX " . number_format($transport_allowance) . "<br>";
        echo "Medical Allowance: UGX " . number_format($medical_allowance) . "<br>";
        echo "Gross Pay: UGX " . number_format($gross_pay) . "<br>";
        echo "NSSF: UGX " . number_format($nssf) . "<br>";
        echo "PAYEE: UGX " . number_format($gross_payee) . "<br>";
        echo "Net Pay: UGX " . number_format($net_pay) . "<br>";
    }
    ?>

</body>
</html>
