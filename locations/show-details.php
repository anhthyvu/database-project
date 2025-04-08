<?php
    $page_title = "Query 9";
    require_once '../database.php';

    $Q9Id = isset($_GET['id']) ? $_GET['id'] : 0;
   
    $query = "SELECT 
    L.LocationID,
    L.Address,
    L.City,
    L.Province,
    L.PostalCode,
    L.PhoneNumber,
    L.Website,
    L.Type,
    L.Capacity,
    CONCAT(P.FirstName, ' ', P.LastName) AS GeneralManager,
    COUNT(CM.CMN) AS ClubMemberCount
FROM Location L
LEFT JOIN Contract C 
    ON L.LocationID = C.LocationID AND C.Role = 'Head Coach'
LEFT JOIN Personnel PR ON C.EmployeeID = PR.EmployeeID
LEFT JOIN Person P ON PR.EmployeeID = P.PersonID
LEFT JOIN ClubMember CM ON L.LocationID = CM.LocationID
WHERE L.LocationID = $Q9Id
GROUP BY 
    L.LocationID, L.Address, L.City, L.Province, L.PostalCode, 
    L.PhoneNumber, L.Website, L.Type, L.Capacity, P.FirstName, P.LastName
ORDER BY 
    L.Province ASC,
    L.City ASC;
";

    
    $result = mysqli_query($conn, $query);
    

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

   
    
        // fething the location name for the title
        $locationQuery = "SELECT Name FROM Location WHERE LocationID = ?";
        $stmt = mysqli_prepare($conn, $locationQuery);
        mysqli_stmt_bind_param($stmt, 'i', $Q9Id);
        mysqli_stmt_execute($stmt);
        $locationResult = mysqli_stmt_get_result($stmt);
        
        if ($locationResult && mysqli_num_rows($locationResult) > 0) {
            $locationData = mysqli_fetch_assoc($locationResult);
            $LocationName = $locationData['Name'];
        } else {
            $LocationName = "Unknown Location";
        }

        mysqli_data_seek($result, 0);

?>

<head>
    <title><?= $page_title ?></title>
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/global.css">
</head>
<body>
    <!-- Navbar Section -->
    <nav>
        <h2>MYVC Management System</h2>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../clubMembers/index.php">Club Members</a></li>
            <li><a href="../familyMembers/index.php">Family Members</a></li>
            <li><a href="../personnels/index.php">Personnel</a></li>
            <li><a href="../locations/index.php">Locations</a></li>
            <li><a href="../teamFormations/index.php">Team Formation</a></li>
            <li><a href="../emailLog/index.php">Email Logs</a></li>

            <!-- Reports Dropdown -->
            <li class="dropdown">
                <a href="#">Queries</a>
                <ul class="dropdown-content">
                    <li><a href="../queries/query9.php">Query 9</a></li>
                    <li><a href="../queries/query10.php">Query 10</a></li>
                    <li><a href="../queries/query11.php">Query 11</a></li>
                    <li><a href="../queries/query12.php">Query 12</a></li>
                    <li><a href="../queries/query13.php">Query 13</a></li>
                    <li><a href="../queries/query14.php">Query 14</a></li>
                    <li><a href="../queries/query15.php">Query 15</a></li>
                    <li><a href="../queries/query16.php">Query 16</a></li>
                    <li><a href="../queries/query17.php">Query 17</a></li>
                    <li><a href="../queries/query18.php">Query 18</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Main Section -->
    <main>
        <div class="list-container">
            <h2>Location Details</h2>
            <h3>Location Name: <?= htmlspecialchars($LocationName) ?></h3>
            <h3>Location ID: <?= htmlspecialchars($Q9Id) ?></h3>
            <button class="add-btn" onclick="window.location.href='add-player.php?id=<?= $_GET['id'] ?>'">Add Player</button>
            <table class="data-table">
    <thead>
        <tr>
            <th>Location ID</th>
            <th>Address</th>
            <th>City</th>
            <th>Province</th>
            <th>Postal Code</th>
            <th>Phone Number</th>
            <th>Website</th>
            <th>Type</th>
            <th>Capacity</th>
            <th>General Manager</th>
            <th>Club Member Count</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['LocationID']) ?></td>
                <td><?= htmlspecialchars($row['Address']) ?></td>
                <td><?= htmlspecialchars($row['City']) ?></td>
                <td><?= htmlspecialchars($row['Province']) ?></td>
                <td><?= htmlspecialchars($row['PostalCode']) ?></td>
                <td><?= htmlspecialchars($row['PhoneNumber']) ?></td>
                <td><?= htmlspecialchars($row['Website']) ?></td>
                <td><?= htmlspecialchars($row['Type']) ?></td>
                <td><?= htmlspecialchars($row['Capacity']) ?></td>
                <td><?= htmlspecialchars($row['GeneralManager']) ?></td>
                <td><?= htmlspecialchars($row['ClubMemberCount']) ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
        </div>
    </main>
</body>