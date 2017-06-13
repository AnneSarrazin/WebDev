var xhr = new XMLHttpRequest();

function getXMLHttpRequest() { 
    var xhr = null; 
    if (window.XMLHttpRequest || window.ActiveXObject) { 
        if (window.ActiveXObject) { 
            try { 
                    xhr = new ActiveXObject("Msxml2.XMLHTTP"); 
            } catch(e) { 
                    xhr = new ActiveXObject("Microsoft.XMLHTTP"); 
            } 
        } else { 
                xhr = new XMLHttpRequest(); 
        } 
    } else { 
            alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest..."); 
            return null; 
    } 
    return xhr; 
}

function request(callBack) {
    //On récupère la valeur rentrée par l'utilisateur
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function () {
        //réponse arrivé
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {
            callBack(xhr.responseText);
        }
    };
    var nomA = encodeURIComponent(document.getElementById("ancienNom").value);
    var prenomA = encodeURIComponent(document.getElementById("ancienPrenom").value);
    var mailA = encodeURIComponent(document.getElementById("ancienMail").value); 
    
    var nom = document.getElementById("nomLocataire");
    if(nom == null)
    {
        nom = nomA;
    }else
    {
        nom = encodeURIComponent(document.getElementById("nomLocataire").value);
    }
    
    var prenom = encodeURIComponent(document.getElementById("prenomLocataire").value);
    if(prenom == null)
    {
        prenom = prenomA;
    }else
    {
        prenom = encodeURIComponent(document.getElementById("prenomLocataire").value);
    }
    
    var mail = document.getElementById("mailLocataire");
    if(mail == null)
    {
        mail = mailA;
    }else
    {
        mail = encodeURIComponent(document.getElementById("mailLocataire").value);
    }
     
    xhr.open("GET", "ModificationLocataireBis.php?Nom="+nom+"&Prenom="+prenom+"&Mail="+mail+"&NomA="+nomA+"&PrenomA="+prenomA+"&MailA="+mailA, true);
    xhr.send(null);
    
   
}

function readData(oData) {
    if(oData != "Erreur lors de la modification du locataire")
    {
        document.getElementById("formulaire").style.display = "none";
        //document.getElementById("retour").style.display = "inline";
        window.location = "http://localhost/Mandeline/ListeLocataire/ListeLocataire.php";
    }
    alert(oData);
}

