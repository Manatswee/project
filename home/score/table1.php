<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Web Application for Developing English Language Skills.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table2.css">
</head>

<body>
    <div class="background">
        <h1><br>Practice</h1>
        <div class="table-widget">

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Units</th>
                        <th>Score</th>
                        <!-- <th>Units2</th>
                        <th>Units3</th>
                        <th>Units4</th> -->
                        <th>Date Time</th>
                    </tr>
                </thead>
                <tbody id="practiceTable">
                    <!-- Rows will be generated here -->
                </tbody>
            </table>
        </div>
    </div>
    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const name = urlParams.get('name');
        console.log(name);

        const apiUrl_score_practice = 'http://localhost/Projesct15/api/api-scorepractice';
        fetch(apiUrl_score_practice)
            .then(response => {
                if (response.status === 200) {
                    console.log('get data apiUrl_score_practice successfully');
                    return response.json();
                } else {
                    throw new Error('get data apiUrl_score_practice successfully failed');
                }
            })
            .then(data => {
                displayDataPractice(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });

        function displayDataPractice(data) {
            const tableBody = document.getElementById('practiceTable');
            data.forEach(item => {
                if (item.username === name) {
                    console.log(item);
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.username}</td>
                        <td>${item.unit}</td>
                        <td>${item.score}</td>
                        <td>${item.unitTestComplete}</td>   
                    `;
                    tableBody.appendChild(row);
                }
            });
        }
    </script>

    <footer>
        <ul class="pagination">
            <!-- Generated pages -->
        </ul>
    </footer>
</body>

</html>