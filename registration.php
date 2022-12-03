<?php 
include_once 'navigation_bar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

</head>
<body>
    
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-80">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Registracija</h2>
              <p class="text-white-50 mb-5">Užpildykite anketą, norėdami prisiregistruoti!</p>
              <form action="handling/registration.han.php" method="POST">
                <div class="form-outline form-white mb-4">
                  <input type="text" id="typeEmailX" class="form-control form-control-lg" name="username" />
                  <label class="form-label" for="typeEmailX">Naudotojo vardas</label>
                </div>
  
                <div class="form-outline form-white mb-4">
                  <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" />
                  <label class="form-label" for="typeEmailX">Elektroninis paštas</label>
                </div>
  
                <div class="form-outline form-white mb-4">
                  <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" />
                  <label class="form-label" for="typePasswordX">Slaptažodis</label>
                </div>
  
                <div class="form-outline form-white mb-4">
                  <input type="password" id="typePasswordX" class="form-control form-control-lg" name="repeatPassword"/>
                  <label class="form-label" for="typePasswordX">Pakartokite slaptažodį</label>
                </div>
  
                <!-- <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p> -->
  
                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="submitRegistration">Prisiregistruoti</button>
              </form>

            </div>

            <div>
              <p class="mb-0">Jau turite paskyrą?<a href="login.php" class="text-white-50 fw-bold">Prisijunkite čia!</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>