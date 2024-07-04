@if(session('data'))
    @php
        $data = session('data');
    @endphp
    
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>Group 16</title>
</head>
<body>

 <div class="all">
    <nav class="nav">
        <div class="nav-logo">
            <p>Group 16.</p>
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="#" class="link active">Home</a></li>
             
                <li><a href="#" class="link">About</a></li>
            </ul>
        </div>
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">Predict</button>
            <button class="btn" id="registerBtn" onclick="register()">Model Info </button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>
<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- login form -------------------------->
        <div class="login-container" id="login">
            <div class="uploadfile">
                <div class="wrapper">
                    <div class="he">Upload File</div>
                    <form action="/{{ $pathvariable }}/io" method="POST" enctype="multipart/form-data">
                        @csrf
                      <input class="file-input" type="file" name="file" hidden>
                      <i class="fas fa-cloud-upload-alt"></i>
                      <p>Browse File to Upload   
</p>

<button type="submit" class="submit-btn">Submit</button>
                    </form>


                    @if(session('data'))
                    <div class="cancer-box">
        <p id="cancer-info">Lung Cancer: {{session('data')['name']}}</p>
    </div>

@endif
      
                   
                    <section class="progress-area"></section>
                    <section class="uploaded-area"></section>
                  </div>
            </div>
            <div class="result">





                <div class="catstat">

                    <div class="catstat1">  
                        
                        <div class="catstat11">
                            <div class="circle1" role="progressbar" aria-valuenow="0" aria-live="polite">
                                <!--  you probably want a more useful message here  -->
                                
                              </div>
                            <span>Adenocarcinoma</span>
                        </div>
                        <div class="catstat12">
                            
                          <div class="circle2" role="progressbar" aria-valuenow="0" aria-live="polite">
                            <!--  you probably want a more useful message here  -->
                            
                          </div>
                            <span>Squamous Cell Carcinoma</span>
                        </div>
                        
                    
                    </div> 
                
                    <div class="catstat2">  
                        <div class="catstat21">
                           
                                <div class="circle3" role="progressbar" aria-valuenow="0" aria-live="polite">
                                    <!--  you probably want a more useful message here  -->
                                    
                                  </div>
                                
                                
                            <span>Normal</span>
                        </div>
                        <div class="catstat22">
                            <div class="circle4" role="progressbar" aria-valuenow="0" aria-live="polite">
                                <!--  you probably want a more useful message here  -->
                                
                              </div>
                            <span>Large  Cell Carcinoma</span>
                        </div>
                
                       
                         
                    </div> 
                        
                          
                          
                          
                </div>



            </div>
        </div>
        <!------------------- registration form -------------------------->
        <div class="register-container" id="register">
          <div class="info-section">
        <h2>Model Metrics</h2>
        <p>The model's metrics for a single epoch:</p>
        <div class="card-container">
            <div class="card">
                <h3>Accuracy</h3>
                <div class="chart-container">
                    <canvas id="accuracyChart"></canvas>
                </div>
            </div>
            <div class="card">
                <h3>Loss</h3>
                <div class="chart-container">
                    <canvas id="lossChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    





        </div>
    </div>
</div> 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
<script src="script.js" ></script>

<script>
   
   function myMenuFunction() {
    var i = document.getElementById("navMenu");
    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }
 
</script>
<script>
    









    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }
    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }
</script>



<?php if (isset($data['pred'])): ?>
    <!-- Pass PHP array to JavaScript if it's not empty -->
    <script>
        setTimeout(function() {
        var data = @json($data);

        // Custom iom function
        

        // Process the pred array with exactly four elements
        var percentage1 = (data.pred[0] * 100).toFixed(4);
        
        
        console.log(percentage1)

        var percentage2 = (data.pred[1] * 100).toFixed(4);
        
        console.log(percentage2)

        var percentage3 = (data.pred[2] * 100).toFixed(4);
      
        console.log(percentage3)
        var percentage4 = (data.pred[3] * 100).toFixed(4);
        
        console.log(percentage4)
        iom(percentage1,progressbar)
        iom(percentage4,progressbar1)
        iom(percentage3,progressbar2)
        iom(percentage2,progressbar3)
        },2000);
    </script>

<?php endif; ?>
    
</body>
</html>