<?php
session_start(); 


if (!isset($_SESSION['user_name'])) {

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Participation Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #3a3a3a;
            color: white;
            padding: 20px;
            text-align: center;
        }
        select, button, input {
            padding: 10px;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .account-info {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #3a3a3a;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>College Participation Data</h1>
        <p>Select a category to view the data and search for a college.</p>
    </header>


    <div class="account-info">
        <p>Welcome, <?php echo $_SESSION['user_name']; ?>!</p>
        <a href="account.php" style="color: white;">Account</a> | <a href="logout.php" style="color: white;">Logout</a>
    </div>

    <div class="container">

        <div class="form-group">
            <select id="category-select" class="form-control">
                <option value="allAgriculture.json">Agriculture</option>
                <option value="architecture_participated.json">Architecture</option>
                <option value="college_participated.json">College</option>
                <option value="dental_participated.json">Dental</option>
                <option value="engineering_participated.json">Engineering</option>
                <option value="law_participated.json">Law</option>
                <option value="management_participated.json">Management</option>
                <option value="medical_participated.json">Medical</option>
                <option value="pharmacy_participated.json">Pharmacy</option>
                <option value="overall_participated.json">Overall</option>
            </select>
            <button onclick="loadData()" class="btn btn-primary btn-block">Load Data</button>
        </div>

   
        <div class="search-container">
            <input type="text" id="search-input" class="form-control" placeholder="Search for a college..." onkeyup="searchData()">
            <button onclick="searchData()" class="btn btn-primary btn-block">Search</button>
        </div>

 
        <div class="table-responsive">
            <table id="data-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Website</th>
                    </tr>
                </thead>
                <tbody id="data-list">
                  
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let allData = []; 

        function loadData() {
            const category = document.getElementById('category-select').value;  

       
            const filePath = 'data/' + category; 

            fetch(filePath) 
                .then(response => response.json())  
                .then(data => {
                    allData = data;  
                    renderData(data);  
                })
                .catch(error => {
                    console.error('Error fetching the JSON file:', error);
                    alert('Failed to load data. Please try again later.');
                });
        }

        function renderData(data) {
            const tableBody = document.getElementById('data-list');
            tableBody.innerHTML = ''; 


            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.city}</td>
                    <td>${item.state}</td>
                    <td><a href="${item.website}" target="_blank">${item.website ? item.website : 'N/A'}</a></td>
                `;
                tableBody.appendChild(row);
            });
        }


        function searchData() {
            const keyword = document.getElementById('search-input').value.toLowerCase(); 


            const filteredData = allData.filter(item => {
                return item.name.toLowerCase().includes(keyword) || 
                       item.city.toLowerCase().includes(keyword) || 
                       item.state.toLowerCase().includes(keyword);
            });

            // Render the filtered data
            renderData(filteredData);
        }


        window.onload = loadData;
    </script>
</body>
</html>
