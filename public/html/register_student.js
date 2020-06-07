function LoadStep(){

}

function UnlockNextStep(StepID){
    var element = document.getElementById(StepID);
    element.setAttribute('onclick','hello()');
    element.classList.add("active");
}