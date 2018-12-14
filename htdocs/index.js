var bar=document.getElementsByClassName('bar');

window.onload=function(){
    for(var i=0;bar[i];i++){
        if(bar[i].offsetWidth!=0&&bar[i].offsetWidth<bar[i].offsetHeight){
            bar[i].style.width=bar[i].offsetHeight;
            console.log(bar[i].style.width+"");
        }
        console.log("checking");
    }
}