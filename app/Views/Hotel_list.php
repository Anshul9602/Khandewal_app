<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style>
    .popup {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        padding-top: 5rem;
        margin-left: 8rem;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .popup-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<?php if (session()->getFlashdata('error')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('<?= session()->getFlashdata('error') ?>');
            });
        </script>
    <?php elseif (session()->getFlashdata('success')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('<?= session()->getFlashdata('success') ?>');
            });
        </script>
    <?php endif; ?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div id="editPopup" class="popup">
                <div class="popup-content">
                    <div class="contianer p-4">
                        <span class="close" onclick="closePopup()">&times;</span>
                        <div class="col-md-12 text-start pb-3">
                            <h2 class="bold">Price info</h2>
                            
                        </div>
                        
                    
                    </div>
                    <form id="editForm" action="<?= base_url('/update_price') ?>" method="POST" class="container">
                        <input type="hidden" id="id" name="id" value>
                        <div class="row d-flex justify-content-around py-3">
                            <div class="col-md-5">
                                <div class="col-md-12"><label for="name">Name:</label></div>
                                <input type="text" id="name" name="name" value style="     padding: 10px;   width: 100%;">
                            </div>
                            
                            <div class="col-md-5 p-0">
                                <div class="col-md-12"><label for="state">Price:</label></div>
                                <input type="text" id="price" name="price" value style="        padding: 10px;width: 100%;">
                            </div>
                        </div>
                       
                        <div class="3 d-flex justify-content-around py-3">
                            <div class="col-md-5">
                                <div class="col-md-12"><label for="mobile_number">Update Date</label></div>
                                <input type="text" id="update_date" name="update_date" value style="      padding: 10px;  width: 100%;">
                            </div>                            
                        </div>
                        <div class="btn d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h4 class="card-title">Users Queue</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($users)) :
                            $json_user = json_encode($users);
                        ?>
                            <table id="example" class="display" style="background-color: #fff;">
                                <thead>
                                    <tr>
                                        <th><strong>Id</strong></th>
                                        <th><strong>Name</strong></th>
                                        <th><strong>Price</strong></th>
                                        <th><strong>Update Date</strong></th>
                                       
                                        <th style="width:85px;"><strong>EDIT</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) : ?>
                                        <tr>
                                            <td><b><?= $user['id'] ?></b></td>
                                            <td><?= $user['name'] ?></td>
                                            <td><?= $user['price'] ?><br></td>
                                            <td><?= $user['update_date'] ?></td>
                                           
                                            <td>
                                                <a href="#" class="btn btn-info shadow btn-xs sharp" onclick="openPopup(<?= $user['id'] ?>)"><i class="fa fa-pencil"></i></a>
                                                
                                            </td>
                                        </tr>
                                        <script>
                                            document.getElementById("deleteLink<?= $user['id'] ?>").addEventListener('click', function(event) {
                                                event.preventDefault(); // Prevents the default action of clicking the link
                                                if (confirm('Are you sure you want to delete this user?')) {
                                                    window.location.href = this.getAttribute('href');
                                                }
                                            });
                                        </script>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <p>User not found</p>
                        <?php endif; ?>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    var $j = jQuery.noConflict(); // Assign jQuery to $j
                </script>
                <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
                <script>
                    $j(document).ready(function() {
                        $j('#example').DataTable();
                    });

                    function openPopup(userId) {
                        document.getElementById("editPopup").style.display = "block";
                        document.getElementById("id").value = userId;
                        populateFormFields(userId);
                    }

                    function closePopup() {
                        document.getElementById("editPopup").style.display = "none";
                    }

                    function populateFormFields(userId) {
                        var users = <?= $json_user ?>;
                        var user = users.find(user => user.id == userId);
                        if (user) {
                            document.getElementById("name").value = user.name;
                            document.getElementById("price").value = user.price;
                            document.getElementById("update_date").value = user.update_date;
                        
                            // Add more lines to populate other form fields
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</div>
