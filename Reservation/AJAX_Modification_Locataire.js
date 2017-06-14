var xhr = new XMLHttpRequest();
//initialisation AJAX
function getXMLHttpRequest() {
    var xhr = null;
    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest... Veuillez changer de navigateur.");
        return null;
    }
    return xhr;
}


function request(oSelect) {
    //On récupère la valeur rentrée par l'utilisateur
    var value = oSelect.value;
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function () {
        //réponse arrivé, select affiché, loader pas affiché
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {
            readData(xhr.responseXML);
            //document.getElementById("loader").style.display = "none";
            document.getElementById("locataire").style.display="inline";
        } 
        //sinon on affiche le loader
        else if (xhr.readyState < 4) {
            //document.getElementById("loader").style.display = "inline";
            document.getElementById("locataire").style.display="none";
        }
    };
    //envoie à la partie PHP
    xhr.open("POST", "PHP_Ajax_changement_Locataire.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("Nom=" + value);
    
   
}


function readData(oData) {
    //recuperation du XML
    var nodes = oData.getElementsByTagName("item");
    var oSelect = document.getElementById("locataire");
    var oOption, oInner;
    oSelect.innerHTML = "";
    //on rempli le select
    for (var i = 0, c = nodes.length; i < c; i++){
        oOption = document.createElement("option");
        oInner = document.createTextNode(nodes[i].getAttribute("name"));
        oOption.value = nodes[i].getAttribute("id");
        oOption.appendChild(oInner);
        oSelect.appendChild(oOption);
    }
}


