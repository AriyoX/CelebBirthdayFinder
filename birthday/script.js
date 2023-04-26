const form = document.querySelector('#birthday-form');

// Add an event listener to the form for form submission
form.addEventListener('submit', (event) => {
  // Prevent the default form submission behavior
  event.preventDefault();

  // Get the user input values
  const name = nameInput.value.trim();
  const birthday = birthdayInput.value.trim();
  const type = typeInput.value.trim();

  // Validate the user input
  if (!name || !birthday || !type) {
    alert('Please enter your name, birthday, and type of celebrity.');
    return;
  }

  // Validate the date of birth using a regular expression
  const datePattern = /^(19|20)\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/;
  if (!datePattern.test(birthday)) {
    alert('Please enter a valid date of birth in the format YYYY-MM-DD.');
    return;
  }

  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();

  // Set up the XMLHttpRequest object to submit the form data
  xhr.open('POST', 'process.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  // Set up a callback function for when the request completes
  xhr.onload = function() {
    // Parse the response data as JSON
    const response = JSON.parse(xhr.responseText);

    // Check if the request was successful
    if (xhr.status === 200 && response.success) {
      // Display the list of celebrities who share the user's birthday
      const message = `${name} success!`;
      alert(message);
    } else {
      // Display an error message if the request was not successful
      alert('An error occurred while processing your request. Please try again later.');
    }
  };

  // Send the form data to the server
  xhr.send(`name=${name}&birthday=${birthday}&type=${type}`);
});

