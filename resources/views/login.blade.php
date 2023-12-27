@include('header')
@include('nav')

<div class="container mt-5 mb-4" style="height: 70vh;">
    <div class="container text-center mx-auto">
        <h2>Login</h2>
    </div>
    <form id="loginForm">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="userRole" class="form-label">Select Role</label>
            <select class="form-select" id="userRole" name="userRole" style="width: 100%;">
                <option value="Student">Student</option>
                <option value="SuperAdmin">SuperAdmin</option>
                <option value="Admin">Admin</option>
            </select>
        </div>
        <a href="/register"
            style="text-decoration: none; color: #007bff; display: block; text-align: center; margin-top: 10px;">
            Not Have An Account?
        </a>
        <button type="button" class="button1 btn btn-light d-block mx-auto" onclick="submitForm()"
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function submitForm() {
            // Change button text to "Loading..."
            var loginButton = document.querySelector('.button1');
            loginButton.textContent = 'Loading...';

            var selectedRole = document.getElementById('userRole').value;
            var apiUrl;

            switch (selectedRole) {
                case 'Student':
                    apiUrl = '{{ env('API_ENDPOINT') }}/stu/login';
                    break;
                case 'SuperAdmin':
                    apiUrl = '{{ env('API_ENDPOINT') }}/superadmin/login';
                    break;
                case 'Admin':
                    apiUrl = '{{ env('API_ENDPOINT') }}/admin/login';
                    break;
                default:
                    // Handle default case if needed
                    break;
            }

            var formData = {
                email: document.getElementById('exampleInputEmail1').value,
                password: document.getElementById('exampleInputPassword1').value
            };

            // Make fetch request to the selected API endpoint
            fetch(apiUrl, {
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
                        // Store the email and user details in localStorage
                        localStorage.setItem('userEmail', formData.email);
                        localStorage.setItem('userToken', data.User.token);
                        localStorage.setItem('userId', data.User.userId);
                        localStorage.setItem('userRole', data.User.role);


                        // Change button text to "Redirecting..."
                        loginButton.textContent = 'Redirecting...';

                        // Redirect to the appropriate page after 2 seconds
                        setTimeout(() => {
                            switch (data.User.role) {
                                case 'admin':
                                    window.location.href = '/admin';
                                    break;
                                case 'student':
                                    window.location.href = '/';
                                    break;
                                case 'superadmin':
                                    window.location.href = '/superadmin';
                                    break;
                                default:
                                    // Handle other roles or unexpected values
                                    console.error('Invalid user role:', data.User.role);
                                    break;
                            }
                        }, 2000);
                    } else {
                        // Display an error message
                        alert('Login failed. ' + data.message);
                        // Reset button text to "Login"
                        loginButton.textContent = 'Login';
                    }

                    console.log('API Response:', data);
                })
                .catch(error => {
                    // Handle errors, show an error message or log the error
                    console.error('Error:', error);
                    // Reset button text to "Login"
                    loginButton.textContent = 'Login';
                });
        }

        // Add click event listener to the login button
        document.querySelector('.button1').addEventListener('click', submitForm);
    });
</script>



@include('footer')
