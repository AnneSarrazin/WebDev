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
    var nom = encodeURIComponent(document.getElementById("nom").value);
    var prenom = encodeURIComponent(document.getElementById("prenom").value);
    var mail = encodeURIComponent(document.getElementById("mail").value); 
     
    xhr.open("GET", "SuppressionLocataireBis.php?Nom="+nom+"&Prenom="+prenom+"&Mail="+mail, true);
    xhr.send(null);
   
}

function readData(oData) {
    if(oData != "Erreur lors de la suppression du locataire")
    {
        document.getElementById("formulaire").style.display = "none";
        window.location = "http://localhost/Mandeline/ListeLocataire/ListeLocataire.php";
    }
    alert(oData);
}