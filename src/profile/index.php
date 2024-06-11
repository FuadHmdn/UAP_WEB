<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
        }

        .container-fluid {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .profile-container {
            width: 100%;
            max-width: 1000px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-picture {
            position: relative;
            display: block;
            width: 150px;
            height: 150px;
            margin: auto;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #007bff;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-picture .edit-icon {
            position: absolute;
            width: 32px;
            height: 32px;
            bottom: 12px;
            right: 18px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 50%;
            padding: 4px;
            cursor: pointer;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>

<body>
    <a href="../home/index.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="btn btn-primary back-button"><i class="fas fa-arrow-left"></i> Back</a>
    <div class="container-fluid">
        <div class="profile-container">
            <div class="text-center">
                <div class="profile-picture">
                    <img src="https://via.placeholder.com/150" alt="Profile Picture" id="profileImg">
                    <div class="edit-icon" onclick="document.getElementById('profileInput').click();">
                        <i class="fas fa-camera"></i>
                    </div>
                    <input type="file" id="profileInput" style="display: none;" name="profile_picture" onchange="updateProfilePicture(event)">
                </div>
            </div>
            <form id="profileForm">
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="userId" class="form-label">ID</label>
                            <input type="text" class="form-control" id="userId" name="id" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="userName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="userName" name="name" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="userEmail" name="email" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="userPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="userPhone" name="phone" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="userAddress" class="form-label">Address</label>
                            <textarea class="form-control" id="userAddress" name="address" rows="2" disabled></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary w-50" id="editButton" onclick="enableEditing()">Edit</button>
                    <button type="button" class="btn btn-success w-50" id="saveButton" style="display: none;" onclick="saveProfile()">Save</button>
                    <button type="button" class="btn btn-danger w-50 mt-3" id="deleteButton" onclick="deleteAccount()">Delete Account</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateProfilePicture(event) {
                const fileInput = event.target;
                const formData = new FormData();
                formData.append('profile_picture', fileInput.files[0]);
                formData.append('id', document.getElementById('userId').value);

                fetch('http://localhost/UAP_WEB/database/admin/updateFoto.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Profile picture updated successfully');
                            const reader = new FileReader();
                            reader.onload = function() {
                                const img = document.getElementById('profileImg');
                                img.src = reader.result;
                            }
                            reader.readAsDataURL(fileInput.files[0]);
                        } else {
                            alert('Error updating profile picture: ' + data.message);
                        }
                    })
                    .catch(error => console.error('Error updating profile picture:', error));
            }

            function enableEditing() {
                document.getElementById('userName').disabled = false;
                document.getElementById('userEmail').disabled = false;
                document.getElementById('userPhone').disabled = false;
                document.getElementById('userAddress').disabled = false;
                document.getElementById('editButton').style.display = 'none';
                document.getElementById('saveButton').style.display = 'block';
            }

            function fetchProfileData() {
                fetch(`http://localhost/UAP_WEB/database/admin/getAdminById.php?id=<?php echo htmlspecialchars($_GET['id']); ?>`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('userId').value = data.id;
                        document.getElementById('userName').value = data.name;
                        document.getElementById('userEmail').value = data.email;
                        document.getElementById('userPhone').value = data.phone;
                        document.getElementById('userAddress').value = data.address;
                        if (data.profile_picture) {
                            document.getElementById('profileImg').src = data.profile_picture;
                        }
                    })
                    .catch(error => console.error('Error fetching profile data:', error));
            }

            function saveProfile() {
                const formData = new FormData(document.getElementById('profileForm'));
                fetch('http://localhost/UAP_WEB/database/admin/editAdmin.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Profile updated successfully');
                            location.reload();
                        } else {
                            alert('Error updating profile: ' + data.error);
                        }
                    })
                    .catch(error => console.error('Error updating profile:', error));
            }

            window.updateProfilePicture = updateProfilePicture;
            window.enableEditing = enableEditing;
            window.saveProfile = saveProfile;

            fetchProfileData();
        });
    </script>

    <script>
        function deleteAccount() {
            const userId = document.getElementById('userId').value;
            if (confirm('Are you sure you want to delete your account?')) {
                fetch(`http://localhost/UAP_WEB/database/admin/deleteAccountAdmin.php?id=<?php echo htmlspecialchars($_GET['id']); ?>`, {
                        method: 'DELETE'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Account deleted successfully');
                            window.location.href = '../login/index.php';
                        } else {
                            alert('Error deleting account: ' + data.error);
                        }
                    })
                    .catch(error => console.error('Error deleting account:', error));
            }
        }
    </script>
</body>

</html>