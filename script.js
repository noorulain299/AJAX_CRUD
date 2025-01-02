$(document).ready(function () {

    // Fetch all users
    function fetchUsers() {
        $.ajax({
            url: "action.php",
            method: "GET",
            data: { action: "fetch" },
            success: function (response) {
                $('#userTable tbody').html(response);
            }
        });
    }

    fetchUsers();

    // Add user
    $('#addUserForm').on('submit', function (e) {
        e.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();

        $.ajax({
            url: "action.php",
            method: "POST",
            data: { action: "add", name: name, email: email },
            success: function (response) {
                $('#name').val('');
                $('#email').val('');
                fetchUsers();
            }
        });
    });

    // Edit user
    $(document).on('click', '.editBtn', function () {
        var id = $(this).data('id');
        $.ajax({
            url: "action.php",
            method: "GET",
            data: { action: "edit", id: id },
            success: function (response) {
                var user = JSON.parse(response);
                $('#updateId').val(user.id);
                $('#updateName').val(user.name);
                $('#updateEmail').val(user.email);
                $('#updateUserForm').show();
                $('#addUserForm').hide();
            }
        });
    });

    // Update user
    $('#updateUserForm').on('submit', function (e) {
        e.preventDefault();
        var id = $('#updateId').val();
        var name = $('#updateName').val();
        var email = $('#updateEmail').val();

        $.ajax({
            url: "action.php",
            method: "POST",
            data: { action: "update", id: id, name: name, email: email },
            success: function (response) {
                $('#updateUserForm').hide();
                $('#addUserForm').show();
                fetchUsers();
            }
        });
    });

    // Delete user
    $(document).on('click', '.deleteBtn', function () {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: "action.php",
                method: "POST",
                data: { action: "delete", id: id },
                success: function (response) {
                    fetchUsers();
                }
            });
        }
    });

});
