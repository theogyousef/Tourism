<style>
.footer {
    background-color: #0B2545;
    color: #ffffff;
    padding: 30px 0;
    margin-top: 30px;
    font-family: Arial, sans-serif;
  }
  
  .container-footer {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 20px;
  }
  
  .footer hr {
    border: none;
    border-top: 1px solid #5c5c5c;
    margin: 20px 0;
  }
  
  .footerDetail {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  
  .socialMedia {
    flex-basis: 30%;
    margin-right: 20px;
  }
  
  .socialMedia a {
    color: #ffffff;
  }
  
  .socialMedia a:hover {
    color: red;
  }
  
  .socialMedia h3 {
    color: #ffffff;
    font-size: 24px;
    margin-bottom: 20px;
  }
  
  .socialMediaLogos {
    display: flex;
    gap: 16px;
  }
  
  .company {
    flex-basis: 20%;
  }
  
  .company h4 {
    color: #ffffff;
    font-size: 18px;
    margin-bottom: 10px;
  }
  
  .company ul {
    padding-left: 0;
  }
  
  .company li {
    list-style: none;
    margin-bottom: 5px;
  }
  
  .company a {
    color: #ffffff;
    text-decoration: none;
  }
  
  .company a:hover {
    color: red;
  }
  
  .contactUs {
    flex-basis: 40%;
  }
  
  .contactUs h4 {
    color: #ffffff;
    font-size: 18px;
    margin-bottom: 10px;
  }
  
  .contactUs ul {
    padding-left: 0;
  }
  
  .contactUs li {
    list-style: none;
    margin-bottom: 5px;
  }
  
  .contactUs i {
    vertical-align: middle;
    margin-right: 5px;
  }
  
  .contactUs p {
    display: inline;
  }
  
  .policyWrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
  }
  
  .policies {
    font-size: 12px;
    color: #8f8f8f;
  }
  
  .policies ul {
    padding-left: 0;
    list-style: none;
    display: flex;
    gap: 12px;
  }
  
  .policies li {
    display: inline;
  }
  
  .policies a {
    color: #8f8f8f;
    text-decoration: none;
  }
  
  .policies a:hover {
    color: red;
  }

  @media only screen and (max-width: 576px) {
    .footer {
      background-color: #333333;
      color: #ffffff;
      padding: 30px 0;
      margin-top: 30px;
      font-family: Arial, sans-serif;
  }

  .container-footer {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 20px;
  }

  .footer hr {
      border: none;
      border-top: 1px solid #5c5c5c;
      margin: 20px 0;
  }

  .footerDetail {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
  }

  .socialMedia,
  .company,
  .contactUs {
      flex-basis: 100%; /* Full width on small screens */
      margin-bottom: 20px; /* Add some space between sections */
  }

  .socialMedia a,
  .company a,
  .contactUs i,
  .contactUs p {
      color: #ffffff;
  }

  .socialMedia a:hover,
  .company a:hover {
      color: red;
  }

  .socialMedia h3,
  .company h4,
  .contactUs h4 {
      color: #ffffff;
      font-size: 18px;
      margin-bottom: 10px;
  }

  .socialMediaLogos {
      display: flex;
      flex-direction: row; /* Stack logos on top of each other */
      gap: 16px; /* Add some space between logos */
  }
.row{
  display: flex;
  flex-direction: row; 
}
  .policyWrapper {
      display: flex;
      flex-direction: column; /* Stack policies on top of each other on small screens */
      align-items: center;
      margin-top: 20px;
  }

  .policies {
      font-size: 12px;
      color: #8f8f8f;
      text-align: center; /* Center-align policies on small screens */
  }

  .policies ul {
      padding-left: 0;
      list-style: none;
      display: flex;
      gap: 12px;
      justify-content: center; /* Center-align policy links on small screens */
  }

  .policies li {
      display: inline;
  }

  .policies a {
      color: #8f8f8f;
      text-decoration: none;
  }

  .policies a:hover {
      color: red;
  }
  }    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

<footer class="footer">
  <hr />
  <div class="container-footer">
    <div class="footerDetail">
      <div class="row">
      <div class="socialMedia">
        
        <h3>We make it easy for you</h3>
        <div class="socialMediaLogos">
          <a href="https://www.facebook.com/Pure.fitness.equipment.eg?_rdc=1&_rdr"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="https://www.instagram.com/pure_fitness_equipment/"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
      <div class="company">
        <h4>Company</h4>
        <ul>
          <li><a href="about.php">About us</a></li>
        </ul>
      </div></div>
      <div class="contactUs">
        <h4>Contact Us</h4>
        <ul>
          <li>
            <p>3 El Sheikh Nour El Din St., HELIOPOLIS, Cairo</p>
          </li>
          <li class="contact">
            <i class="fas fa-phone"></i>
            <p>+20-022354514</p>
          </li>
          <li class="contact">
            <i class="far fa-envelope"></i>
            <p>info@PureFitness.com</p>
          </li>
        </ul>
      </div>
    </div>
    <div class="policyWrapper">
      <div class="policies">
        <p>&#169;2023-2024 All Rights Reserved</p>
        <ul>
          <li><a href="#">Privacy Policy</a></li>
          <li><span>|</span></li>
          <li><a href="#">Terms &amp; Conditions</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>