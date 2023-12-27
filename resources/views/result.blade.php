@include('header')
@include('nav')

<script>
    var userEmail = localStorage.getItem('userEmail');
    if (userEmail == null) {
        window.location.href = '/login';
    }
</script>

<div class="container mt-5 mb-4" style="height: 70vh;">
    <!-- Additional Info Section -->
    <div class="d-flex justify-content-end mt-3">
        <div class="mr-3">Total Credits: Fetching...</div>
        <script>
            // JavaScript code to handle button click and API request
            window.addEventListener('load', function() {
                // Get user token from localStorage
                var userToken = localStorage.getItem('userToken');

                // Fetch credits from the API
                fetch('{{ env('API_ENDPOINT') }}/stu/fetchCredit', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'token': userToken,
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the API response data as needed
                        if (data.success) {
                            // Update total credits on the page
                            var totalCreditsElement = document.querySelector(
                                '.d-flex.justify-content-end.mt-3 .mr-3');
                            totalCreditsElement.textContent = 'Total Credits: ' + data.credit;

                            // You can also store the credits in a variable if needed elsewhere in your code
                            // var userCredits = data.credit;
                        } else {
                            // Display an error message
                            alert('Failed to fetch credits. ' + data.message);
                        }
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });

        </script>
    </div>
    {{-- <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div> --}}
    <h5>Click Here to see Your result : </h5> <br>
    <button id="apiButton" class="btn btn-primary">Show Result</button>
</div>

<script>
    // JavaScript code to handle button click and API request
    document.getElementById('apiButton').addEventListener('click', function() {
        // Get user token from localStorage
        var userToken = localStorage.getItem('userToken');

        // Make API request with user token in the header
        fetch('{{ env('API_ENDPOINT') }}/stu/showResult', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'token': userToken,
                }
            })
            .then(response => response.json())
            .then(data => {
                // Handle the API response data as needed
                if (data.success) {
                    // alert(data.message)
                    if (data.message == "You don't have Enough Credits to view the result") {
                        var userConfirmed = window.confirm(data.message +
                            " You Must pay the fees to show Your Result Pay Fees?");

                        // Check the user's choice and perform the action accordingly
                        if (userConfirmed) {
                            // alert("Action performed!");
                            window.location.href = '/razorpay/payment';
                            // Perform your action here
                        } else {
                            alert("Action canceled.");
                            // Perform an alternative action or do nothing
                        }
                    } else {
                        alert("congratulations. You Can View the Result ");
                    }

                } else {
                    // Display an error message
                    alert('Failed. ' + data.message);
                }
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>



@include('footer')
