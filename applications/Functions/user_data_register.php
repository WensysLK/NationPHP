<?php
   include ('../../includes/db_config.php');
    
   if(isset($_POST['submit'])){
   
      $ctitle = $_POST['name-title'];
      $cfname = $_POST['Cfname'];
      $cmname = $_POST['cmname'];
      $claname = $_POST['clname'];
      $cphone = $_POST['cphone'];
      $cphone2 = $_POST['cphone2'];
      $landphon = $_POST['clphone'];
      $cdobirth = $_POST['dateofbirth'];
      $cpassport = $_POST['cpassport'];
      $cFFno = $_POST['cffileno'];
      $cpassexp = $_POST['cpassportdate'];
      $cemail = $_POST['cemail'];
      $caddress1 = $_POST['caddress1'];
      $caddress2 = $_POST['caddress2'];
      $ccity = $_POST['ccity'];
      $cprovince = $_POST['cprovince'];
      $gsdivision = $_POST['gsdevision'];
      $expiredate = date('Y-m-d', strtotime($cpassexp . ' +6 months'));
      $gender = $_POST['gender'];
      $religeon = $_POST['Religion'];
      $maritalstatus = $_POST['maritalstatus'];
      $height = $_POST['height'];
      $weight = $_POST['weight'];
      $nationality = $_POST['nationality'];
      $nicnumber = $_POST['nicnumber'];
      $howfoundus = $_POST['findUs'];
      $subagent =  isset($_POST['subAgentName']) ? $_POST['subAgentName'] : '';
      $lastInsertId = $_POST['currentapplicationid'];
      $fatherName = $_POST['fatherName'];
      $fatherdob = $_POST['fatherDOB'];
      $fatherContact = $_POST['fatherContactNumber'];
      $fatherNicNo = $_POST['fatherNIC'];
      $motherName = $_POST['MothertName'];
      $motherdob = $_POST['motherDOB'];
      $motherContact = $_POST['motherContactNumber'];
      $motherNicNo = $_POST['motherNIC'];
      


      // Check if a file named 'profileImage' was uploaded
if(isset($_FILES['profileImage']['name'])) {
   // Get the details of the uploaded image
   $cprofile_tem = $_FILES['profileImage']['name'];
   $temext =  explode('.',$cprofile_tem);

   // Check if an image was selected
   if($cprofile_tem != "") {
       $ext = end($temext);

       // Generate a new image name
       // Example: ProfileJohn-1234.png (assuming $cfname is defined somewhere)
       $cprofile_tem = "Profile".$cfname."-".rand(0000,9999).".". $ext;

       $src = $_FILES['profileImage']['tmp_name']; // Temporary file path
       $dst = '../img/profile/'.$cprofile_tem; // Destination path where image will be saved

       // Move the uploaded file to the destination directory
       $upload = move_uploaded_file($src, $dst);

   }
}else{
        $cprofile_tem = "";
    }
      

     // check if father Nic back Copies Uploaded
     if(isset($_FILES['fatherNICbackcopy']['name'])) {
        // Get the details of the uploaded image
        $fathernicback_tem = $_FILES['fatherNICbackcopy']['name'];
        $temextfatherbc =  explode('.', $fathernicback_tem);
     
        // Check if an image was selected
        if( $fathernicback_tem != "") {
            $extfatherbc = end($temextfatherbc);
     
            // Generate a new image name
            // Example: ProfileJohn-1234.png (assuming $cfname is defined somewhere)
            $fathernicback_tem = "fatherNICback-".$cfname."-".rand(0000,9999).".". $extfatherbc;
     
            $srcfatherbc = $_FILES['fatherNICbackcopy']['tmp_name']; // Temporary file path
            $dstfatherNicbc = '../img/NIC/'.$fathernicback_tem; // Destination path where image will be saved
     
            // Move the uploaded file to the destination directory
            $uploadfatherbc = move_uploaded_file($srcfatherbc, $dstfatherNicbc);
     
     } 
    }else{
        $fathernicback_tem = "";
    }

    // check if father Nic front Copies Uploaded
    if(isset($_FILES['fatherNICfrontcopy']['name'])) {
        // Get the details of the uploaded image
        $fathernicfront_tem = $_FILES['fatherNICfrontcopy']['name'];
        $temextfatherfc =  explode('.', $fathernicfront_tem);
     
        // Check if an image was selected
        if( $fathernicfront_tem != "") {
            $extfatherfc = end($temextfatherfc);
     
            // Generate a new image name
            // Example: ProfileJohn-1234.png (assuming $cfname is defined somewhere)
            $fathernicfront_tem = "fatherNICfront-".$cfname."-".rand(0000,9999).".". $extfatherfc;
     
            $srcfatherfc = $_FILES['fatherNICfrontcopy']['tmp_name']; // Temporary file path
            $dstfatherNicfc = '../img/NIC/'.$fathernicfront_tem; // Destination path where image will be saved
     
            // Move the uploaded file to the destination directory
            $uploadfatherfc = move_uploaded_file($srcfatherfc,$dstfatherNicfc);
     
     } 
    }else{
        $fathernicfront_tem = "";
    }

    // check if mother Nic front Copies Uploaded
    if(isset($_FILES['motherNICfrontcopy']['name'])) {
        // Get the details of the uploaded image
        $mothernicfront_tem = $_FILES['motherNICfrontcopy']['name'];
        $temextmotherfc =  explode('.', $mothernicfront_tem);
     
        // Check if an image was selected
        if( $mothernicfront_tem != "") {
            $extmotherfc = end($temextmotherfc);
     
            // Generate a new image name
            // Example: ProfileJohn-1234.png (assuming $cfname is defined somewhere)
            $mothernicfront_tem = "motherNICfront-".$cfname."-".rand(0000,9999).".". $extmotherfc;
     
            $srcmotherfc = $_FILES['motherNICfrontcopy']['tmp_name']; // Temporary file path
            $dstmotherNicfc = '../img/NIC/'.$mothernicfront_tem; // Destination path where image will be saved
     
            // Move the uploaded file to the destination directory
            $uploadfatherfc = move_uploaded_file($srcfatherfc,$dstfatherNicfc);
     
     } 
    }else{
        $mothernicfront_tem = "";
    }
    // check if mother Nic back Copies Uploaded
    if(isset($_FILES['motherNICbackcopy']['name'])) {
        // Get the details of the uploaded image
        $mothernicback_tem = $_FILES['motherNICbackcopy']['name'];
        $temextmotherbc =  explode('.', $mothernicback_tem);
     
        // Check if an image was selected
        if( $mothernicback_tem != "") {
            $extmotherbc = end($temextmotherbc);
     
            // Generate a new image name
            // Example: ProfileJohn-1234.png (assuming $cfname is defined somewhere)
            $mothernicback_tem = "motherNICback-".$cfname."-".rand(0000,9999).".". $extmotherbc;
     
            $srcmotherbc = $_FILES['motherNICbackcopy']['tmp_name']; // Temporary file path
            $dstmotherNicbc = '../img/NIC/'.$mothernicback_tem; // Destination path where image will be saved
     
            // Move the uploaded file to the destination directory
            $uploadfatherfc = move_uploaded_file($srcfatherfc,$dstfatherNicfc);
     
     } 
    }else{
        $mothernicback_tem = "";
    }

    // check if client Nic front Copies Uploaded
    if(isset($_FILES['clientNicFront']['name'])) {
        // Get the details of the uploaded image
        $clientnicfront_tem = $_FILES['clientNicFront']['name'];
        $temexclientrfc =  explode('.', $clientnicfront_tem);
     
        // Check if an image was selected
        if( $clientnicfront_tem != "") {
            $extclientfc = end($temexclientrfc);
     
            // Generate a new image name
            // Example: ProfileJohn-1234.png (assuming $cfname is defined somewhere)
            $clientnicfront_tem = "clientNICFront-".$cfname."-".rand(0000,9999).".". $extclientfc;
     
            $srcclientfc = $_FILES['clientNicFront']['tmp_name']; // Temporary file path
            $dstclentNicfc = '../img/NIC/'.$clientnicfront_tem; // Destination path where image will be saved
     
            // Move the uploaded file to the destination directory
            $uploadcleintfc = move_uploaded_file($srcclientfc,$dstclentNicfc);
     
     } 
    }else{
        $clientnicfront_tem = "";
    }

       // check if client Nic back Copies Uploaded
       if(isset($_FILES['clientNicBack']['name'])) {
        // Get the details of the uploaded image
        $clientnicback_tem = $_FILES['clientNicBack']['name'];
        $temexclientrbc =  explode('.', $clientnicback_tem);
     
        // Check if an image was selected
        if( $clientnicback_tem != "") {
            $extclientbc = end($temexclientrfc);
     
            // Generate a new image name
            // Example: ProfileJohn-1234.png (assuming $cfname is defined somewhere)
            $clientnicback_tem = "clientNICback-".$cfname."-".rand(0000,9999).".". $extclientbc;
     
            $srcclientbc = $_FILES['clientNicBack']['tmp_name']; // Temporary file path
            $dstclentNicbc = '../img/NIC/'.$clientnicback_tem; // Destination path where image will be saved
     
            // Move the uploaded file to the destination directory
            $uploadcleintbc = move_uploaded_file($srcclientbc,$dstclentNicbc);
     
     } 
    }else{
        $clientnicback_tem = "";
    }

    // check if passport Copies 1 Uploaded
    if(isset($_FILES['clientpassportCopy1']['name'])) {
        // Get the details of the uploaded image
        $clientpassback1_tem = $_FILES['clientpassportCopy1']['name'];
        $temexclientrpass1 =  explode('.', $clientpassback1_tem);
     
        // Check if an image was selected
        if( $clientpassback1_tem != "") {
            $extclientpass1 = end($temexclientrpass1);
     
            // Generate a new image name
            // Example: ProfileJohn-1234.png (assuming $cfname is defined somewhere)
            $clientpassback1_tem = "clientpasscopy1-".$cfname."-".rand(0000,9999).".". $extclientpass1;
     
            $srcclientpass1 = $_FILES['clientpassportCopy1']['tmp_name']; // Temporary file path
            $dstclentpass1 = '../img/NIC/'.$clientpassback1_tem; // Destination path where image will be saved
     
            // Move the uploaded file to the destination directory
            $uploadcleintpass1 = move_uploaded_file($srcclientpass1,$dstclentpass1);
     
     } 
    }else{
        $clientpassback1_tem = "";
    }
       // check if passport Copies 2 Uploaded
       if(isset($_FILES['clientpassportcopy2']['name'])) {
        // Get the details of the uploaded image
        $clientpassback2_tem = $_FILES['clientpassportcopy2']['name'];
        $temexclientrpass2 =  explode('.', $clientpassback2_tem);
     
        // Check if an image was selected
        if( $clientpassback2_tem != "") {
            $extclientpass2 = end($temexclientrpass2);
     
            // Generate a new image name
            // Example: ProfileJohn-1234.png (assuming $cfname is defined somewhere)
            $clientpassback2_tem = "clientpasscopy2-".$cfname."-".rand(0000,9999).".". $extclientpass2;
     
            $srcclientpass2 = $_FILES['clientpassportcopy2']['tmp_name']; // Temporary file path
            $dstclentpass2 = '../img/NIC/'.$clientpassback2_tem; // Destination path where image will be saved
     
            // Move the uploaded file to the destination directory
            $uploadcleintpass2 = move_uploaded_file($srcclientpass2,$dstclentpass2);
     
     } 
    }else{
        $clientpassback2_tem = "";
    }

    //Interview Video Upload
    if(isset($_FILES['interviewvideo']['name'])) {
        // Get the details of the uploaded image
        $interviewvideo_tem = $_FILES['clientpassportcopy2']['name'];
        $temeinter =  explode('.', $interviewvideo_tem);
     
        // Check if an image was selected
        if( $interviewvideo_tem != "") {
            $extinter = end($temeinter);
     
            // Generate a new image name
            // Example: ProfileJohn-1234.png (assuming $cfname is defined somewhere)
            $interviewvideo_tem = "Interview-".$cfname."-".rand(0000,9999).".". $extinter;
     
            $srcinter = $_FILES['interviewvideo']['tmp_name']; // Temporary file path
            $dstinter = '../img/interview/'.$srcinter; // Destination path where image will be saved
     
            // Move the uploaded file to the destination directory
            $uploadinter = move_uploaded_file($srcinter,$dstinter);
     
     } 
    }else{
        $interviewvideo_tem = "";
    }

      $sql ="UPDATE clientlist SET
      clientTitle='$ctitle',
      client_fname='$cfname',
      client_mname='$cmname',
      client_lname='$claname',
      client_phone='$cphone',
      cphone2='$cphone2',
      land_phone_no='$landphon',
      client_birthday ='$cdobirth',
      clinet_passport='$cpassport',
      clinet_passport_copy1=' $clientpassback1_tem',
      clinet_passport_copy2='$clientpassback2_tem',
      cfileNo='$cFFno',
      cpassportExp='$cpassexp',
      client_email='$cemail',
      client_address1='$caddress1',
      client_address2='$caddress2',
      client_city='$ccity',
      client_province='$cprovince',
      gsdivision='$gsdivision',
      clinet_photo='$cprofile_tem',
      nic_front='$clientnicfront_tem',
      nic_back='$clientnicback_tem',
      createdby='$username',
      subagentId='$subagent',
      cgender='$gender',
      creligion='$religeon',
      cmstatus='$maritalstatus',
      cheight='$height',
      cweight='$weight',
      cnationality='$nationality',
      cnicNo='$nationality',
      howfoundus='$howfoundus',
      fatherName='$fatherName',
      fatherDateofBirth='$fatherdob',
      fatherNicNo='$fatherNicNo',
      fathercontact='$fatherContact',
      fatherNicFront='$fathernicfront_tem',
      fatherNicBack='$fathernicback_tem',
      MothersName='$motherName',
      MotherDateofBirth='$motherdob',
      motherNicNo='$motherNicNo',
      MotherContact='$motherContact',
      motherNicFront='$mothernicfront_tem',
      motherNicBack='$mothernicback_tem',
      inetrviewvideo='$interviewvideo_tem'
       WHERE 
client_id='$lastInsertId'

        ";
   
   

   if(mysqli_query($conn, $sql)) {
        $lastInsertId = $_POST['currentapplicationid'];

     

        // Insert joballied and specialization data into joballied_specialization table
        if (isset($_POST['main-category']) && isset($_POST['sub-category'])) {
            $mainCategories = $_POST['main-category'];
            $subCategories = $_POST['sub-category'];
        
            // Prepare the statement for inserting joballied and specialization
            $stmt2 = $conn->prepare("INSERT INTO joballied_specialization (client, JobappliedID, SpecializationID) VALUES (?, ?, ?)");
        
            // Loop through each set of main category and subcategory
            for ($i = 0; $i < count($mainCategories); $i++) {
                $jobappliedId = isset($mainCategories[$i]['id']) ? $mainCategories[$i]['id'] : null;
                $specializationId = isset($subCategories[$i]['id']) ? $subCategories[$i]['id'] : null;
        
                // Debugging output
                echo "Job Applied ID: $jobappliedId, Specialization ID: $specializationId\n";
        
                if ($jobappliedId !== null && $specializationId !== null) {
                    $stmt2->bind_param("iii", $lastInsertId, $jobappliedId, $specializationId);
                    if (!$stmt2->execute()) {
                        echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
                    }
                } else {
                    echo "Error: jobappliedId or specializationId is NULL for index $i";
                }
            }
        
            // Close the statement
            $stmt2->close();
        }
        /*Guardian Details */
        $GuardianName = $_POST['guardianName'];
        $GuardianPhone = $_POST['guardianContact'];
        $GuardianRelation = $_POST['guardianRelationship'];
        $Guardiandob = $_POST['guardiandob'];
        $GuardianNIC = $_POST['guardianNIC'];




        //Family Background Letter Upload to Folder
        if(isset($_FILES['guardianletter']['name']))
        {
            //get the details of image selected
            $guardianletter = $_FILES['guardianletter']['name'];
            $temext3 =  explode('.',$guardianletter);

            //check image selected or not
            if($guardianletter!=""){

                $ext3 = end($temext3);

                $guardianletter = "FBR".$GuardianName."-".rand(0000,9999).".". $ext3; //new image name

                $src3 = $_FILES['guardianletter']['tmp_name'];

                $dst3 = "../img/familyletters/".$guardianletter;
                $upload3 = move_uploaded_file($src3,$dst3);                
            }
        }else{
            $guardianletter = "";
        }

         //Guaridan Nic Copy Front
         if(isset($_FILES['guardiannicfront']['name']))
         {
             //get the details of image selected
             $guardianNicFront = $_FILES['guardiannicfront']['name'];
             $temext4 =  explode('.',$guardianNicFront);
 
             //check image selected or not
             if($guardianNicFront!=""){
 
                 $ext4 = end($temext4);
 
                 $guardianNicFront = "GNICFRONT-".$GuardianName."-".rand(0000,9999).".". $ext4; //new image name
 
                 $src4 = $_FILES['guardiannicfront']['tmp_name'];
 
                 $dst4 = "../img/NIC/".$guardianNicFront;
                 $upload4 = move_uploaded_file($src4,$dst4);                
             }
         }else{
            $guardianNicFront = "";
         }
         //Guaridan back Copy Front
         if(isset($_FILES['guardiannicback']['name']))
         {
             //get the details of image selected
             $guardianNicBack = $_FILES['guardiannicback']['name'];
             $temext5 =  explode('.',$guardianNicBack);
 
             //check image selected or not
             if($guardianNicBack!=""){
 
                 $ext5 = end($temext5);
 
                 $guardianNicBack = "GNICBACK-".$GuardianName."-".rand(0000,9999).".". $ext5; //new image name
 
                 $src5 = $_FILES['guardiannicback']['tmp_name'];
 
                 $dst5 = "../img/NIC/".$guardianNicBack;
                 $upload5 = move_uploaded_file($src5,$dst5);                
             }
         }else{
            $guardianNicBack = "";
         }

        $sqlguardian = "INSERT INTO guardiandetails SET
        GuardianName='$GuardianName',
        GuardianContact='$GuardianPhone',
        GuradianRelationship='$GuardianRelation',
        guardianDb='$Guardiandob',
        guardianNIC='$GuardianNIC',
        guardianNIcfront='$guardianNicFront',
        guardianNIcback='$guardianNicBack',
        FbrLetter='$guardianletter',
        clientId='$lastInsertId'
        ";

        $resguardian = mysqli_query($conn,$sqlguardian);

        /*Interview Details*/

         $interviewdate = $_POST['interviewdate'];
         $inetrviewby = $_POST['interviewby'];
         $intervieRemark = $_POST['interviewremark'];


         if(isset($_FILES['interviewvideo']['name'])) {
            //get the details of video selected
            $interviewvideo = $_FILES['interviewvideo']['name'];
            $txtinterview =  explode('.',$interviewvideo);
        
            //check video selected or not
            if($interviewvideo != "") {
                $extinterview = end($txtinterview);
        
                $interviewvideo = "Interview-" . $cfname . "-" . rand(0000,9999) . "." . $extinterview; //new video name
        
                $srcinterview = $_FILES['interviewvideo']['tmp_name'];
        
                $dstinterview = "../img/interview/" . $interviewvideo;
                $uploadinterview = move_uploaded_file($srcinterview, $dstinterview);               
            }
        } else {
            $interviewvideo = "";
        }

         $interviewsql = "INSERT INTO `intervievideos`(`inetrviewClinetID`, `interviewUrl` ,`inertviewDate`,`interviewBy`,`InterviewRemark`) 
         VALUES (
             '$lastInsertId',
             '$interviewvideo',
             '$interviewdate',
             '$inetrviewby',
             '$intervieRemark'
         )";

        $interviewquery = mysqli_query($conn,$interviewsql);


         /*End of Interview*/



        /* Spouce Details */
        $spouceName = $_POST['spouseFullName'];
        $spouceRelationship = $_POST['relationship'];
        $spoucedob = $_POST['spouseDOB'];
        $spoucestatuts = $_POST['maritalStatus'];
        $spouceNic = $_POST['spouseNIC'];
        $spouceContact = $_POST['spouseContactNumber'];

        /*Spouce NIC Front Copy */
         if(isset($_FILES['spoucenicfront']['name']))
         {
             //get the details of image selected
             $spouceNICfront = $_FILES['spoucenicfront']['name'];
             $temextsfc =  explode('.',$spouceNICfront);
 
             //check image selected or not
             if($spouceNICfront!=""){
 
                 $extsfc = end($temextsfc);
 
                 $spouceNICfront = "SpouceNIC-Front-".$spouceName."-".rand(0000,9999).".". $extsfc; //new image name
 
                 $srcsfc = $_FILES['spoucenicfront']['tmp_name'];
 
                 $dstsfc = "../img/NIC/".$spouceNICfront;
                 $uploadsfc = move_uploaded_file($srcsfc,$dstsfc);                
             }
         }else{
            $spouceNICfront = "";
         }
         /*Spouce NIC back Copy */
         if(isset($_FILES['spoucenicback']['name']))
         {
             //get the details of image selected
             $spouceNICback = $_FILES['spoucenicback']['name'];
             $temextsbc =  explode('.',$spouceNICback);
 
             //check image selected or not
             if($spouceNICback!=""){
 
                 $extsbc = end($temextsbc);
 
                 $spouceNICback = "SpouceNIC-back-".$spouceName."-".rand(0000,9999).".". $extsbc; //new image name
 
                 $srcsbc = $_FILES['spoucenicback']['tmp_name'];
 
                 $dstsbc = "../img/NIC/".$spouceNICback;
                 $uploadsbc = move_uploaded_file($srcsbc,$srcsbc);                
             }
         }else{
            $spouceNICback = "";
         }

         $sqlspucequey = "INSERT INTO spoucedetails SET 
         clinetId='$lastInsertId',
         spoucefullname='$spouceName',
         spouceType='$spouceRelationship',
         spuceDob='$spoucedob',
         marrieagstatus='$spoucestatuts',
         spouceContact='$spouceContact',
         spouceNIC='$spouceNic',
         SpouceNICfront='$spouceNICfront',
         SpouceNICback='$spouceNICback'
         ";

        $resspouce = mysqli_query($conn, $sqlspucequey);

        /*Driving License*/
        $DrivingLicensetype = $_POST['licensetype'];
        $dlcountry = $_POST['licensecountry'];
        $dltype = $_POST['licensecopy'];
        $dlexp = $_POST['licenseexpirey'];

        /*education Qualification*/
        $schoolname = $_POST['schoolname'];
        $exame = $_POST['edulevel'];
        $yearexame = $_POST['eduyear'];
      

        /*professional qualification*/
        $instituteName = $_POST['institueName'];
        $courseName = $_POST['CourseName'];
        $coursstatus = $_POST['CourseStatus'];

        /*Sibiling details*/ 
        $childName = $_POST['childName'];
        $childgender = $_POST['childRelationship'];
        $childDob = $_POST['childDOB'];
        $schoolAttended = $_POST['childSchoolAttended'];
        $schoolName = $_POST['childSchoolName'];
        $childNIC = $_POST['childNIC'];        
        $childgrade = $_POST['childGrade'];
         
        /*Language*/
        $languagename = $_POST['lanuagesnames'];
        $langread = $_POST['lanlangread'];
        $langwrite = $_POST['langwrite'];
        $dlangspeak = $_POST['lanlangread'];

        /*Driving License*/
        for ($i = 0; $i < count($DrivingLicensetype); $i++) {
        $driveltype = mysqli_real_escape_string($conn, $DrivingLicensetype[$i]);
        $dlcountryname = mysqli_real_escape_string($conn, $dlcountry[$i]);
        $dlicentype = mysqli_real_escape_string($conn, $dltype[$i]);
        $dlexpdate = mysqli_real_escape_string($conn, $dlexp[$i]);
       
        
        // Handle file upload for attachment2
        $dlcopyattach = $_FILES['licensefileattach']['name'][$i];
        $attachment5TmpName = $_FILES['licensefileattach']['tmp_name'][$i];
        $attachment5Path = "../img/drivinglicense/" . $dlcopyattach;

        move_uploaded_file($attachment5TmpName, $attachment5Path);
        
        // SQL INSERT query for repeater fields with attachment
        $sqlRepeater5 = "INSERT INTO drivinglicense SET 
        dlicenseType='$driveltype',
        dlicneseCountry='$dlcountryname',
        licenseType = '$dlicentype',
        licenseExpDate = '$dlexpdate',
        Dlattach ='$dlcopyattach',
        clientId =' $lastInsertId'
        ";

        if (!mysqli_query($conn, $sqlRepeater5)) {
            echo "Error: " . $sqlRepeater5 . "<br>" . mysqli_error($conn);
        }
    }
    
            /*workexperiance*/
            $workposition = $_POST['workposition'];
            $companyname = $_POST['CompanyName'];
            $country = $_POST['JobCountry'];
            $years = $_POST['JobYears'];

            /*professional qualification*/
            for ($i = 0; $i < count($instituteName); $i++) {
            $instiname = mysqli_real_escape_string($conn, $instituteName[$i]);
            $courseNm = mysqli_real_escape_string($conn, $courseName[$i]);
            $CourseStat = mysqli_real_escape_string($conn, $coursstatus[$i]);
           
            
            // Handle file upload for attachment2
            $courseacet = $_FILES['courcecertificate']['name'][$i];
            $attachment3TmpName = $_FILES['courcecertificate']['tmp_name'][$i];
            $attachment3Path = "../img/education/" . $courseacet;

            move_uploaded_file($attachment3TmpName, $attachment3Path);
            
            // SQL INSERT query for repeater fields with attachment
            $sqlRepeater3 = "INSERT INTO professionalqualification SET 
            institueName='$instiname',
            CourseName='$courseNm',
            CourseStatus = '$CourseStat',
            courcecertificate = '$courseacet',
            clientId='$lastInsertId'
            ";
             if (!mysqli_query($conn, $sqlRepeater3)) {
                echo "Error: " . $sqlRepeater3 . "<br>" . mysqli_error($conn);
            }

            /*Work Experiance*/
            for ($i = 0; $i < count($companyname); $i++) {
            $wokcompany = mysqli_real_escape_string($conn, $companyname[$i]);
            $workexperiance1 = mysqli_real_escape_string($conn, $workposition[$i]);
            $jobcountry = mysqli_real_escape_string($conn, $country[$i]);
            $jobyears = mysqli_real_escape_string($conn, $years[$i]);
               
                
                // Handle file upload for attachment2
            $jobcertify = $_FILES['jobcertificate']['name'][$i];
            $attachment4TmpName = $_FILES['jobcertificate']['tmp_name'][$i];
            $attachment4Path = "../img/jobletter/" . $jobcertify;
    
            move_uploaded_file($attachment4TmpName, $attachment4Path);
                
                // SQL INSERT query for repeater fields with attachment
            $sqlRepeater4 = "INSERT INTO workexperiance SET 
            CompanyName='$wokcompany',
            workposition='$workexperiance1',
            JobCountry = '$jobcountry',
            JobYears = '$jobyears',
            jobcertificate ='$jobcertify',
            cliebtID ='$lastInsertId'
            ";
    
                if (!mysqli_query($conn, $sqlRepeater4)) {
                    echo "Error: " . $sqlRepeater4 . "<br>" . mysqli_error($conn);
                }
            } 
            /*Educational Qyalifications*/
        for ($i = 0; $i < count($schoolname); $i++) {
            $schoolname1 = mysqli_real_escape_string($conn, $schoolname[$i]);
            $exametype= mysqli_real_escape_string($conn, $exame[$i]);
            $exameyear = mysqli_real_escape_string($conn, $yearexame[$i]);
            
            // Handle file upload for attachment2
            $attachment2Name = $_FILES['certificate']['name'][$i];
            $attachment2TmpName = $_FILES['certificate']['tmp_name'][$i];
            $attachment2Path = "../img/education/" . $attachment2Name;

            move_uploaded_file($attachment2TmpName, $attachment2Path);
            
            // SQL INSERT query for repeater fields with attachment
            $sqlRepeater2 = "INSERT INTO education SET 
            schoolname='$schoolname1',
            ol_al='$exametype',
            schoolyear = '$exameyear',
            resultsheet = '$attachment2Name',
            cleintID='$lastInsertId'
            ";

            if (!mysqli_query($conn, $sqlRepeater2)) {
                echo "Error: " . $sqlRepeater2 . "<br>" . mysqli_error($conn);
            }
        }
            /*Sibiling Details*/
            for ($i = 0; $i < count($childName); $i++) {
                // Escape variables to protect against SQL injection
                $childname1 = mysqli_real_escape_string($conn, $childName[$i]);
                $childgender1 = mysqli_real_escape_string($conn, $childgender[$i]); // Ensure this variable name is unique
                $childdob1 = mysqli_real_escape_string($conn, $childDob[$i]);
                $schoolattended1 = mysqli_real_escape_string($conn, $schoolAttended[$i]);
                $childNICno1 = mysqli_real_escape_string($conn, $childNIC[$i]);
                $schoolname1 = mysqli_real_escape_string($conn, $schoolName[$i]);
                $childgrade1 = mysqli_real_escape_string($conn, $childgrade[$i]);
                
                // Handle file uploads for Child NIC Front
                $childNicFront = $_FILES['sibilingnicfront']['name'][$i];
                $attachment2TmpName = $_FILES['sibilingnicfront']['tmp_name'][$i];
                $attachment2Path = "../img/NIC/" . $childNicFront;
                move_uploaded_file($attachment2TmpName, $attachment2Path);
                
                // Handle file uploads for Child NIC Back
                $childNicBack = $_FILES['sibilingnicback']['name'][$i];
                $attachment3TmpName = $_FILES['sibilingnicback']['tmp_name'][$i];
                $attachment3Path = "../img/NIC/" . $childNicBack;
                move_uploaded_file($attachment3TmpName, $attachment3Path);
                
                // SQL INSERT query for repeater fields with attachments
                $siblingquery = "INSERT INTO childrendetails SET 
                    childrenName='$childname1',
                    childrenDOB='$childdob1',
                    childGender='$childgender1',
                    schoolAttended='$schoolattended1',
                    childSchool='$schoolname1',
                    childGrade='$childgrade1',
                    ChildNIC='$childNICno1',
                    ChildNICFront='$childNicFront',
                    ChildNICback='$childNicBack',
                    clientID='$lastInsertId'
                ";
            
                if (!mysqli_query($conn, $siblingquery)) {
                    echo "Error: " . $siblingquery . "<br>" . mysqli_error($conn);
                }
            }
            /*Languages*/
            for ($i = 0; $i < count($DrivingLicensetype); $i++) {
                $langName = mysqli_real_escape_string($conn, $languagename[$i]);
                $langRead1 = mysqli_real_escape_string($conn, $langread[$i]);
                $langwrite1 = mysqli_real_escape_string($conn, $langwrite[$i]);
                $lanSpeak = mysqli_real_escape_string($conn, $dlangspeak[$i]);
               
                
                // SQL INSERT query for repeater fields with attachment
                $sqlRepeater6 = "INSERT INTO languageslist SET 
                languages='$langName',
                lread='$langRead1',
                lwrite = '$langwrite1',
                lspeak = '$lanSpeak',
                clientId =' $lastInsertId'
                ";
    
                if (!mysqli_query($conn, $sqlRepeater6)) {
                    echo "Error: " . $sqlRepeater6 . "<br>" . mysqli_error($conn);
                }
            } 
            /*tags*/
        
            }
            echo "Data inserted successfully!";
        header("Location: http://localhost/nationsui/application-view.php");

    }
    


   }
   