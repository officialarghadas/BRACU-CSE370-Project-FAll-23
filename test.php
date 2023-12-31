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
    <link rel="stylesheet" href="appointment_css_dumm.css">
    <!-- Add other necessary stylesheets or scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="frame">
        <nav>
            <a href="homepage.php"><img src="images\healthylight.png" class="logo" id="logo"></a>
            <ul>
                <li><a href="patienthistory.php">History</a></li>
                <li><a href="patientdash.php">Dashboard</a></li>
                <li><a href="appointment_dummy.php">Book an Apointment</a></li>
                <li><a href="medicine.php">Buy Medicine</a></li>
                <li><a href="patientorders.php">Orders</a></li>
            </ul>
            <div class="sidepanel">
                <a class="signup"><?php echo $_SESSION['name'] ?></a>
                <a href="cart_page.php" class="btn">Cart</a>
                <a href="logout.php" class="btn">Log out</a>
                
                <img src="images\sun.png" id="icono"/>
            </div>
        </nav>
        <!-- Your existing HTML code -->

        <form id="filterForm" action="show_test.php" method="post">
            <div class="content">
                <main class="table1">
                    <section class="filters">
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
                    <h1 class="">ADD Your DESIRED TEST TO CART</h1>
                </section>
                <section class="table__body">
                    <table id="doctorTable">
                        <thead>
                            <tr>
                                <th>Test Name</th>
                                <th>Cost</th>
                                <th>ADD</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
                    url: 'show_test.php', // Update with the correct backend URL
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        var tableBody = $('#doctorTable tbody');
                        tableBody.empty();

                        if (response && response.length > 0) {
                            $.each(response, function(index, tests) {
                                var row = $('<tr>' +
                                    '<td>' + tests['Test Name'] + '</td>' +
                                    '<td>' + tests['Cost'] + '</td>' +
                                    '<td class="tdb">' +
                                    '<a href="#" class="accept_btn" data-testcode="' + tests['Testcode'] + '">ADD To The Cart</a>' +
                                    '</td>' +
                                    '</tr>');

                                tableBody.append(row);
                            });

                            $('.accept_btn').on('click', function(event) {
                                event.preventDefault(); // Prevent the default behavior of the link

                                var Testcode = $(this).data('testcode'); // Get the 'Testcode' value from the data attribute

                                // AJAX call to add test to the cart
                                $.ajax({
                                    type: 'POST',
                                    url: 'test_table_add.php', // Replace with the file handling your database query
                                    data: { Testcode: Testcode }, // Send the 'Testcode' to the server
                                    success: function(response) {
                                        if (response === 'Added to the cart') {
                                            alert('Test added to the cart'); // Display a message
                                        } else if (response === 'Already in cart') {
                                            alert('Test is already in the cart');
                                        } else {
                                            alert('Failed to add test to the cart');
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
