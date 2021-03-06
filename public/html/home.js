var SELECTED_KEY = "";



function submitFormWithSelectedKey(inputClassName, formName){
  console.log("The selected key is", inputClassName);
  elem = document.getElementById(inputClassName);
  console.log("The selected element is", elem);
  elem.value = SELECTED_KEY;
  document.forms[formName].submit();
}

function openNewTabWithSelectedKey(link, key=null){
  // if (SELECTED_KEY == ""){
  //   return False;
  // }
  if (key)
    SELECTED_KEY = key;
  window.open(link+'?id='+SELECTED_KEY,'_blank')
  // window.location.replace('path/to/page.php?orderid=' + orderid);
}

function hello() {
    console.log("Hello world");   // The function returns the product of p1 and p2
}

    // Your Menu Class Name

    var contextMenuClassName = "context-menu",
      contextMenuItemClassName = "context-menu__item",
      contextMenuLinkClassName = "context-menu__link",
      contextMenuActive = "context-menu--active";
    var taskItemInContext,
      clickCoords,
      clickCoordsX,
      clickCoordsY,
      menuItems = menu.querySelectorAll(".context-menu__item");
    var menuState = 0,
      menuWidth,
      menuHeight,
      menuPosition,
      menuPositionX,
      menuPositionY,
      windowWidth,
      windowHeight;

function openContextMenu(e, taskItemClassName, contextMenuClassName, SelectedKey){
    SELECTED_KEY = SelectedKey;
    console.log("Selected key is: ", SELECTED_KEY);
    taskItemInContext = clickInsideElement(e, taskItemClassName);
    if (menuState){
        toggleMenuOff(contextMenuClassName);
    }
    else
    if (taskItemInContext) {
    e.preventDefault();
    toggleMenuOn(contextMenuClassName);
    positionMenu(e);
    } else {
    taskItemInContext = null;
    toggleMenuOff(contextMenuClassName);
    }


    document.body.addEventListener('click', eventToggler);
    document.body.contextMenuClassName = contextMenuClassName;
    document.body.countContext=0;
    function eventToggler(e){
      var contextMenuClassName = e.currentTarget.contextMenuClassName;
      var elem = document.querySelector(contextMenuClassName);
      if (menuState == 1 && (e.target == elem || childOf(e.target, elem) || e.currentTarget.countContext == 0)) {
        console.log("Clicked the Element");
        e.currentTarget.countContext = e.currentTarget.countContext+1;
      } else {
        console.log("Clicked something other than the Element.");
        toggleMenuOff(contextMenuClassName);
        e.currentTarget.countContext = 0;
        document.body.removeEventListener('click', eventToggler);
      }
  }

}



function childOf(/*child node*/c, /*parent node*/p){ //returns boolean
  // console.log("child is ", c);
  // console.log("parent is ", p);
  while((c=c.parentNode)&&c!==p); 
  return !!c; 
}

    /**
     * Turns the custom context menu on.
     */
    function toggleMenuOn(contextMenuClassName) {
        menu = document.querySelector(contextMenuClassName);
        if (menuState !== 1) {
          menuState = 1;
          menu.classList.add(contextMenuActive);
        }
      }
    
      /**
       * Turns the custom context menu off.
       */
      function toggleMenuOff(contextMenuClassName) {
        menu = document.querySelector(contextMenuClassName);
        if (menuState !== 0) {
          menuState = 0;
          menu.classList.remove(contextMenuActive);
        }
      }

      function positionMenu(e) {
        clickCoords = getPosition(e);
        clickCoordsX = clickCoords.x;
        clickCoordsY = clickCoords.y;
        menuWidth = menu.offsetWidth + 4;
        menuHeight = menu.offsetHeight + 4;
    
        windowWidth = window.innerWidth;
        windowHeight = window.innerHeight;
    
        if (windowWidth - clickCoordsX < menuWidth) {
          menu.style.left = windowWidth - menuWidth - 0 + "px";
        } else {
          menu.style.left = clickCoordsX - 0 + "px";
        }
    
        // menu.style.top = clickCoordsY + "px";
    
        if (Math.abs(windowHeight - clickCoordsY) < menuHeight) {
          menu.style.top = windowHeight - menuHeight - 0 + "px";
        } else {
          menu.style.top = clickCoordsY - 0 + "px";
        }
      }

      function getPosition(e) {
        var posx = 0,
          posy = 0;
        if (!e) var e = window.event;
        if (e.pageX || e.pageY) {
          posx = e.pageX;
          posy = e.pageY;
        } else if (e.clientX || e.clientY) {
          posx =
            e.clientX +
            document.body.scrollLeft +
            document.documentElement.scrollLeft;
          posy =
            e.clientY +
            document.body.scrollTop +
            document.documentElement.scrollTop;
        }
        return {
          x: posx,
          y: posy
        };
      }

function clickInsideElement(e, className) {
    // console.log (e);
    var el = e.srcElement || e.target;
    // console.log (el);
    if (el.classList.contains(className)) {
      return el;
    } else {
      while ((el = el.parentNode)) {
        if (el.classList && el.classList.contains(className)) {
          return el;
        }
      }
    }
    return false;
  }

(function() {
    "use strict";
  
    /*********************************************** Context Menu Function Only ********************************/
    function clickInsideElement(e, className) {
      var el = e.srcElement || e.target;
      if (el.classList.contains(className)) {
        return el;
      } else {
        while ((el = el.parentNode)) {
          if (el.classList && el.classList.contains(className)) {
            return el;
          }
        }
      }
      return false;
    }
  
    function getPosition(e) {
      var posx = 0,
        posy = 0;
      if (!e) var e = window.event;
      if (e.pageX || e.pageY) {
        posx = e.pageX;
        posy = e.pageY;
      } else if (e.clientX || e.clientY) {
        posx =
          e.clientX +
          document.body.scrollLeft +
          document.documentElement.scrollLeft;
        posy =
          e.clientY +
          document.body.scrollTop +
          document.documentElement.scrollTop;
      }
      return {
        x: posx,
        y: posy
      };
    }
  
    // Your Menu Class Name
    var taskItemClassName = "list_item";
    var contextMenuClassName = "context-menu",
      contextMenuItemClassName = "context-menu__item",
      contextMenuLinkClassName = "context-menu__link",
      contextMenuActive = "context-menu--active";
    var taskItemInContext,
      clickCoords,
      clickCoordsX,
      clickCoordsY,
      menu = document.querySelector("#context-menu"),
      menuItems = menu.querySelectorAll(".context-menu__item");
    var menuState = 0,
      menuWidth,
      menuHeight,
      menuPosition,
      menuPositionX,
      menuPositionY,
      windowWidth,
      windowHeight;
  
    function initMenuFunction() {
      contextListener();
      clickListener();
      keyupListener();
      resizeListener();
    }
  
    /**
     * Listens for contextmenu events.
     */
    function contextListener() {
      document.addEventListener("contextmenu", function(e) {
        taskItemInContext = clickInsideElement(e, taskItemClassName);
  
        // if (menuState == 1)
        //     toggleMenuOff();
        // else 
        if (taskItemInContext) {
          e.preventDefault();
          toggleMenuOn();
        //   positionMenu(e);
        } else {
          taskItemInContext = null;
          toggleMenuOff();
        }
      });
    }
  
    /**
     * Listens for click events.
     */
    function clickListener() {
      document.addEventListener("click", function(e) {
        var clickeElIsLink = clickInsideElement(e, contextMenuLinkClassName);
  
        if (clickeElIsLink) {
          e.preventDefault();
          menuItemListener(clickeElIsLink);
        } else {
          var button = e.which || e.button;
          if (button === 1) {
            toggleMenuOff();
          }
        }
      });
    }
  
    /**
     * Listens for keyup events.
     */
    function keyupListener() {
      window.onkeyup = function(e) {
        if (e.keyCode === 27) {
          toggleMenuOff();
        }
      };
    }
  
    /**
     * Window resize event listener
     */
    
    function resizeListener() {
      window.onresize = function(e) {
        toggleMenuOff();
      };
    }
  
    /**
     * Turns the custom context menu on.
     */
    function toggleMenuOn() {
      if (menuState !== 1) {
        menuState = 1;
        menu.classList.add(contextMenuActive);
      }
    }
  
    /**
     * Turns the custom context menu off.
     */
    function toggleMenuOff() {
      if (menuState !== 0) {
        menuState = 0;
        menu.classList.remove(contextMenuActive);
      }
    }
  
    function positionMenu(e) {
      clickCoords = getPosition(e);
      clickCoordsX = clickCoords.x;
      clickCoordsY = clickCoords.y;
      menuWidth = menu.offsetWidth + 4;
      menuHeight = menu.offsetHeight + 4;
  
      windowWidth = window.innerWidth;
      windowHeight = window.innerHeight;
  
      if (windowWidth - clickCoordsX < menuWidth) {
        menu.style.left = windowWidth - menuWidth - 0 + "px";
      } else {
        menu.style.left = clickCoordsX - 0 + "px";
      }
  
      // menu.style.top = clickCoordsY + "px";
  
      if (Math.abs(windowHeight - clickCoordsY) < menuHeight) {
        menu.style.top = windowHeight - menuHeight - 0 + "px";
      } else {
        menu.style.top = clickCoordsY - 0 + "px";
      }
    }
  
    function menuItemListener(link) {
      var menuSelectedPhotoId = taskItemInContext.getAttribute("data-id");
      console.log("Your Selected Photo: " + menuSelectedPhotoId);
      var moveToAlbumSelectedId = link.getAttribute("data-action");
      if (moveToAlbumSelectedId == "remove") {
        console.log("You Clicked the remove button");
      } else if (moveToAlbumSelectedId && moveToAlbumSelectedId.length > 7) {
        console.log("Clicked Album Name: " + moveToAlbumSelectedId);
      }
      toggleMenuOff();
    }
    initMenuFunction();
  })();
  

  function openModal(modalClassName) {
	  console.log(modalClassName)
    var modal = document.querySelector(modalClassName);
    modal.style.display = 'block';
    
    $.ajax({
      type: "POST",
      url: "./public/html/getDetails.php",
      data: {"Student_ID": SELECTED_KEY, "modalClassName": modalClassName},
      dataType:'JSON', 
      success: function(response){
          console.log(response);
          if (response["modalClassName"] == "#student-accompanying-modal"){
            document.getElementById("StudentID_accompanyForm").value = response['Student_ID'];
            document.getElementById("StudentName_accompanyForm").value = response['Student_Name'];
            document.getElementById("Class_accompanyForm").value = response['Student_Class_ID'];
            document.getElementById("GuardianID_accompanyForm").value = response['Student_Guardian_ID'];
            $.ajax({
              type: "POST",
              url: "./public/html/getDetails.php",
              data: {"Guardian_ID": response['Student_Guardian_ID'], "modalClassName": modalClassName},
              dataType:'JSON', 
              success: function(response2){
                  console.log(response2);
                  if (response2["modalClassName"] == "#student-accompanying-modal"){
                    document.getElementById("GuardianName_accompanyForm").value = response['Guardian_Name'];
        
                  }
                  // put on console what server sent back...
              }
            });
          }
          else if (response["modalClassName"] == "#class-change-modal"){
            document.getElementById("StudentID_classChangeForm").value = response['Student_ID'];
            document.getElementById("CurrentClass_classChangeForm").value = response['Student_Class_ID'];
          }
          // put on console what server sent back...
      }
    });


    
  }

  function closeModal(modalClassName) {
    var modal = document.querySelector(modalClassName);
    modal.style.display = 'none';
    
  }



  function displayCard(cardClassName){
    console.log(cardClassName);
    var card = document.querySelector(cardClassName);
    card.style.display = 'block'; 
  }

  function destroyCard(cardClassName){
    console.log(cardClassName);
    var card = document.querySelector(cardClassName);
    card.style.display = 'none'; 
  }