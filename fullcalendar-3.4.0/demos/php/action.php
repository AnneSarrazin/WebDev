<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
require("class.phpmailer.php");
require ("class.smtp.php");
require 'class.pop3.php';
require_once 'PHPMailerAutoload.php';


    
    /* Configuration des options de connexion */
    
    /* Désactive l'éumlateur de requêtes préparées (hautement recommandé)  */
    $pdo_options[PDO::ATTR_EMULATE_PREPARES] = false;
    
    /* Active le mode exception */
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    
    /* Indique le charset */
    $pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES utf8";
    
    /* Connexion */
    try
    {     
        if(isset($_POST)) {
 

 
    $nom = $_POST['nom'];
 
    $prenom = $_POST['prenom'];
 
    $email = $_POST['email'];
    
    $date_deb = $_POST['date_deb'];
    
    $date_fin = $_POST['date_fin'];
    
    
    $hostname = "localhost";
    $database = "mandeline";
    $username = "root";
    $password = "";
    $table = "locataire";
    
     $connect = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password, $pdo_options);
     
     $requete = "SELECT count(*) FROM $table WHERE adresse_mail = ?";
      $req_prep = $connect->prepare($requete);
      $req_prep->execute(array(0=>$email));
      $resultat = $req_prep->fetchColumn();
      
   
          
          if($resultat == 1){
              
             $data = array('success' => true, 'message' => 'Il existe votre mail dans le systeme');
             echo json_encode($data);  
       
          }
          else {
              
               
               // Message
               
                
               
              // Enregistre id,pass dans BDD
               
               $req = $connect->prepare("INSERT INTO $table (nom,prenom,adresse_mail) VALUES (:nom,:prenom,:email)");
               $result = $req->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,   
                
                'email' => $email,
                
	       ));
               
                //$requete = "SELECT * FROM $table WHERE nom = $nom AND prenom = $prenom";
                //$req_prep = $connect->prepare($requete);
                //$req_prep->execute();
                //$res = $req_prep->fetch();
                //$resultat = $res['id_locataire'];
                
               $reponse = $bdd->query("SELECT * FROM $table WHERE nom = $nom AND prenom = $prenom");
               $donnees = $reponse->fetch();
               
               
               $req = $connect->prepare("INSERT INTO reservation (title,start,end,id_locataire,id_valib,rendering,color) VALUES (:titre,:date_deb,:date_end,:id,:id_valib,:rendering,:color) ");
               $result = $req->execute(array(
                'titre' => 'DEMANDE DE CLIENT',
                'date_deb' => $date_deb ,   
                'date_fin' => $date_fin,
                'id' => $donnees['id_locataire'],
                'id_valib' => 1,
                'rendering' => 'background',
                'color' => '#cccccc'
	       ));
               
               
    
            $mail = new PHPMailer();
            
            $message= "Form details below:\n\n <br />";
                $message.="Ligne de confirmation : \r\n <br />";
                
                $message.="Votre identifiant: $prenom.$nom <br /> ";
                $message.="Vous avez reservé entre $date_deb et $date_fin\r\n";
                $message.="On va vous contacter tout de suite";
                $message.="Merci et Bonne journée";
            //Khai báo gửi mail bằng SMTP
            $mail->IsSMTP();
            //Tắt mở kiểm tra lỗi trả về, chấp nhận các giá trị 0 1 2
            // 0 = off không thông báo bất kì gì, tốt nhất nên dùng khi đã hoàn thành.
            // 1 = Thông báo lỗi ở client
            // 2 = Thông báo lỗi cả client và lỗi ở server
            $mail->SMTPDebug  = 0;

            $mail->Debugoutput = "html"; // Lỗi trả về hiển thị với cấu trúc HTML
            $mail->Host       = "smtp.gmail.com"; //host smtp để gửi mail
            $mail->Port       = 587; // cổng để gửi mail
            $mail->SMTPSecure = "tls"; //Phương thức mã hóa thư - ssl hoặc tls
            $mail->SMTPAuth   = true; //Xác thực SMTP
            $mail->Username   = "viettrungho.vn@gmail.com"; // Tên đăng nhập tài khoản Gmail
            $mail->Password   = "015632489MQH6Nu"; //Mật khẩu của gmail
            $mail->SetFrom("viettrungho.vn@gmail.com", "Projet PRIOR"); // Thông tin người gửi
            //$mail->AddReplyTo("no-reply@example.com","Test Reply");// Ấn định email sẽ nhận khi người dùng reply lại.
            $mail->AddAddress("$email", "");//Email của người nhận
            $mail->Subject = "BIENVENU AU PROJET MANDELINE - ISEN TOULON"; //Tiêu đề của thư
            $mail->MsgHTML("$message"); //Nội dung của bức thư.
            // $mail->MsgHTML(file_get_contents("email-template.html"), dirname(__FILE__));
            // Gửi thư với tập tin html
            //$mail->AltBody = "This is a plain-text message body";//Nội dung rút gọn hiển thị bên ngoài thư mục thư.
            //$mail->AddAttachment("images/attact-tui.gif");//Tập tin cần attach
            
            
            if($mail->send()) {
             $data = array('success' => true, 'message' => 'Nous vous avons envoyé une lettre de vérification. '
                 . ' Merci beaucoup!');
             echo json_encode($data);  
            } 
            else {
                $data = array('success' => false, 'message' => 'Désolé, il y a des erreurs. Vérifiez-vous votre connexion! Merci');
                echo json_encode($data);
            }
          }
    }

    

    }
    catch (Exception $e)
    {
       die('Erreur : ' . $e->getMessage());
    
    }
         
   
            


