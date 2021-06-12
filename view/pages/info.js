var pageCounter = 1;
var animalContainer = document.getElementById("animal-info");
var btn = document.getElementById("btn");

btn.addEventListener("click", function() {
  var ourRequest = new XMLHttpRequest();
  ourRequest.open('GET', 'http://localhost/smartschool.gongetz.com/read.json');
  ourRequest.onload = function() {
    if (ourRequest.status >= 200 && ourRequest.status < 400) {
      var ourData = JSON.parse(ourRequest.responseText);
      renderHTML(ourData);
    } else {
      console.log("We connected to the server, but it returned an error.");
    }
    
  };

  ourRequest.onerror = function() {
    console.log("Connection error");
  };

  ourRequest.send();
  pageCounter++;
  if (pageCounter > 3) {
    btn.classList.add("hide-me");
  }
  
});

function renderHTML(data) {
  var htmlString = "";

  htmlString += "<p> school id" + data.School_id + " subject id " + data.Subject_id + " created by " + data.Created_by + " question :" ;
  
  for (i = 0; i < data.Quiz.length; i++) {
      htmlString += data.Quiz[0].Type;
  }

  htmlString += '.</p>';


  animalContainer.insertAdjacentHTML('beforeend', htmlString);
}