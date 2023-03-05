function date(){
    var mydate=new Date()
    var day=mydate.getDay()
    var month=mydate.getMonth()
    var daym=mydate.getDate()
    if (daym<10)
    daym="0"+daym
    var dayarray=new Array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi")
    var montharray=new Array(" Janvier "," Fevrier "," Mars ","Avril ","Mai ","Juin","Juillet ","Aout ","Septembre "," Octobre "," Novembre "," Décembre ")
    document.write("   "+dayarray[day]+" "+daym+" "+montharray[month]+" ")
}