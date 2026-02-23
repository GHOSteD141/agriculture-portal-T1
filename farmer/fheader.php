<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="../assets/img/logo.png" />
  <title>Agriculture Portal - Farmer</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
  
  <!-- Data Tables -->  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  
  <!-- Modern Glassmorphism CSS -->
  <link rel="stylesheet" href="../assets/css/modern-glassmorphism.css" type="text/css">
  
  <!-- Creative Tim CSS (for backward compatibility) -->
  <link rel="stylesheet" href="../assets/css/creativetim.min.css" type="text/css">

  <script src="../assets/js/state_district_crops_dropdown.js"></script>

  <!-- Environment-based API Configuration -->
  <?php require_once("../env_config.php"); ?>

  <script>
    // Load news using environment variable
    const newsApiKey = "<?php echo getenv('NEWS_API_KEY'); ?>";
    
    window.addEventListener("load", function() {
      const endpoint = "https://newsapi.org/v2/everything?q=farmers&sortBy=popularity&apiKey=" + newsApiKey;
      fetch(endpoint)
        .then(response => {
          if (!response.ok) throw new Error("Network response was not ok");
          return response.json();
        })
        .then(data => console.log(data))
        .catch(error => console.error("Error fetching news:", error));
    });
  </script>
</head>