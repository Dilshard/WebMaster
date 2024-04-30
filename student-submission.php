<?php
include("validate_student.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include("student-nav.php") ?>
        </div>
        <div class="row mt-4">
          <div class="col-md-8 offset-md-2">
            <div class="card">
              <div class="card-header">
                Project Proposal
              </div>
              <div class="card-body">
                
                <form method="post" enctype="multipart/form-data">
                  <?php
                  if(isset($_SESSION['file_cat_status'])){
                    echo '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Uploaded!</strong> '.$_SESSION['file_cat_status'].'
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';
                    unset($_SESSION['file_cat_status']);
                  }
                  ?>
                  
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Note : Only PDF can be uploaded</label>
                    <input class="form-control" type="file" id="formFile" name="pdfFile">
                  </div>
                  <button name="btnsub" type="submit" class="btn btn-primary">Upload</button>
                </form>
              </div>

            </div>
          </div>
        </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>
</html>

<?php
require_once 'vendor/autoload.php';

if(isset($_POST['btnsub'])){

    // Function to categorize project proposals
    function categorize_proposals($proposal, $ml_keywords,$deep_learning,$artificial_intelligence,$natural_language_processing,$data_mining,$gamification,$ui_ux,$web_application_development,$cloud_computing,$cyber_security,$iot,$virtualization,$large_language_models,$devops,$generative_ai,$robotics,$web_mobile_development,$image_classification) {

        //$categorized_proposals = ["AI" => [], "Machine Learning" => [], "Image Processing" => []];
        $proposal_lower = strtolower($proposal); ////convert PDF text to lower case

        //Individual cat score
        // echo('Ai - '.contains_keywords($proposal_lower, $ai_keywords)).'<br>';
        // echo('ML - '.contains_keywords($proposal_lower, $ml_keywords)).'<br>';
        // echo('IP - '.contains_keywords($proposal_lower, $image_processing_keywords)).'<br>';
        

        $cat_score = [
            'Machine Learning' => contains_keywords($proposal_lower, $ml_keywords),
            'Deep Learning' => contains_keywords($proposal_lower, $deep_learning),
            'Artificial Intelligence' => contains_keywords($proposal_lower, $artificial_intelligence),
            'Natural Language Processing' => contains_keywords($proposal_lower, $natural_language_processing),
            'Data Mining' => contains_keywords($proposal_lower, $data_mining),
            'UI UX' => contains_keywords($proposal_lower, $ui_ux),
            'Web Dev' => contains_keywords($proposal_lower, $web_application_development),
            'Cloud Comp' => contains_keywords($proposal_lower, $cloud_computing),
            'Cyber Securoty' => contains_keywords($proposal_lower, $cyber_security),
            'IoT' => contains_keywords($proposal_lower, $iot),
            'Virtualization' => contains_keywords($proposal_lower, $virtualization),
            'Large Language Models ' => contains_keywords($proposal_lower, $large_language_models),
            'DevOps' => contains_keywords($proposal_lower, $devops),
            'Generative Ai' => contains_keywords($proposal_lower, $generative_ai),
            'Robotics' => contains_keywords($proposal_lower, $robotics),
            'Web Mobile Development' => contains_keywords($proposal_lower, $web_mobile_development),
            'Image Classification' => contains_keywords($proposal_lower, $image_classification)
        ];

        $highest_in_all_cat = max($cat_score); //Find the max value in from all cat
        $high_score = 0;
        $other_score = 0;
        $cat_name = "";
        //Get the cat name and value of max val
        foreach ($cat_score as $key => $value) {
            
            if($value == $highest_in_all_cat){
                // echo "Project cat :  $key, $value%<br>";
                $high_score = $value;
                $cat_name = $key;
            }
            if($value == 0){
                continue;
            }else{
                $other_score += $value;
            }
        }
        $cat_percentage = ($high_score/$other_score*100);
        $_SESSION['file_cat_status'] = $cat_name." - ".round($cat_percentage,2)."%";

        // --- update student table --
        include("con.php");
        $sql_update_student_area = "UPDATE `Student` SET `resarea` = '$cat_name' WHERE `Student`.`iitid` = $_SESSION[iitid];";
        mysqli_query($conn, $sql_update_student_area);


        header("Location: student-submission.php", true, 301);
        exit();
    }

    // Create an array with all available keywords in keywords list in the PDF
    function contains_keywords($text, $keywords) {
        $available_keywords = [];
        foreach ($keywords as $keyword) {
            $lower_keyword = strtolower($keyword); //convert keywords to lower case
            if (strpos($text, $lower_keyword) == true) {
                array_push($available_keywords, $lower_keyword);
            }
        }
        // foreach($available_keywords as $key){
        //     echo $key.'<br>';
        // }

        return count($available_keywords);
    }

    // Keywords list for each category
    $ml_keywords = ["Supervised Learning","Unsupervised Learning","Reinforcement Learning","Classification","Regression","Clustering","Decision Trees","Random Forests","Support Vector Machines (SVM)","Support Vector Machines","Neural Networks","Gradient Descent","Feature Engineering","Model Evaluation"];
    $deep_learning = ["Artificial Neural Networks","ANN","Convolutional Neural Networks","CNN","Recurrent Neural Networks","RNN","Long Short-Term Memory","LSTM","Generative Adversarial Networks","GAN","Deep Reinforcement","Transfer Learning","Autoencoders","Batch Normalization","Dropout","Activation Functions","ReLU","Sigmoid","Tanh","Backpropagation"];
    $artificial_intelligence = ["Expert Systems","Knowledge Representation","Symbolic AI","Cognitive Computing","Machine Reasoning","Automated Planning","Natural Language Understanding","Computer Vision","Search Algorithms","Algorithms"];
    $natural_language_processing = ["Tokenization","Part-of-Speech Tagging","Named Entity Recognition","NER","Sentiment Analysis","Word Embeddings","Language Modeling","Topic Modeling","Text Classification","Machine Translation","Text Summarization","Dependency Parsing"];
    $data_mining = ["Association Rule Mining","Clustering","Classification","Regression","Outlier Detection","Dimensionality Reduction","Pattern Recognition","Data Preprocessing","Feature Selection","Frequent Pattern Mining"];
    $gamification = ["Points","Badges","Leaderboards","Challenges","Progression Systems","Feedback Systems","Rewards","Achievements","Competition","Engagement"];
    $ui_ux = ["User Interface","User Experience","User Experience Design","Wireframing","Prototyping","User Research","Usability Testing","Information Architecture","Interaction Design","Responsive Design","Responsive","Visual Design","Visual"];
    $web_application_development = ["HTML","CSS","JavaScript","Frontend Frameworks","React","Angular","Vue","Backend Frameworks","Nodejs","Django","Flask","RESTful APIs","RESTful","Database Management","Database","Security Best Practices","Scalability","Performance Optimization"];
    $cloud_computing = ["Infrastructure as a Service","Platform as a Service","IaaS", "PaaS", "Software as a Service","SaaS", "Public Cloud", "Private Cloud", "Hybrid Cloud", "Cloud Storage", "Cloud Security", "Serverless Computing", "Microservices"];
    $cyber_security = ["Encryption", "Firewall", "Intrusion Detection System (IDS)", "Intrusion Prevention System (IPS)", "Vulnerability Assessment", "Penetration Testing", "Identity and Access Management (IAM)", "Security Policies", "Incident Response", "Security Auditing"];
    $iot = ["Sensors", "Actuators", "Internet Connectivity", "Embedded Systems", "Machine-to-Machine Communication (M2M)", "Data Analytics", "Edge Computing", "IoT Platforms", "Security and Privacy", "Smart Devices"];
    $virtualization = ["Hypervisor", "Virtual Machines","VMs", "Containers", "Virtual Networking", "Resource Pooling", "VM Migration", "Orchestration", "Scalability", "Disaster Recovery", "Performance Monitoring"];
    $large_language_models = ["GPT", "BERT", "Transformer Architecture", "Fine-tuning", "Transfer Learning", "Text Generation", "Language Understanding", "Contextual Embeddings", "Long-range Dependencies", "Pre-trained Models","Generative Pre-trained Transformer","Bidirectional Encoder Representations from Transformers"];
    $devops = ["Continuous Integration", "Continuous Deployment", "Configuration Management", "Infrastructure as Code", "Version Control", "Automated Testing", "Deployment Pipelines", "Monitoring and Logging", "Collaboration Tools", "Agile Methodologies","CI","IaC","git"];
    $generative_ai = ["Generative Adversarial Networks", "Variational Autoencoders", "Reinforcement Learning", "Probabilistic Models", "Markov Chains", "Monte Carlo Methods", "Auto-regressive Models", "Transformer Models", "Image Generation", "Text Generation","GAN","VAE"];
    $robotics = ["Robot Perception", "Localization", "Mapping", "Path Planning", "Manipulation", "Control Systems", "Robot Vision", "Simultaneous Localization and Mapping", "Autonomous Navigation", "Human-Robot Interaction","SLAM"];
    $web_mobile_development = ["HTML", "CSS", "JavaScript", "Frontend Frameworks", "Backend Frameworks", "Mobile Development Platforms", "Responsive Design", "Progressive Web Apps", "Cross-platform Development", "Native Development","iOS","Android","PWAs"];
    $image_classification = ["Convolutional Neural Networks", "Transfer Learning", "Fine-tuning", "Data Augmentation", "Image Preprocessing", "Object Detection", "Image Segmentation", "Feature Extraction", "Deep Learning Models", "Classification Algorithms","CNN"];


    // Read PDF from HTML form
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["pdfFile"])) {
        $targetDir = "PDFs/"; 
        $targetFile = $targetDir .$_SESSION['iitid'].basename( $_FILES["pdfFile"]["name"]);
        $uploadOk = 1;
        $pdfFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        
        // Check wether the file is a PDF
        if($pdfFileType != "pdf") {
            echo "<div class='offset-md-2 p-3'>Only PDF files are allowed.</div>";
            $_SESSION['file_cat_status'] = "Only PDF files are allowed.";
            $uploadOk = 0;
        }else{
            //Rename the file
            $targetFile = $targetDir .$_SESSION['iitid'].'.pdf';

            //Delete if exists
            unlink("PDFs/".$_SESSION['iitid'].'.pdf');
            
            // Check if file already exists
            if (file_exists($targetFile)) {
                echo "File already exists.";
                $uploadOk = 0;
            }

            // Check file size (optional)
            if ($_FILES["pdfFile"]["size"] > 15000000) {
                echo "File is too large.- ".$_FILES["pdfFile"]["size"];
                $uploadOk = 0;
            }

            // Upload file
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)) {
                    //echo "The file ". htmlspecialchars( time().'_'.basename( $_FILES["pdfFile"]["name"])). " has been uploaded.";
                    $PDF_File_name = $_SESSION['iitid'].'.pdf';
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

            $parser = new \Smalot\PdfParser\Parser();
            $pdf = $parser->parseFile('PDFs/'.$PDF_File_name);
        
            $text = $pdf->getText();
        
            $project_proposals = $text;

            // add keywords lists to main function
            categorize_proposals($project_proposals, $ml_keywords,$deep_learning,$artificial_intelligence,$natural_language_processing,$data_mining,$gamification,$ui_ux,$web_application_development,$cloud_computing,$cyber_security,$iot,$virtualization,$large_language_models,$devops,$generative_ai,$robotics,$web_mobile_development,$image_classification);
        }

        
    } else {
        echo "No file uploaded.";
    }
    //--------- End
    
}
?>