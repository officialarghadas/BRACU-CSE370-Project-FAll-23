<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthY-Admin-Dashboard</title>
    <link rel="stylesheet" href="appointment_dummy.css">
    <!-- Add other necessary stylesheets or scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="frame">
        <nav>
            <a href="homepage.php"><img src="images\healthylight.png" class="logo" id="logo"></a>
            <ul>
                <li><a href="patienthistory.php">History</a></li>
                <li><a href="test.php">Book Tests</a></li>
                <li><a href="appointment_dummy.php">Book an Apointment</a></li>
                <li><a href="patientdash.php">Dashboard</a></li>
                <li><a href="patientorders.php">Orders</a></li>
            </ul>
            <div class="sidepanel">
                <a class="signup"><?php echo $_SESSION['name'] ?></a>
                <a href="cart_page.php" class="btn">Cart</a>
                <a href="logout.php" class="btn">Log out</a>
                
                <img src="images\sun.png" id="icono"/>
            </div>
        </nav>
        <form id="filterForm" action="show_medicine.php" method="post">
            <div class="content">
                <main class="table1">
                    <section class="filters">
                        <!-- First Dropdown -->
                        <select id="filter1" name="select1">
                            <option value="0">internal</option>
                            <option value="1">External</option>
                        </select>

                        <!-- Second Dropdown -->
                        <select id="filter2" name="select2">
                            <option value="1">Cream</option>
                            <option value="2">Gel</option>
                            <option value="3">tablet</option>
                        </select>

                        <!-- Search Input -->
                        <input type="text" id="search" name="search" class="search-input" placeholder="Search...">

                        <!-- Button for search/filter action -->
                        <button type="submit" id="searchBtn">Search</button>
                    </section>
                </main>
            </div>
        </form>

        <div class="content">
            <main class="table">
                <section class="table__header">
                    <h1 class="">Available Medicines </h1>
                </section>
                <section class="table__body">
                    <table id="doctorTable">
                        <thead>
                            <tr >
                                <th>Medicine Name</th>
                                <th>Cost</th>
                                
                                <th>ADD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // This part should be replaced with an AJAX call in a separate script
                                // You cannot use PHP directly inside JavaScript
                            ?>
                        </tbody>
                    </table>
                </section>
            </main>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#filterForm').on('submit', function(event) {
                event.preventDefault(); // Prevent form submission

                var formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    type: 'POST',
                    url: 'show_medicine.php',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        var tableBody = $('#doctorTable tbody');
                        tableBody.empty();
                        

                        if (response && response.length > 0) {
                            $.each(response, function(index, medicine) {
                                var row = $('<tr>' +
                                '<td>' + medicine['Medicine Name'] + '</td>' +
                                '<td>' + medicine['Cost'] + '</td>' +
                                
                                
                                '<td class="tdb">' +
                                '<a href="#" class="accept_btn" data-medcode="' + medicine['Medcode'] + '">ADD To The Cart</a>' +
                                // '<a href="add_slot.php?id=' + medicine['Medcode'] + '" class="accept_btn">ADD To The Cart</a>' +
                                '</td>' +
                                '</tr>');
                                // row.attr('data-href', 'appointment_details_html.php?id=' + );

                                // // Make each row clickable
                                // row.addClass('clickable-row');
                                tableBody.append(row);
                                // tableBody.append(row);
                            });
                            $('.accept_btn').on('click', function(event) {
                            event.preventDefault(); // Prevent the default behavior of the link

                            var medCode = $(this).data('medcode'); // Get the 'Medcode' value from the data attribute

                            // AJAX call to perform the query without leaving the page
                            $.ajax({
                                type: 'POST',
                                url: 'medicine_table_add.php', // Replace with the file handling your database query
                                data: { medCode: medCode }, // Send the 'Medcode' to the server
                                success: function(response) {
                                    if (response === 'Added to the cart') {
                                        alert('Medicine added to the cart'); // Display a message
                                    } else {
                                        alert('Failed to add medicine to the cart');
                                    }
                                    // Handle the success response here
                                    console.log('Query successful');
                                },
                                error: function(xhr, status, error) {
                                    // Handle any errors that occur during the AJAX call
                                    console.error(error);
                                }
                            });
                        });
                        } else {
                            tableBody.append('<tr><td colspan="3">No data found</td></tr>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    
</body>
</html>
