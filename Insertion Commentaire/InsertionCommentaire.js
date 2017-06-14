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
    var nom = encodeURIComponent(document.getElementById("nomLocataire").value);
    var prenom = encodeURIComponent(document.getElementById("prenomLocataire").value);
    var mail = encodeURIComponent(document.getElementById("mailLocataire").value); 
    var idResa = encodeURIComponent(document.getElementById("idReservation").value); 
    var contenu = encodeURIComponent(document.getElementById("contenuCommentaire").value); 
    xhr.open("GET", "InsertionCommentaire.php?Nom="+nom+"&Prenom="+prenom+"&Mail="+mail+"&IdResa="+idResa+"&Contenu="+contenu, true);
    xhr.send(null);
    
   
}

function readData(oData) {
    if(oData != "Erreur lors de l'ajout du locataire")
    {
        document.getElementById("formulaire").style.display = "none";
    }
    alert(oData);
}
