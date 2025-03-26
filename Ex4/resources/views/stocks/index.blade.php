<!DOCTYPE html>
<html>
<head>
    <title>Suivi des stocks en temps réel</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <style>:root {
  --primary: #4361ee;
  --primary-light: #4895ef;
  --secondary: #3f37c9;
  --success: #4cc9f0;
  --danger: #f72585;
  --warning: #f8961e;
  --light: #f8f9fa;
  --dark: #212529;
  --gray: #6c757d;
  --border-radius: 10px; /* Augmentation du rayon des bords */
  --box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1); /* Ombre plus marquée */
  --transition: all 0.3s ease;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
  background-color: #f5f7fa;
  color: var(--dark);
  line-height: 1.6;
  padding: 20px;
  max-width: 1200px;
  margin: 0 auto;
  font-size: 1rem; /* Taille de police par défaut ajustée */
}

/* En-tête */
header {
  margin-bottom: 40px;
  text-align: center;
}

h1 {
  color: var(--primary);
  margin-bottom: 15px;
  font-size: 3rem; /* Taille de police agrandie */
  font-weight: 600;
}

/* Conteneur du graphique */
#chart-container {
  background-color: white;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  padding: 25px;
  margin-bottom: 40px;
  transition: var(--transition);
}

#chart-container:hover {
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15); /* Ombre au survol améliorée */
}

/* Sections */
section {
  background-color: white;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  padding: 25px;
  margin-bottom: 40px;
}

h2 {
  color: var(--secondary);
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 2px solid var(--light);
  font-size: 2rem; /* Taille de police agrandie */
  font-weight: 500;
}

/* Liens et boutons */
a {
  display: inline-block;
  color: white;
  background-color: var(--primary);
  padding: 12px 18px;
  border-radius: var(--border-radius);
  text-decoration: none;
  transition: var(--transition);
  margin: 10px 0;
}

a:hover {
  background-color: var(--primary-light);
  transform: translateY(-3px); /* Effet de survol amélioré */
}

button {
  background-color: var(--danger);
  color: white;
  border: none;
  padding: 10px 15px;
  border-radius: var(--border-radius);
  cursor: pointer;
  transition: var(--transition);
}

button:hover {
  opacity: 0.8;
  transform: translateY(-3px); /* Effet de survol amélioré */
}

/* Liste des produits */
ul {
  list-style-type: none;
}

li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 18px;
  margin-bottom: 15px;
  background-color: var(--light);
  border-radius: var(--border-radius);
  transition: var(--transition);
}

li:hover {
  background-color: #e9ecef;
}

.product-info {
  flex: 1;
  font-weight: 500;
}

.product-quantity {
  background-color: var(--primary);
  color: white;
  padding: 8px 12px;
  border-radius: 20px;
  margin: 0 12px;
}

.actions {
  display: flex;
  gap: 12px;
}

/* Formulaires */
form {
  display: inline-block;
}

/* Responsive */
@media (max-width: 768px) {
  body {
    padding: 10px;
  }
  
  li {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .actions {
    margin-top: 12px;
    width: 100%;
    justify-content: space-between;
  }
  
  a, button {
    width: 48%;
    text-align: center;
  }
}
</style>

</head>
<body>
    <div id="chart-container" style="width: 100%; height: 400px;"></div>
    
    <h2>Ajouter un produit</h2>
    <a href="{{ route('stocks.create') }}">Ajouter un produit</a>
    
    <h2>Liste des produits</h2>
    <ul>
        @foreach($stocks as $stock)
            <li>
                {{ $stock->product_name }}: {{ $stock->quantity }}
                <a href="{{ route('stocks.edit', $stock->id) }}">Modifier</a>
                <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>

    <script>
      
        const pusher = new Pusher('{{ env("1b2b74186fa29af2e797") }}', {
            wsHost: window.location.hostname,
            wsPort: 6001,
            forceTLS: false,
            enabledTransports: ['ws', 'wss'],
            cluster: '{{ env("eu") }}',
        });

      
        const channel = pusher.subscribe('stocks');
        
   
        channel.bind('.App\\Events\\StockUpdated', function(data) {
        
            loadChartData();
        });

     
        function loadChartData() {
            fetch('{{ route("stocks.data") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    updateChart(data);
                })
                .catch(error => {
                    console.error('Error fetching chart data:', error);
                });
        }

     
        let chart = Highcharts.chart('chart-container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Quantité des produits en stock'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Quantité'
                }
            },
            series: [{
                name: 'Quantité',
                data: []
            }]
        });

       
        function updateChart(data) {
            const formattedData = data.map(item => {
                return {
                    name: item.name,
                    y: parseInt(item.y)
                };
            });
            chart.series[0].setData(formattedData);
        }

     


        loadChartData();
    </script>
</body>
</html>