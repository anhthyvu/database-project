<?php
    $page_title = "Query 8";
    require_once '../database.php';

    
    $Q8Id = isset($_GET['id']) ? $_GET['id'] : 0;
   
    $query = "
       

SELECT
    secondary_person.FirstName AS SecondaryFirstName,
    secondary_person.LastName AS SecondaryLastName,
    secondary_person.PhoneNumber AS SecondaryPhoneNumber,
    location.Name AS LocationName,
    cm.CMN AS ClubMembershipNumber,
    person.FirstName AS ClubMemberFirstName,
    person.LastName AS ClubMemberLastName,
    person.DateOfBirth,
    person.SSN,
    person.MedicareNumber,
    person.PhoneNumber AS ClubMemberPhoneNumber,
    person.Address,
    person.City,
    person.Province,
    person.PostalCode,
    cm.Relationship AS RelationshipToSecondaryFamilyMember

FROM FamilyMember AS fm
LEFT JOIN FamilyMember AS secondary_fm
    ON fm.AlternativeFamilyID = secondary_fm.PersonID
LEFT JOIN Person AS secondary_person
    ON secondary_fm.PersonID = secondary_person.PersonID
JOIN ClubMember AS cm
    ON cm.PrimaryFamilyID = fm.PersonID
JOIN Person AS person
    ON cm.PersonID = person.PersonID
JOIN Location AS location
    ON cm.LocationID = location.LocationID
WHERE fm.PersonID = $Q8Id

    ";

   
    $result = mysqli_query($conn, $query);
    

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

   
    
$queryName = "
Select CONCAT(Person.FirstName, ' ', Person.LastName) AS MainName
From Person
Where Person.PersonID = $Q8Id
";
    

$resultName = mysqli_query($conn, $queryName);

if (!$resultName) {
    die("Query failed: " . mysqli_error($conn));
}


$rowName = mysqli_fetch_assoc($resultName);
$mainName = $rowName['MainName'];
?>
    



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
    <h1 style="margin: 2rem 1rem;">More Detail On <?= htmlspecialchars($mainName) ?></h1>

        <!-- Location Details -->
        <div class="list-container">
            <h2>Locations</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Location Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Postal Code</th>
                    </tr>
                </thead>
                <tbody>
                <?php
            // Iterate over the result set for Locations
            mysqli_data_seek($result, 0); // Reset the pointer to the beginning
            while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['LocationName']) ?></td>
                    <td><?= htmlspecialchars($row['Address']) ?></td>
                    <td><?= htmlspecialchars($row['City']) ?></td>
                    <td><?= htmlspecialchars($row['Province']) ?></td>
                    <td><?= htmlspecialchars($row['PostalCode']) ?></td>
                </tr>
            <?php endwhile; ?>
                </tbody>
            </table>
        </div>




        <!-- Secondary Family Member Details -->
        <div class="list-container">
            <h2>Secondary Family Member</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
            // Iterate over the result set for Secondary Family Member
            mysqli_data_seek($result, 0); // Reset the pointer to the beginning
            while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['SecondaryFirstName']) ?></td>
                    <td><?= htmlspecialchars($row['SecondaryLastName']) ?></td>
                    <td><?= htmlspecialchars($row['SecondaryPhoneNumber']) ?></td>
                </tr>
            <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Club Members Details -->
        <div class="list-container">
            <h2>Club Members</h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Membership ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>SSN</th>
                        <th>Medicare Card Number</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Province</th>
                        <th>Postal Code</th>
                        <th>Relationship</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
            // Iterate over the result set for Club Members
            mysqli_data_seek($result, 0); // Reset the pointer to the beginning
            while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['ClubMembershipNumber']) ?></td>
                    <td><?= htmlspecialchars($row['ClubMemberFirstName']) ?></td>
                    <td><?= htmlspecialchars($row['ClubMemberLastName']) ?></td>
                    <td><?= htmlspecialchars($row['DateOfBirth']) ?></td>
                    <td><?= htmlspecialchars($row['SSN']) ?></td>
                    <td><?= htmlspecialchars($row['MedicareNumber']) ?></td>
                    <td><?= htmlspecialchars($row['ClubMemberPhoneNumber']) ?></td>
                    <td><?= htmlspecialchars($row['Address']) ?></td>
                    <td><?= htmlspecialchars($row['City']) ?></td>
                    <td><?= htmlspecialchars($row['Province']) ?></td>
                    <td><?= htmlspecialchars($row['PostalCode']) ?></td>
                    <td><?= htmlspecialchars($row['RelationshipToSecondaryFamilyMember']) ?></td>
                </tr>
            <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>