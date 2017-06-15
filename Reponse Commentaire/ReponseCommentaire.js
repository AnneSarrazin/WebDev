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
    var com = encodeURIComponent(document.getElementById("com").value);
    var reponse = encodeURIComponent(document.getElementById("reponse").value);
    reponse = reponse.replace("'"," ");
     
    xhr.open("GET", "ReponseCommentaireBis.php?Com="+com+"&Reponse="+reponse, true);
    xhr.send(null);
   
}

function readData(oData) {
    if(oData != "Erreur lors de la reponse")
    {
        document.getElementById("formulaire").style.display = "none";
        window.location = "http://localhost/Mandeline/ListeCommentaire/ListeCommentaire.php";
    }
    alert(oData);
}
