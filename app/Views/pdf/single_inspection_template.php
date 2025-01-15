<!DOCTYPE html>
<html>
<head>
    <title>Inspection Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .section { margin-bottom: 20px; }
        .criteria-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .criteria-table th, .criteria-table td { border: 1px solid #ddd; padding: 8px; }
        .criteria-table th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Container Inspection Report</h1>
            <h3>Container Number: <?= $inspection->container_code ?></h3>
        </div>

        <div class="section">
            <h4>Inspection Details</h4>
            <table class="criteria-table">
                <tr>
                    <th>Date</th>
                    <td><?= $inspection->inspection_date ?></td>
                    <th>Inspector</th>
                    <td><?= $inspection->inspector_name ?></td>
                </tr>
                <tr>
                    <th>Arrival Time</th>
                    <td><?= $inspection->arrival_time ?></td>
                    <th>Departure Time</th>
                    <td><?= $inspection->departure_time ?></td>
                </tr>
                <tr>
                    <th>Seal No</th>
                    <td><?= $inspection->seal_no ?></td>
                    <th>PO Number</th>
                    <td><?= $inspection->po_number ?></td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h4>Inspection Criteria Results</h4>
            <table class="criteria-table">
                <tr>
                    <th>Criteria</th>
                    <th>Result</th>
                </tr>
                <tr>
                    <td>Undercarriage</td>
                    <td><?= $inspection->undercarriage_result ?></td>
                </tr>
                <tr>
                    <td>Inside Wall</td>
                    <td><?= $inspection->inside_wall_result ?></td>
                </tr>
                <tr>
                    <td>Right Door</td>
                    <td><?= $inspection->right_door_result ?></td>
                </tr>
                <!-- Add other criteria here -->
            </table>
        </div>

        <div class="section">
            <h4>Cleaning Status</h4>
            <table class="criteria-table">
                <tr>
                    <th>Inner Cleaned</th>
                    <td><?= $inspection->inner_cleaned ? 'Yes' : 'No' ?></td>
                </tr>
                <tr>
                    <th>Outer Cleaned</th>
                    <td><?= $inspection->outer_cleaned ? 'Yes' : 'No' ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>