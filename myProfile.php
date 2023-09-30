<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Profile | Gimmick</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css" />
 


    <link rel="icon" href="resources/logos/logo.gif "/>


   

</head>

<body>

    <div class="container-fluid">
  
        <div class="row">

            <?php include "headerTop.php"; ?>
            <div class="row">
        
        <nav aria-label="breadcrumb" style="margin-left:1%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">My Profile</li>
  </ol>
</nav>
        

    </div>

            <?php

            //require "connection.php";

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                // $details_rs = Database::search("SELECT * FROM `users` INNER JOIN `profile_image` ON
                // users.email=profile_image.users_email INNER JOIN `user_has_address` ON 
                // users.email=user_has_address.users_email INNER JOIN `city` ON 
                // user_has_address.city_id=city.id INNER JOIN `district` ON 
                // city.district_id=district.id INNER JOIN `province` ON 
                // district.province_id=province.id INNER JOIN `gender` ON 
                // gender.id=users.gender_id WHERE `email`='".$email."'");

                $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON 
                `gender`.`id`=`user`.`gender_id` WHERE `email`='" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
                user_has_address.city_id=city.id INNER JOIN `district` ON 
                city.district_id=district.id INNER JOIN `province` ON 
                district.province_id=province.id WHERE `user_email`='" . $email . "'");

                $details = $details_rs->fetch_assoc();
                $image_details = $image_rs->fetch_assoc();
                $address_details = $address_rs->fetch_assoc();

            ?>

                <div class="col-12" style="background-color:navy">
                    <div class="row">

                        <div class="col-12 bg-body rounded mt-4 mb-4">
                            <div class="row g-2">

                                <div class="col-md-3 border-end">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                        <?php

                                        if (empty($image_details["path"])) {
                                        ?>
                                            <img src="resources/newuser.png" class="rounded mt-5" style="width: 150px;" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $image_details["path"]; ?>" class="rounded mt-5" style="width: 150px;" />
                                        <?php
                                        }

                                        ?>


                                        <span class="fw-bold"><?php echo $details["fname"] . " " . $details["lname"]; ?></span>
                                        <span class="fw-bold text-black-50"><?php echo $email; ?></span>

                                        <input type="file" class="d-none" id="profileimage" />
                                        <label for="profileimage" class="btn mt-5" style="background-color: navy; color:white">Update Profile Image</label>

                                    </div>
                                </div>

                                <div class="col-md-5 border-end">
                                    <div class="p-3 py-5">

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold">Profile Settings</h4>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-6">
                                                <label class="form-label">First Name</label>
                                                <input type="text" class="form-control" value="<?php echo $details["fname"]; ?>" id="profilefname"/>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" value="<?php echo $details["lname"]; ?>" id="profilelname"/>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Mobile</label>
                                                <input type="text" class="form-control" value="<?php echo $details["mobile"]; ?>" id="profilemob"/>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" value="<?php echo $details["password"]; ?>" readonly />
                                                    <span class="input-group-text bg-primary" id="basic-addon2">
                                                        <i class="bi bi-eye-slash-fill text-white"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $details["email"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Registered Date</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $details["joined_date"]; ?>" />
                                            </div>

                                            <?php

                                            if (!empty($address_details["line1"])) {

                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" class="form-control" value="<?php echo $address_details["line1"]; ?>" id="profileadd1"/>
                                                </div>
                                            <?php

                                            } else {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" class="form-control"  />
                                                </div>
                                            <?php
                                            }

                                            if (!empty($address_details["line2"])) {

                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" class="form-control" value="<?php echo $address_details["line2"]; ?>" id="profileadd2"/>
                                                </div>
                                            <?php

                                            } else {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" class="form-control" />
                                                </div>
                                            <?php
                                            }

                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");

                                            ?>

                                            <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select" id="profileProvince">
                                                    <option value="0">Select Province</option>
                                                    <?php
                                                    $province_num = $province_rs->num_rows;
                                                    for ($x = 0; $x < $province_num; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["id"]; ?>
                                                        " <?php
                                                            if (!empty($address_details["province_id"])) {
                                                                if ($province_data["id"] == $address_details["province_id"]) {
                                                            ?>selected<?php
                                                                    }
                                                                }
                                                                        ?>><?php echo $province_data["name"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">District</label>
                                                <select class="form-select" id="profileDistrict">
                                                    <option value="0">Select District</option>
                                                    <?php
                                                    $district_num = $district_rs->num_rows;
                                                    for ($x = 0; $x < $district_num; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $district_data["id"]; ?>
                                                        " <?php
                                                            if (!empty($address_details["district_id"])) {
                                                                if ($district_data["id"] == $address_details["district_id"]) {
                                                            ?>selected<?php
                                                                    }
                                                                }
                                                                        ?>><?php echo $district_data["name"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">City</label>
                                                <select class="form-select" id="profileCity">
                                                    <option value="">Select City</option>
                                                    <?php
                                                    $city_num = $city_rs->num_rows;
                                                    for ($x = 0; $x < $city_num; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["id"]; ?>
                                                        " <?php
                                                            if (!empty($address_details["city_id"])) {
                                                                if ($city_data["id"] == $address_details["city_id"]) {
                                                            ?>selected<?php
                                                                    }
                                                                }
                                                                        ?>><?php echo $city_data["name"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                      
                                            <?php
                                            

                                            if (!empty($details["gender_id"])) {
                                                $g=Database::search("SELECT * FROM `gender` WHERE `id`='".$details["gender_id"]."'");
                                                $g_data=$g->fetch_assoc();
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Gender</label>
                                                    <input type="text" class="form-control" placeholder="<?php echo $g_data["name"]?>" readonly />
                                                </div>
                                            <?php

                                            } else {
                                            ?>
                                                <div class="col-12">
                                                    <label class="form-label">Gender</label>
                                                    <input type="text" class="form-control" readonly />
                                                </div>
                                            <?php
                                            }
                                            ?>





                                            <div class="col-12 d-grid mt-2">
                                                <button class="btn" style="background-color:navy; color:white" onclick="updateMyProfile();">Update My Profile</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4 text-center">
                                    <div class="row mt-2">
                                        <img src="resources\promotion3.png" />
                                    </div>
                                    <div class="row mt-3">
                                        <img src="resources\promotion1.png"/>
                                    </div>
                                    <div class="row mt-3">
                                        <img src="resources\promotion2.webp" />
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            <?php

            } else {

                include "midlogin.php";
            }

            ?>



            <?php include "footer.php"; ?>

        </div>
    </div>

   
    <script src="script.js"></script>
</body>

</html>