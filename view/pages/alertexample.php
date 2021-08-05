<style>
body {
  font-family: Arial;
}

input[aria-invalid='false'] {
  border: 3px solid green;
}
input[aria-invalid='true'] {
  border: 3px solid red;
}

.form-row {
  margin-bottom: 20px;
}

.error {
  display: none;
  color: red;
  font-weight: bold;
  p {
    margin: 0;
  }
}

.info {
  background: #ccc;
  padding: 20px;
  h2 {
    margin: 0 10px;
  }
  code {
    font-size: 18px;
    font-weight: bold;
  }
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<h1>Example of aria-invalid in simple form validation</h1>

<div class="form-row">
  <label for="name">Full name</label>
  <input type="text" id="name" name="name" aria-required="true" aria-invalid="false" data-rule="name">
  <div class="error" id="nameErrorMessage" aria-hidden="true"  role="alert">
    <p>Whoops! Please enter your name!</p>
  </div>
</div>

<div class="form-row">
  <label for="email">Email</label>
  <input name="email" id="email" aria-required="true" aria-invalid="false" data-rule="email">
  <div class="error" id="emailErrorMessage" aria-hidden="true" role="alert">
    <p>Whoops, please enter your email!</p>
  </div>
</div>

<div class="info">
  <h2>Checklist</h2>
  <ul>
    <li>Error message with an ID</li>
    <li>Error messages with <code>aria-hidden="true"</code> and <code>role="alert"</code> on page load (not applied dynamically)</li>
  </ul>
  <h2>Here's what happens</h2>
  <ol>
    <li>User creates erroneous input</li>
    <li><code>aria-invalid="true"</code> is applied to the input</li>
    <li>The error message is displayed</li>
    <li><code>aria-hidden</code> on the error message is set to <code>true</code></li>
    <li><code>aria-describedby</code> is added to the input, with the value of the ID of the error message</li>
  </ol>
</div>
<script>
(function(win, undefined) {
 $(function() {
    var rules = {
      email: function(node) {
        var inputText = node.value,
				    inputRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
        
			  return inputRegex.test(inputText);
      },
      name: function(node) {
        var inputText = node.value,
				    inputRegex = /^\s*[a-zA-Z0-9,\s]+\s*$/;
				
			 return inputRegex.test(inputText);
      }
    };
    
    function onFocusOut() {
      validate(this);
    }
    
    function validate(node) { 
     var valid = isValid(node),
         $error = $(node).next('.error'); 
      
      if (valid) {
        $(node).attr('aria-invalid', false);
        $error
          .attr('aria-hidden', true)
          .hide();
        $(node).attr('aria-describedby', '');
      } else {
        $(node).attr('aria-invalid', true);
        $error
          .attr('aria-hidden', false)
          .show();
        $(node).attr('aria-describedby', $error.attr('id'));
      }
    }
    
    function isValid(node) {
      return rules[node.dataset.rule](node);
    }
    
    $('[aria-invalid]').on('focusout', onFocusOut);
  });
}(window));
</script>