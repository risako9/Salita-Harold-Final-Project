<?php
$patientName = "Fretz T. Comendador";
$appointmentTime = 1400;

$clinicStatus = [
    "isOpen" => true,
    "totalDoctors" => 5
];

if ($clinicStatus["isOpen"] && $appointmentTime < 1700) {
    echo "Appointment Confirmed for " . $patientName;
} else {
    echo "Clinic is currently closed.";
}

$services = ["Checkup", "X-Ray", "Pharmacy"];

echo "<ul>";
foreach ($services as $service) {
    echo "<li>" . $service . "</li>";
}
echo "</ul>";
?>