<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Hospitalar</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Dashboard do Hospital</h1>
    <p>Total de Pacientes: <?php echo $totalPatients; ?></p>
    <p>Total de Internações: <?php echo $totalAdmissions; ?></p>
    
    <label for="startDate">Data Início:</label>
    <input type="date" id="startDate">
    <label for="endDate">Data Fim:</label>
    <input type="date" id="endDate">
    <button onclick="updateChart()">Filtrar</button>
    
    <canvas id="admissionsChart"></canvas>
    <script>
        var ctx = document.getElementById('admissionsChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Internações por Departamento',
                    data: [],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                }]
            }
        });

        function updateChart() {
            var startDate = document.getElementById('startDate').value;
            var endDate = document.getElementById('endDate').value;
            
            $.ajax({
                url: 'dashboard/fetchDynamicData',
                type: 'POST',
                data: { startDate: startDate, endDate: endDate },
                dataType: 'json',
                success: function(response) {
                    var labels = response.map(item => item.department);
                    var data = response.map(item => item.total);
                    
                    chart.data.labels = labels;
                    chart.data.datasets[0].data = data;
                    chart.update();
                }
            });
        }
    </script>
</body>
</html>