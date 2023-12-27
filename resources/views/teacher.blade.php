@include('header')
@include('nav')

<script>
    var userEmail = localStorage.getItem('userEmail');
    if (userEmail == null) {
        window.location.href = '/login';
    }
    var credits = 0;
</script>

<div class="container mt-5 mb-5">
    <div class="mr-3" id="credit_label">Total Credits: Fetching...</div>
    <div class="input-group mt-4">
        <input type="search" class="form-control rounded" placeholder="Search By Email OR Phone" aria-label="Search"
            aria-describedby="search-addon" id="searchInput" />
        <button type="button" style="margin-left: 12px;" class="btn btn-outline-primary" data-mdb-ripple-init
            onclick="searchUsers()">Search</button>
    </div>

    <div class="container mt-5 mb-5">
        <table class="table" id="userTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody"></tbody>
        </table>
        <h3 id="msg"></h3>
    </div>

</div>

<script>
    var Teacherdata = null;

    function searchUsers() {
        console.log(credits);
        if (credits >= {{ env('APP_CREDIT_VALUE') }}) {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const filteredData = Teacherdata.data.filter(user => {
                return (
                    user.email.toLowerCase().includes(searchInput) ||
                    user.phone.includes(searchInput)
                );
            });

            // Get the tbody element where the data will be inserted
            const tbody = document.getElementById('userTableBody');
            tbody.innerHTML = ''; // Clear existing rows

            // Iterate through the filtered data and create table rows
            if (filteredData.length == 0) {
                document.getElementById("msg").innerHTML = "Not Found";
                console.log('not found');
            } else {
                document.getElementById("msg").innerHTML = "";
                document.getElementById('userTable').style.display = 'table';
                filteredData.forEach(user => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                    <th scope="row">${user.id}</th>
                    <td>${user.fullname}</td>
                    <td>${user.phone}</td>
                    <td>${user.email}</td>
                    <td>
                        <a href="teacher/${user.id}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Show
                        </a>
                    </td>
                `;
                    tbody.appendChild(tr);
                });

                fetch('{{ env('API_ENDPOINT') }}/stu/decreaseCredit', {
                        method: 'POST', // or 'GET' depending on your API
                        headers: {
                            'Content-Type': 'application/json',
                            'token': localStorage.getItem('userToken')
                            // Include any other headers that your API requires
                        },
                        // Include any request body if required by your API
                        // body: JSON.stringify({ key: 'value' }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response if needed
                        console.log('API response:', data);
                        credits = data.credit;
                        var totalCreditsElement = document.querySelector(
                            '#credit_label');
                        totalCreditsElement.textContent = 'Total Credits: ' +credits;
                    })
                    .catch(error => console.error('Error hitting the API:', error));

            }
        } else {
            console.log("insufficiant balance");
            document.getElementById("msg").innerHTML = "insufficiant Credit";
        }

    }

    fetch('{{ env('API_ENDPOINT') }}/stu/fetchTeachers', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'token': localStorage.getItem('userToken')
                // Include any other headers that your API requires
            },
            // Include any request body if required by your API
            // body: JSON.stringify({ key: 'value' }),
        })
        .then(response => response.json())
        .then(data => {
            // Get the tbody element where the data will be inserted
            const tbody = document.getElementById('userTableBody');
            Teacherdata = data;
            // Iterate through the data and create table rows
            console.log(data);
            // data.data.forEach(user => {
            //     const tr = document.createElement('tr');

            //     tr.innerHTML = `
            //             <th scope="row">${user.id}</th>
            //             <td>${user.fullname}</td>
            //             <td>${user.phone}</td>
            //             <td>${user.email}</td>
            //             <td>
            //                 <a href="teacher/${user.id}" class="btn btn-primary">
            //                     <i class="bi bi-pencil"></i> Show
            //                 </a>
            //             </td>
            //         `;

            //     tbody.appendChild(tr);
            // });
        })
        .catch(error => console.error('Error fetching data:', error));
</script>

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
                    credits = data.credit;
                    var totalCreditsElement = document.querySelector(
                        '#credit_label');
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

@include('footer')
