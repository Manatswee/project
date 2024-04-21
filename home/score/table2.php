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
        <h1><br>Production</h1>
        <div class="table-widget">

            <table>
                <!-- <caption>
                Score
                <span class="table-row-count"></span>
            </caption> -->
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Units</th>
                        <th>word1</th>
                        <th>word2</th>
                        <th>word3</th>
                        <th>word4</th>
                        <th>Score</th>
                        <th>Date Time</th>
                    </tr>
                </thead>
                <tbody id="productionTable">
                    <!-- Rows will be generated here -->
                </tbody>
                <!-- <tbody id="team-member-rows">
                    
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <ul class="pagination">
                                

                            </ul>
                        </td>
                    </tr>
                </tfoot> -->
            </table>
        </div>


    </div>
    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const name = urlParams.get('name');
        console.log(name);

        const apiUrl_score_production = 'http://localhost/Projesct15/api/api-scoreproduction';
        fetch(apiUrl_score_production)
            .then(response => {
                if (response.status === 200) {
                    console.log('get data apiUrl_score_production successfully');
                    return response.json();
                } else {
                    throw new Error('get data apiUrl_score_production successfully failed');
                }
            })
            .then(data => {
                displayDataProduction(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });

        function displayDataProduction(data) {
            const tableBody = document.getElementById('productionTable');
            data.forEach(item => {
                if (item.username === name) {
                    console.log(item);
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.username}</td>
                        <td>${item.unit}</td>
                        <td>${item.word_1}</td>
                        <td>${item.word_2}</td>
                        <td>${item.word_3}</td>
                        <td>${item.word_4}</td>
                        <td>${item.score}</td>
                        <td>${item.productionComplete}</td>   
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
    <!-- <script src="table1.css"></script> -->
</body>

</html>