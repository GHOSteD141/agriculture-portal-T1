<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="assets/img/logo.png" />
  <title>Agriculture Portal - Modern Farming Solutions</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
  
  <!-- Modern Glassmorphism CSS -->
  <link rel="stylesheet" href="assets/css/modern-glassmorphism.css" type="text/css">
</head>

<body class="bg-white" id="top">
  <!-- Modern Navigation -->
  <nav class="navbar navbar-main navbar-expand-lg navbar-light position-sticky top-0 py-0" style="z-index: 1000;">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <i class="fas fa-leaf"></i> AgriPortal
      </a>
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="contact.php">
              <i class="fas fa-envelope"></i> Contact
            </a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
              <i class="fas fa-user-plus"></i> Sign Up
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="farmer/fregister.php">🌾 Farmer</a>
              <a class="dropdown-item" href="customer/cregister.php">🛒 Customer</a>
            </div>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
              <i class="fas fa-sign-in-alt"></i> Login
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="farmer/flogin.php">🌾 Farmer</a>
              <a class="dropdown-item" href="customer/clogin.php">🛒 Customer</a>
              <a class="dropdown-item" href="admin/alogin.php">⚙️ Admin</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="container">
    <div class="hero mt-4" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.6), rgba(5, 150, 105, 0.4)), 
                                                     linear-gradient(to right, rgba(52, 211, 153, 0.3), transparent);">
      <div class="hero-content">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <span class="badge mb-3">Welcome to Modern Agriculture</span>
            <h1 class="display-3" style="font-weight: 800; color: white; margin-bottom: 1.5rem;">
              🌾 Your True Farmer's Friend
            </h1>
            <p class="lead" style="color: rgba(255, 255, 255, 0.95); line-height: 1.8; margin-bottom: 2rem;">
              Connect farmers and customers directly. Trade crops, get predictions, and grow your business with cutting-edge agricultural technology.
            </p>
            <div>
              <a href="farmer/fregister.php" class="btn btn-primary btn-lg mr-3">
                Get Started as Farmer
              </a>
              <a href="customer/cregister.php" class="btn btn-outline-primary btn-lg" style="border-color: white; color: white;">
                Browse as Customer
              </a>
            </div>
          </div>
          <div class="col-lg-6 text-center" style="display: flex; align-items: center; justify-content: center;">
            <div style="font-size: 5rem; animation: float 3s ease-in-out infinite;">🌱</div>
          </div>
        </div>
      </div>
    </div>
  </div>
              <div class="cg">
                <div class="card card-body bg-gradient-success">
                  <blockquote cite="blockquote">
                    <h6 class="mb-0 text-dark">
                      <em><b  id="quote"> “Farming looks mighty easy when your plow is a pencil, and you're a thousand miles from the corn field..”</b ></em>
                    </h6>
                    <br />

                    <footer class="blockquote-footer vg text-dark"  >
                      <span id="author"> DWIGHT D. EISENHOWER	</span>	
					<button id="sendButton" class="btn btn-sm btn-outline-secondary pull-right mx-auto mr-auto bg-gradient-danger" onclick="myFunction()">
					  <i class="fa fa-refresh text-white"></i>
					</button>					  
                    </footer>				
                  </blockquote>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-3 offset-sm-2 align-self-center">
              <img src="assets/img/plant-bulb.png" class="img-fluid" alt="" />
            </div>
          </div>
        </div>
      </header>
<!-- Page Content -->

<!-- ======================================================================================================================================== -->

    <div class="section features-6 text-dark bg-white" id="services">
      <div class="container ">

        <div class="row">
                <div class="col-md-8 mx-auto text-center">
                    <span class="badge badge-primary badge-pill mb-3">Insight</span>
                    <h3 class="display-3 ">Features</h3>
                </div>
            </div>
			<br>
        <div class="row align-items-center">
		
          <div class="col-lg-6">
            <div class="info info-horizontal info-hover-success">
              <div class="description pl-4">
                <h3 class="title" >Farmers</h3>
           <p class=" ">Farmers can get recommendations for crop n fertilizer and even 
            predict the weather and get the news related to agriculture. Farmers can directly sell the crops to the customers.</p>
                        
              </div>
            </div>

          </div>
		  
		  
          <div class="col-lg-6 col-10 mx-md-auto d-none d-md-block">
            <img class="ml-lg-5  pull-right" src="assets/img/agri.png" width="100%">
          </div>
        </div>
		
		
		        <div class="row align-items-center">
				  <div class="col-lg-6 col-10 mx-md-auto d-none d-md-block">
            <img class="ml-lg-5" src="assets/img/customers.png" width="80%">
          </div>
     
		
		
          <div class="col-lg-6">
			
            <div class="info info-horizontal info-hover-warning mt-5">
              <div class="description pl-4">
                <h3 class="title">Customers</h3>
                <p class=" ">Customers can buy crops directly from the faarmers without the involvement of any middlemen.</p>
              </div>
            </div>
      
      <div class="grid grid-3 mt-4">
        <!-- Feature 4: Real-time Weather -->
        <div class="feature-box">
          <div class="feature-icon">⛅</div>
          <h3>Weather Forecast</h3>
          <p>Real-time weather updates and forecasts. Plan your farming activities with accurate weather data and seasonal predictions.</p>
        </div>
        
        <!-- Feature 5: News & Updates -->
        <div class="feature-box">
          <div class="feature-icon">📰</div>
          <h3>Agriculture News</h3>
          <p>Stay updated with the latest agricultural news, market trends, and industry insights. Never miss important information affecting your business.</p>
        </div>
        
        <!-- Feature 6: Direct Trading -->
        <div class="feature-box">
          <div class="feature-icon">📊</div>
          <h3>Direct Trading</h3>
          <p>Trade crops directly between farmers and customers. Transparent pricing, secure transactions, and fair deals for everyone.</p>
        </div>
      </div>
    </div>


     
<!-- ======================================================================================================================================== -->

      <div class="section features-2 text-dark bg-white" id="features"> 
        <div class="container"> 
          <div class="row align-items-center"> 
            <div class="col-lg-5 col-md-8 mr-auto text-left"> 
              <div class="pr-md-5"> 
                <div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle mb-5"> <i class="ni ni-favourite-28"> </i></div>
                <h3 class="display-3 text-justify">Features</h3>
                <p>The time is now for the next step in farming. We bring you the future of farming along with great tools for asisting the farmers.</p>
                <ul class="list-unstyled mt-5"> 
                  <li class="py-2"> 
                    <div class="d-flex align-items-center"> 
                      <div>
                        <div class="badge badge-circle badge-primary mr-3"> <i class="ni ni-settings-gear-65"> </i></div>
                      </div>
                      <div>
                        <h6 class="mb-0">Highly Reliable and Accurate.</h6>
                      </div>
                    </div>
                  </li>
                  <li class="py-2"> 
                    <div class="d-flex align-items-center"> 
                      <div>
                        <div class="badge badge-circle badge-primary mr-3"> <i class="ni ni-html5"> </i></div>
                      </div>
                      <div>
                        <h6 class="mb-0">Faster & Responsive website.</h6>
                      </div>
                    </div>
                  </li>
                  <li class="py-2"> 
                    <div class="d-flex align-items-center"> 
                      <div>
                        <div class="badge badge-circle badge-primary mr-3"> <i class="ni ni-settings-gear-65"> </i></div>
                      </div>
                      <div>
                        <h6 class="mb-0">Real time weather forecast.</h6>
                      </div>
                    </div>
                  </li>
                  <li class="py-2"> 
                    <div class="d-flex align-items-center"> 
                      <div>
                        <div class="badge badge-circle badge-primary mr-3"> <i class="ni ni-satisfied"> </i></div>
                      </div>
                      <div>
                        <h6 class="mb-0">Integrated news feature.</h6>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
			

		  
            <div class="col-lg-7 col-md-12 pl-md-0"> 
 <img class="img-fluid ml-lg-5" src="assets/img/features.png" width="100%">
 </div>
			
			
          </div>
        </div>
        <span > </span>
      </div>
     
	<!-- ======================================================================================================================================== -->
 
	 

 <div class="section features-6 text-dark bg-white" id="tech">
        <div class="container-fluid shado">

            <div class="row">
                <div class="col-md-8 mx-auto text-center">
                    <span class="badge badge-primary badge-pill mb-3">stack</span>
                    <h3 class="display-3 ">Technologies Used</h3>
                    <p class="" >Our Development Stack</p>
                </div>
            </div>

            <div class="row text-lg-center align-self-center">

                  <div class="col-md-4">
                    <div class="info">
                    <img class=" img-fluid" src="assets/img/html.png" alt="HTML5">                       
                        <h6 class="info-title text-uppercase text-primary">HTML5</h6>
                    </div>
                </div>

               <div class="col-md-4">
                    <div class="info">
                    <img class=" img-fluid" src="assets/img/css3.png" alt="CSS3">                       
                        <h6 class="info-title text-uppercase text-primary">CSS3</h6>
                    </div>
                </div>

               <div class="col-md-4">
                    <div class="info">
                    <img class=" img-fluid" src="assets/img/js.png" alt="JavaScript">                       
                        <h6 class="info-title text-uppercase text-primary">JavaScript</h6>
                    </div>
                </div>



</div>

<div class="row text-center ">            

                 <div class="col-md-4 d-none d-md-block">
                    <div class="info">
                    <img class=" img-fluid" src="assets/img/bootstrap.png" alt="BootStrap4">                       
                        <h6 class="info-title text-uppercase text-primary">BootStrap4</h6>
                    </div>
                </div>

                 <div class="col-md-4 d-none d-md-block">
                    <div class="info">
                    <img class=" img-fluid" src="assets/img/apache.png" alt="Apache">                       
                        <h6 class="info-title text-uppercase text-primary">Apache</h6>
                    </div>
                </div>
                
                 <div class="col-md-4 d-none d-md-block">
                    <div class="info">
                    <img class=" img-fluid" src="assets/img/mysql.png" alt="MySQL">                       
                        <h6 class="info-title text-uppercase text-primary">MySQL</h6>
                    </div>
                </div>

                
            </div>
			
			
<div class="row text-center ">            

                 <div class="col-md-4 d-none d-md-block">
                    <div class="info">
                    <img class=" img-fluid" src="assets/img/jquery.png" alt="BootStrap4">                       
                        <h6 class="info-title text-uppercase text-primary">JQUERY</h6>
                    </div>
                </div>

                 <div class="col-md-4 d-none d-md-block">
                    <div class="info">
                    <img class=" img-fluid" src="assets/img/openai2.png" alt="Apache">                       
                        <h6 class="info-title text-uppercase text-primary">OPEN AI</h6>
                    </div>
                </div>
                
                 <div class="col-md-4 d-none d-md-block">
                    <div class="info">
                    <img class=" img-fluid" src="assets/img/php2.png" alt="MySQL">                       
                        <h6 class="info-title text-uppercase text-primary">PHP</h6>
                    </div>
                </div>

                
            </div>


        </div>
    </div>

  <!-- Quote/Testimonials Section -->
  <div class="section" style="padding: 4rem 0; background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), rgba(5, 150, 105, 0.05));">
    <div class="container">
      <h2 class="section-title">Wisdom from Farmers</h2>
      
      <div class="card" style="max-width: 800px; margin: 2rem auto; text-align: center; padding: 3rem;">
        <div style="font-size: 3rem; color: var(--primary-green); margin-bottom: 1rem;">💭</div>
        <blockquote style="font-size: 1.25rem; font-style: italic; color: var(--dark-text); line-height: 1.8; margin-bottom: 1.5rem;">
          <p id="quote">"Farming looks mighty easy when your plow is a pencil, and you're a thousand miles from the corn field."</p>
        </blockquote>
        <footer style="color: var(--primary-green); font-weight: 600; font-size: 1.1rem;">
          <span id="author">— Dwight D. Eisenhower</span>
        </footer>
        <button class="btn btn-primary mt-4" onclick="myFunction()" style="margin: 0 auto;">
          <i class="fas fa-lightbulb"></i> Get New Quote
        </button>
      </div>
    </div>
  </div>

<?php require("footer.php");?>

<?php require_once(__DIR__ . '/env_config.php'); ?>
<script>

const apiKey = "<?php echo getenv('OPENAI_API_KEY'); ?>";
const chatbox = document.getElementById("quote");
const authorN = document.getElementById("author");

let messages = [];

function myFunction(){
	const msg = "give me a quote related to agriculture and farming";
    if (msg) {
        messages.push({
            "role": "user",
            "content": msg
        });
        fetchMessages();
    }
};

function fetchMessages() {
    try {
        var settings = {
            url: "https://api.openai.com/v1/chat/completions",
            method: "POST",
            timeout: 0,
            headers: {
                Authorization: "Bearer " + apiKey,
                "Content-Type": "application/json"
            },
            data: JSON.stringify({
                model: "gpt-3.5-turbo",
                messages: messages
            })
        };
        $.ajax(settings).done(function(response) {
			chatbox.innerHTML = '';  
			authorN.innerHTML = ''; 

			const message = response.choices[0].message;
            messages.push({
                "role": message.role,
                "content": message.content
            });					
            Rquote=message.content;	

			parts = Rquote.split(" - ")
			QuoteR = parts[0]
			authorName = parts[1]

			chatbox.append(QuoteR);
			authorN.append(authorName);
			
        }).fail(function(jqXHR, textStatus, errorThrown) {
			chatbox.innerHTML = '';  
			let errorMessage = 'Farming looks mighty easy when your plow is a pencil, and youre a thousand miles from the corn field.';
			chatbox.append(errorMessage);
        });
    } catch (error) {
		chatbox.innerHTML = '';  
		let errorMessage2 = 'Farming looks mighty easy when your plow is a pencil, and youre a thousand miles from the corn field.';
		chatbox.append(errorMessage2);
    }
}
 </script>

<?php include 'footer.php'; ?>

</body>

</html>