<?php
require_once 'navigation_bar.php';
require_once 'classes/cart.class.php';

$cartObj = new Cart();
$cartPrice = $cartObj->getCartPrice();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atsiskaitymo informacija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <div class="container border py-5">
        <div class="d-flex justify-content-center gx-5" style="padding: 5px;">
            <div class="col-lg-6 col-md-6 p-3">
                <div class="card mb-8">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Atsiskaitymo informacija</h5>
                    </div>
                    <div class="card-body">
                        <form id="shipping_Form" method="POST" action="handling/shipping.han.php">

                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form7Example1" class="form-control" name="user_first_name" value="Vainius"/>
                                        <label class="form-label" for="form7Example1">Vardas</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form7Example2" class="form-control" name="user_last_name" value="Daraškevičius"/>
                                        <label class="form-label" for="form7Example2">Pavardė</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="email" id="form7Example5" class="form-control" name="user_email" value="vainius.daraskevicius@gmail.com"/>
                                <label class="form-label" for="form7Example5">Elektroninis paštas</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="form7Example3" class="form-control" name="user_city" value="Vilnius" />
                                <label class="form-label" for="form7Example3">Miestas</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="form7Example4" class="form-control" name="user_home_address" value="Verkiu g. 45" />
                                <label class="form-label" for="form7Example4">Namų adresas</label>
                            </div>


                            <div class="form-outline mb-4">
                                <input type="number" id="form7Example6" class="form-control" name="user_phone_number" value="8612312323" />
                                <label class="form-label" for="form7Example6">Telefono numeris</label>
                            </div>

                            <!-- <div class="form-outline mb-4">
                                <textarea class="form-control" id="form7Example7" rows="4"></textarea>
                                <label class="form-label" for="form7Example7">Additional information</label>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 p-3">
                    <div class="card mb-3">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Suvestinė</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Prekių kaina
                                    <span><?php echo $cartPrice; ?> €</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Siuntimas
                                    <span>DPD</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Galutinė kaina</strong>
                                    </div>
                                    <span><strong><?php echo $cartPrice; ?> €</strong></span>
                                </li>
                            </ul>
                            <button type="submit" form="shipping_Form" class="btn btn-primary btn-lg btn-block" name="confirm_payment">
                                Apmokėti
                            </button>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</body>

</html>