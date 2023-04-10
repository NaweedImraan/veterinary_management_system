<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
}

.about-section {
  padding: 50px;
  text-align: center;
  background-color: #474e5d;
  color: white;
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}
</style>
</head>
  <title>About Us Page</title>
<body>

<div class="about-section">
  <h1>About Us Page</h1>
  <h2>In our Veterinary Management Clinic, we have a 25 year history of connecting, caring and curing your companion animals.</h2>
  <p>Bound by an organizational culture - one that fosters respect and compassion to all animals and their human caretakers - PetVet sets itself apart from other veterinary services in the country by treating your companion animals with the kind of care, love and kindness we show towards our own fur babies.</p>
</div>

<h2 style="text-align:center">Our Team</h2>
<div class="row">
  <div class="column">
    <div class="card">
      <img src="img/doc1.jpg" alt="Jane" style="width:67%">
      <div class="container">
        <h2>Jane Doe</h2>
        <p class="title">CEO & Founder</p>
        <p><button class="button">jane@example.com</button></p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="img/doc2.jpg" alt="Mike" style="width:67%">
      <div class="container">
        <h2>Mike Ross</h2>
        <p class="title">Head of Veterinary Practice & Surgery</p>
        <p><button class="button">mike@example.com</button></p>
      </div>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <img src="img/doc3.jpg" alt="John" style="width:100%">
      <div class="container">
        <h2>John Doe</h2>
        <p class="title">Surgeon</p><p><button class="button">john@example.com</button></p>
      </div>
    </div>
  </div>
</div>

  <div class="row">
    <div class="column">
      <div class="card" style="height: 250px; width: 500px;">
        
  <h2>Opening Hours: </h2>
  <h3>Week Days: Morning 08:00 am to Evening 10:30 pm</h3>
  <h3>Weekends: Morning 09:00 am to Evening 05:00  pm</h3>

      </div>
    </div>
    
<div class="column" >
  <div class="card" style="height: 250px; width: 500px;">
    <div class="col-md-6 ">
  <h2>Contact Details: </h2>
  <h3>Veterinary Management CO. & Ltd.</h3>
  <h4>No.05, Main Street, Batticaloa.</h4>
  <h4>Phone: +94 77 123 4567</h4>
  <h4>Fax: +94 81 153 2467</h4>

</div>
  </div>
</div>

  </div>




</body>
</html>
