<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/history.css">
    <title>Document</title>
</head>
<body>
        <h1>Need previous prescription?</h1>
        <div class="container">
            <form action="./previous-history.php" method="GET">
                <div class="input-group">
                    <input type="search" placeholder="Search by name" name="name">
                </div>
                <div class="input-group">
                    <input type="date" name="date">
                    <button type="submit" name="search">Search</button>
                </div>
            </form>
        </div>
</body>
</html>