const btn = document.querySelector('#btn');
const grp2 = document.querySelector('#grp2');

btn.addEventListener('click', ()=>{
    if(grp2.style.display == 'block'){
        grp2.style.display = 'none';
    }else {   
         grp2.style.display = 'block';
    }

});



