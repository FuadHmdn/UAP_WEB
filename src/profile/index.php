<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            ;
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
                        <i class="fas fa-camera" style="align-self: center;"></i>
                    </div>
                    <input type="file" id="profileInput" style="display: none;" onchange="updateProfilePicture(event)">
                </div>
            </div>
            <form>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="userId" class="form-label">ID</label>
                            <input type="text" class="form-control" id="userId" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="userName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="userName" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="userEmail" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="userPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="userPhone" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="userAddress" class="form-label">Address</label>
                            <textarea class="form-control" id="userAddress" rows="2" disabled></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-primary w-50" id="editButton" onclick="enableEditing()">Edit</button>
                    <button type="submit" class="btn btn-success w-50" id="saveButton" style="display: none;">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateProfilePicture(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const img = document.getElementById('profileImg');
                    img.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
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
                fetch(`http://localhost/UAP_WEB/database/getAdminById.php?id=<?php echo htmlspecialchars($_GET['id']); ?>`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('userId').value = data.id;
                        document.getElementById('userName').value = data.name;
                        document.getElementById('userEmail').value = data.email;
                        document.getElementById('userPhone').value = data.phone;
                        document.getElementById('userAddress').value = data.address;
                    })
                    .catch(error => console.error('Error fetching profile data:', error));
            }

            window.updateProfilePicture = updateProfilePicture;

            window.enableEditing = enableEditing;
            fetchProfileData();
        });
    </script>
</body>

</html>