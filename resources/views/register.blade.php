@include('header')
@include('nav')

<div class="container mt-5 mb-4" style="height: 70vh;">
    <div class="container text-center mx-auto">
        <h2>Student Registration</h2>
    </div>
    <form>
        <div class="mb-3">
            <label for="Name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="Name" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <a href="/login"
            style="text-decoration: none; color: #007bff; display: block; text-align: center; margin-top: 10px;">
            Already Have Account? Login
        </a>
        <button class="button1 btn btn-light d-block mx-auto"
            style="font-weight: bold;
        font-size: 20px;
        margin-top: 20px;
        color: white;
        background-color: #fc937b;
        width: 22%;
        border-radius: 50px;">
            Submit
        </button>

    </form>
</div>

<!-- Add this script to your HTML file, preferably just before the closing </body> tag -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find the form element
        const form = document.querySelector('form');

        // Add an event listener for the form submission
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get form data
            const formData = {
                name: document.querySelector('[name="name"]').value,
                email: document.querySelector('[name="email"]').value,
                password: document.querySelector('[name="password"]').value
            };

            // Make a POST request to your API
            fetch('http://localhost:8000/stu/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData),
                })
                .then(response => response.json())
                .then(data => {
                    // Handle the API response here, you can redirect or show a success message
                    if (data.success) {
                        // Store the email in localStorage
                        localStorage.setItem('userEmail', formData.email);
                        localStorage.setItem('userToken', data.User.token);

                        // Redirect to another page
                        window.location.href =
                        '/login'; // Change the URL to the desired page
                    } else {
                        // Display an error message
                        alert('Registration failed '+data.message);
                    }

                    console.log('API Response:', data);
                })
                .catch(error => {
                    // Handle errors, show an error message or log the error
                    console.error('Error:', error);
                });
        });
    });
</script>




@include('footer')
