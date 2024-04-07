document.getElementById('searchForm').addEventListener('submit', function(event) {
  event.preventDefault();
  // Get the user inputs
  const formData = {
      streetName: document.getElementById('streetName').value,
      streetNumber: document.getElementById('streetNumber').value,
      Town: document.getElementById('Town').value,
      lastName: document.getElementById('lastName').value,
      historicalDistrict: document.getElementById('Historical District').value,
      village: document.getElementById('Village').value,
      stillExists: document.getElementById('stillExists').checked,  //turns it to true or false so it match db
      sideOfRoad: document.getElementById('sideOfRoad').value,
      Architect: document.getElementById('Architect').value,
      Style: document.getElementById('ArchitectStyle').value
  };


  fetch('http://localhost:3000/dbsearch/form', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(formData)
})
.then(response => response.json())
.then(data => {
    console.log(data);
})
.catch(error => {
    console.error('Error:', error);
  });
});


// Convert form data to query string--- this is one way to do it but it lacks the representational values in the query

const queryString = new URLSearchParams(formData).toString();  
console.log(queryString);

 // fetch method with form data as query parameters
 fetch(`http://localhost:3000/dbsearch?${queryString}`)
      .then(response => response.json())
       .then(data => {
          console.log(`This is data from the database:`, data);
       })
      .catch(error => {
          console.error('error fetching search info', error);
      });


//fetch main_build data works

 fetch('http://localhost:3000/dbsearch')
  .then(response => response.json())
  .then(data => {
     console.log(`This is data from the database:`,data)
    return data;
   })
   .catch(error=>{
     console.error('error fetching search info',error);
});
