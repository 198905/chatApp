var formMessage=document.querySelector('.messageC');
var formbouton=document.querySelector('.messageEnvoyer');

formMessage.addEventListener("input", () => {
  if (formMessage.value.trim() !== "") {
    formbouton.style.display = "inline-block";
  } else {
    formbouton.style.display = "none";
  }

  
});

//display
async function loadGetMessages() {
    const response = await fetch('get.php');
    const text = await response.text();
    document.querySelector('.messages').innerHTML = text;
    
    var myDiv = document.querySelector('.messages');

    myDiv.scrollTop = myDiv.scrollHeight;
  }
  setInterval(loadGetMessages, 500);

//write without refreshing

var form = document.getElementById("form");
form.addEventListener('submit', function(event) {
    event.preventDefault(); 

    var formData = new FormData(form);

    fetch('model.php', {
        method: 'POST',
        body: formData
    })
    .then(function(response) {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Network response was not ok');
        }
    })
    .then(function(data) {
        if (data.success) {
            alert('Insert successful');
        } else {
            alert('Insert failed');
        }
    })
    .catch(function(error) {
        // Handle errors that occur during the fetch request
        console.error('Fetch Error: ' + error.message);
    });
}); 

  