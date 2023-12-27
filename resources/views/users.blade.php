@include('header')
@include('nav')

<script>
    var userEmail = localStorage.getItem('userEmail');
    var userRole = localStorage.getItem('userRole');
    // if (userEmail == null || userRole != 'superadmin') {
    //     window.location.href = '/login';
    // }
    if (userRole == 'admin' || userRole == 'superadmin') {

    } else {
        window.location.href = '/login';

    }
</script>

<div class="container mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Credits</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="userTableBody"></tbody>
    </table>

    <!-- Bootstrap JS (you need to include this) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to open the modal and populate the form with user details
        function openEditModal(userId) {
            // Open the modal
            $('#editModal').modal('show');

            // Populate the form with user details using the userId
            // You can fetch additional details from the server if needed
            // For simplicity, let's assume there is a form with ID 'editForm'
            const editForm = document.getElementById('editForm');
            editForm.querySelector('#userId').value = userId;
            // Add additional code to populate other form fields based on the user ID
        }

        // Fetch data from the API using POST method
        fetch('{{ env('API_ENDPOINT') }}/admin/users-list', {
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

                // Iterate through the data and create table rows
                console.log(data);
                data.data.forEach(user => {
                    const tr = document.createElement('tr');

                    tr.innerHTML = `
                        <th scope="row">${user.id}</th>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.credits}</td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="openEditModal(${user.id})">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                        </td>
                    `;

                    tbody.appendChild(tr);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>

    <!-- Modal for editing user -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Promote Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <!-- Your form goes here -->
                    <form id="editForm">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Credit</label>
                            <input type="number" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" name="credit">
                        </div>

                        <input type="hidden" id="userId" name="userid" value="">
                        <!-- Add other form fields for editing user details -->
                        <!-- For example: <input type="text" id="userName" name="userName" value=""> -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    document.getElementById('saveChangesBtn').addEventListener('click', function() {
        // Get data from the form
        const editForm = document.getElementById('editForm');
        const userId = editForm.querySelector('#userId').value;
        const credits = editForm.querySelector('#exampleInputEmail1').value;

        // Send a POST request to the server
        fetch('{{ env('API_ENDPOINT') }}/superadmin/update-credits', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'token': localStorage.getItem('userToken')
                    // Include any other headers that your API requires
                },
                body: JSON.stringify({
                    userid: userId,
                    credit: credits
                    // Add other data you want to send to the server
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response from the server
                console.log(data);
                window.location.href = "/users";
                // Close the modal after successfully updating credits
                $('#editModal').modal('hide');
            })
            .catch(error => console.error('Error updating credits:', error));
    });
</script>
@include('footer')
