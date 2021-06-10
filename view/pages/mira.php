<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<style>
:root {
  --color-lightest: #f9fdfe;
  --color-gray-light: #cdcfcf;
  --color-gray-medium: #686a69;
  --color-gray-dark: #414643;
  --color-darkest: #2a2f2c;
}

*,
::before,
::after {
  margin: 0;
  box-sizing: border-box;
}

/* Heydon Pickering’s lobotomized owl. Details: https://bit.ly/1H7MXUD */
* + * {
  margin-top: 1rem;
}

/* Set up fonts, colors and all that jazz. */
body {
  background: var(--color-lightest);
  color: var(--color-gray-medium);
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica,
    Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 18px;
  line-height: 1.45;
}

/* Headings use a different font because they’re hipsters. */
h1,
h2 {
  color: var(--color-darkest);
  font-size: 110%;
  line-height: 1.1;
}

h1 {
  font-size: 125%;
}

/* Set up general layout rules for outer containers. */
.contact-form,
.results {
  width: 90vw;
  max-width: 550px;
  margin: 8vh auto;
}

p {
  margin-top: 0.5rem;
  font-size: 87.5%;
}

.results pre {
  margin-top: 1rem;
  padding: 0.5rem 1rem;
  background: $color-lightest;
  border: 1px solid var(--color-gray-light);
  overflow-x: scroll;
}

.contact-form form {
  position: relative;
  display: block;
  margin: 0;
  padding: 1rem 0 2rem;
  border-top: 1px solid var(--color-gray-light);
  border-bottom: 1px solid var(--color-gray-light);
  overflow: hidden;
}

.input-group {
  margin-top: 0.25rem;
  padding: 0.5rem 1rem;
}

.contact-form label {
  display: block;
  color: $color-gray-dark;
  font-family: Lato, sans-serif;
  font-size: 90%;
  line-height: 1.125;
}

.group-label {
  display: inline-block;
  margin-right: 1rem;
  font-size: 90%;
}

.contact-form label.inline {
  display: inline-block;
  margin-left: 0.25rem;
}

.contact-form input,
.contact-form select,
.contact-form textarea{
  display: block;
  margin-top: 0.25rem;
  padding: 0.5rem 0.75rem;
  border: 1px solid $color-gray-light;
  width: 100%;
  font-family: "Open Sans", sans-serif;
  font-size: 1rem;
  transition: 150ms border-color linear;
}

.contact-form input[type=checkbox],
.contact-form input[type=radio] {
  display: inline-block;
  width: auto;
}

.contact-form input[type=checkbox]:not(:first-of-type),
.contact-form input[type=radio]:not(:first-of-type) {
  margin-left: 1rem;
}

.contact-form input:focus,
.contact-form input:active {
  border-color: var(--color-gray-medium);
}

.contact-form button {
  display: block;
  margin: 0.5rem 1rem 0;
  padding: 0 1rem 0.125rem;
  background-color: var(--color-gray-medium);
  border: 0;
  color: var(--color-lightest);
  font-family: lato, sans-serif;
  font-size: 100%;
  letter-spacing: 0.05em;
  line-height: 1.5;
  text-transform: uppercase;
  transition: 150ms all linear;
}

.contact-form button:hover,
.contact-form button:active,
.contact-form button:focus {
  background: var(--color-darkest);
  cursor: pointer;
}
</style>
<section class="contact-form">
  <h1>Send Me a Message</h1>
  <p>Use this handy contact form to get in touch with me.</p>
  
  <form>
    <div class="input-group">
      <input id="salutation-mr" name="salutation" type="radio" value="Mr."/>
      <label class="inline" for="salutation-mr">Mr.</label>
      
      <input id="salutation-mrs" name="salutation" type="radio" value="Mrs."/>
      <label class="inline" for="salutation-mrs">Mrs.</label>
      
      <input id="salutation-ms" name="salutation" type="radio" value="Ms."/>
      <label class="inline" for="salutation-ms">Ms.</label>
    </div>
    
    <div class="input-group">
      <label for="name">Full Name</label>
      <input id="name" name="name" type="text"/>
    </div>
    
    <div class="input-group">
      <label for="email">Email Address</label>
      <input id="email" name="email" type="email"/>
    </div>
    
    <div class="input-group">
      <label for="subject">How can I help you?</label>
      <select id="subject" name="subject">
        <option>I have a problem.</option>
        <option>I have a general question.</option>
      </select>
    </div>
    
    <div class="input-group">
      <label for="message">Enter a Message</label>
      <textarea id="message" name="message" rows="6" cols="65"></textarea>
    </div>
    
    <div class="input-group">
      <p class="group-label">Please send me:</p>
      <input id="snacks-pizza" name="snacks" type="checkbox" value="pizza"/>
      <label class="inline" for="snacks-pizza">Pizza</label>
      <input id="snacks-cake" name="snacks" type="checkbox" value="cake"/>
      <label class="inline" for="snacks-cake">Cake</label>
    </div>
    <input name="secret" type="hidden" value="1b3a9374-1a8e-434e-90ab-21aa7b9b80e7"/>
    <button type="submit" onclick='handleFormSubmit();'>Send It!</button>
  </form>
</section>

<div class="results">
  <h2>Form Data</h2>
  <pre></pre>
</div>

<script>
function handleFormSubmit(event) {
  event.preventDefault();
  
  const data = new FormData(event.target);
  
  const formJSON = Object.fromEntries(data.entries());

  // for multi-selects, we need special handling
  formJSON.snacks = data.getAll('snacks');
  
  const results = document.querySelector('.results pre');
  results.innerText = JSON.stringify(formJSON, null, 2);

  return fetch(`http://localhost/smartschool.gongetz.com/new.php`, {
    method: 'post',
    body: results.innerText
  })

  .then(response => response.text())
  .then(text => {
    try {
        console.log(text);
        // Do your JSON handling here
    } catch(err) {
       // It is text, do you text handling here
    }
  });
}

const form = document.querySelector('.contact-form');
form.addEventListener('submit', handleFormSubmit);

</script>
