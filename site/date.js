function date(){
    let mydate=new Date()
    let day=mydate.getDay()
    let month=mydate.getMonth()
    let daym=mydate.getDate()
    if (daym<10)
    daym="0"+daym
    let dayarray=new Array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi")
    let montharray=new Array("Janvier","Fevrier","Mars","Avril ","Mai ","Juin","Juillet ","Aout ","Septembre","Octobre","Novembre","Décembre")
    document.write(dayarray[day]+" "+daym+" "+montharray[month])
}