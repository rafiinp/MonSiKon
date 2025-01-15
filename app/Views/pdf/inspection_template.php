<!DOCTYPE html>
<html>
<head>
    <title>Inspection Reports</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Inspection Reports</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Container</th>
                <th>Date</th>
                <th>Status</th>
                <th>Surveyor</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inspections as $index => $inspection): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $inspection->container_number ?></td>
                <td><?= $inspection->inspection_date ?></td>
                <td><?= $inspection->status ?></td>
                <td><?= $inspection->surveyor_name ?></td>
                <td><?= $inspection->result ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>