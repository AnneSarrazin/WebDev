 function CheckDate(d) {
      // Cette fonction vérifie le format AAAA/MM/JJ saisi et la validité de la date.
      // Le séparateur est défini dans la variable separateur
      var amin=2017; // année mini
      var amax=2100; // année maxi
      var separateur="-"; // separateur entre jour/mois/annee
      //On divise la chaine en éléments différents
      var j=(d.substring(8,10));
      var m=(d.substring(5,7));
      var a=(d.substring(0,4));
      var ok=1;
      //si le jour n'est pas un nombre ou ne correspond pas à un jour
      if ( ((isNaN(j))||(j<1)||(j>31)) && (ok==1) ) {
         alert("Un jour n'est pas correct."); ok=0;
      }
      //si le mois n'est pas un nombre ou ne correspond pas à un jour
      if ( ((isNaN(m))||(m<1)||(m>12)) && (ok==1) ) {
         alert("Un mois n'est pas correct."); ok=0;
      }
      //si l'année n'est pas un nombre ou ne correspond pas à un jour
      if ( ((isNaN(a))||(a<amin)||(a>amax)) && (ok==1) ) {
         alert("Une année n'est pas correcte."); ok=0;
      }
      //si les séparateurs ne sont pas les bons
      if ( ((d.substring(4,5)!=separateur)||(d.substring(7,8)!=separateur)) && (ok==1) ) {
         alert("Les séparateurs doivent être des "+separateur); ok=0;
      }
      //S'il n'y a pas eu d'erreurs
      if (ok==1) {
          //On vérifie que la date rentrée existe
         var d2=new Date(a,m-1,j);
         j2=d2.getDate();
         m2=d2.getMonth()+1;
         a2=d2.getFullYear();
         if (a2<=100) {a2=1900+a2}
         if ( (j!=j2)||(m!=m2)||(a!=a2) ) {
            alert("Une date "+d+" n'existe pas !");
            ok=0;
         }
      }
      return ok;
   }

function DateOk(){
    console.log("JS");
    //On récupère les deux dates rentrées
    var date_deb=document.getElementById("DateDeb").value;
    var date_fin=document.getElementById("DateFin").value;
    //On les affiche en console
    console.log(date_deb);
    console.log(date_fin);
    //On checke les dates
    ok_deb=CheckDate(date_deb);
    ok_fin=CheckDate(date_fin);
    //Si l'une des 2 n'est pas bonne
    if(ok_fin===0 || ok_deb===0){
        //On n'envoit pas le formulaire
        return false;
    }
    else{
        //sinon on envoit
        return true;
    }
}