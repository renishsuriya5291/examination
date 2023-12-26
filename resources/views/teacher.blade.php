@include('header')
@include('nav')

<script>
    var userEmail = localStorage.getItem('userEmail');
    if (userEmail == null) {
        window.location.href = '/login';
    }
</script>

<div class="container mt-5 mb-5">
    <div class="input-group">
        <input type="search" class="form-control rounded" placeholder="Search By Email OR Phone" aria-label="Search"
            aria-describedby="search-addon" id="searchInput" oninput="searchUsers()"  />
        <button type="button" style="margin-left: 12px;" class="btn btn-outline-primary"
            data-mdb-ripple-init onclick="searchUsers()">Search</button>
    </div>

    <div class="container mt-5 mb-5">
        <table class="table">
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

    </div>

</div>

<script>
    var Teacherdata = null;
      function searchUsers() {
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
        }

    fetch('http://localhost:8000/stu/fetchTeachers', {
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
            data.data.forEach(user => {
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
        })
        .catch(error => console.error('Error fetching data:', error));
</script>

@include('footer')
