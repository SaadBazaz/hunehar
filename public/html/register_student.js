
var stepIDs = ['#Step_1', '#Step_2', '#Step_3', '#Step_4'];
var stepBodies = ['#Step_1_body', '#Step_2_body', '#Step_3_body', '#Step_4_body']

for (var i=0; i<4; i++){
    console.log(stepIDs[i])
document.getElementById(stepIDs[i])
        .addEventListener('click',LoadStep);
}




function LoadStep(event, id=null, fromid=null){
            // do something
            console.log(id)
            var myId;
            var element;
            
            if (event)
                if (event.target){
                    myId = event.target.id;
                    element = event.target.element;
                    
                    if (myId && !document.getElementById(myId).classList.contains("active")){
                        console.log("Not allowed yet!")
                        return false;
                    }
                    else{
                        console.log("Allowed")
                    }
                }
            if (id){
                myId = id;
                if (!document.getElementById(myId).classList.contains("active")){
                    document.getElementById(myId).classList.add("active");
                }
                if (!document.getElementById(fromid).classList.contains("done")){
                    document.getElementById(fromid).classList.add("done");
                }
            }
            if (myId == ""){
                console.log("Bogus click")
                return false;
            }


            

            if (myId != ""){
                for (var i=0; i<4; i++){
                    if (stepIDs[i] != myId)
                        document.getElementById(stepBodies[i]).style.display = "none";
                    else{
                        document.getElementById(stepBodies[i]).style.display = "block";
                        topFunction();
                    }

                }
            }
            // console.log("hello", event.target.id);
            
}

function UnlockNextStep(StepID){
    var element = document.getElementById(StepID);
    element.setAttribute('onclick','hello()');
    element.classList.add("active");
}

//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}