@extends('layout')

@section('content')

<style>
        /* Basic table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Responsive table styles */
        @media screen and (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            thead {
                display: none;
            }
            
            tr {
                display: block;
                margin-bottom: 10px;
            }
            
            td {
                display: block;
                text-align: right;
                font-size: 14px;
                border: none;
                position: relative;
                padding-left: 50%;
            }
            
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 10px;
                font-weight: bold;
                text-align: left;
            }
        }

        /* Other styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* .navbar {
            background-color: #3B3131;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar img {
            width: 80px;
            height: 80px;
        } */


        /* Style for clickable status */



        .sidebar {
            height: 100%;
            width: 193px;
            position: fixed;
            z-index: 1;
            top: 77px;
            left: 0;
            background-color: #000000;
            overflow-x: hidden;
            padding-top: 20px;
            transition: 0.5s;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        .content {
            margin-left: 250px;
            padding: 76px;
        }

        .card {
            background-color: #fff6f6;
            color: black;
            padding: 20px;
            margin: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .card:hover {
                    border: 2px solid black; 
                    
                    transform: scale(1.05);
                    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); 
                }

        .card i {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

    

        .col-sm-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        /* Additional styles for better layout */
        h2 {
            color: #3B3131;
            margin-bottom: 20px;
        }

        .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        /* Responsive design */
        @media screen and (max-width: 768px) {
            .sidebar {
                width: 0;
            }
            .content {
                margin-left: 0;
            }
            .col-sm-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            /* Style for the open sidebar button */
                .openbtn {
                    font-size: 20px;
                    cursor: pointer;
                    color: #000;
                    text-decoration: none;
                    position: absolute;
                    top: 20px;
                    left: 20px;
                    z-index: 1;
                }

                /* Adjust position and appearance as needed */
                .openbtn:hover {
                    color: #555;
                }



                .add-job-form {
                                    max-width: 800px;
                                    margin: 0 auto;
                                }

                                .add-job-form .row {
                                    display: flex;
                                    margin-bottom: 15px;
                                }

                                .add-job-form .col-25 {
                                    flex: 0 0 25%;
                                    max-width: 25%;
                                    padding: 10px;
                                }

                                .add-job-form .col-75 {
                                    flex: 0 0 75%;
                                    max-width: 75%;
                                    padding: 10px;
                                }

                                .add-job-form input[type="text"],
                                .add-job-form input[type="number"],
                                .add-job-form select,
                                .add-job-form textarea {
                                    width: 100%;
                                    padding: 8px;
                                    border: 1px solid #ddd;
                                    border-radius: 4px;
                                }

                                .add-job-form textarea {
                                    height: 100px;
                                    resize: vertical;
                                }

                                .add-job-form .form_submit {
                                    text-align: right;
                                }

                                .add-job-form input[type="submit"] {
                                    background-color: #4CAF50;
                                    color: white;
                                    padding: 10px 15px;
                                    border: none;
                                    border-radius: 4px;
                                    cursor: pointer;
                                }

                                .add-job-form input[type="submit"]:hover {
                                    background-color: #45a049;
                                }

        }
</style>

                <!-- Button to open the sidebar -->
                
               

    <div class="sidebar" id="mySidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#" onclick="showSection('dashboard')"><i class="fas fa-home"></i> Dashboard</a>
        <a href="#" onclick="showSection('users')"><i class="fas fa-users"></i> Users</a>
        <a href="#" onclick="showSection('category')"><i class="fas fa-th-large"></i> Category</a>
        <!-- <a href="#" onclick="showSection('sizes')"><i class="fas fa-th"></i> Sizes</a> -->
        <!-- <a href="#" onclick="showSection('productSizes')"><i class="fas fa-th-list"></i> Product Sizes</a> -->
        <a href="#" onclick="showSection('products')"><i class="fas fa-th"></i> Products</a>
        <a href="#" onclick="showSection('orders')"><i class="fas fa-list"></i> Orders</a>
    </div>
   
    
    

    <div class="content">
    <a href="javascript:void(0)" class="openbtn" onclick="openNav()">&#9776; Open Sidebar</a>
    <div id="dashboard" class="content-section active">
        <h2>Dashboard</h2>
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <i class="fas fa-users"></i>
                    <h4>Total Users</h4>
                    <h5 id="totalUsers">{{ $totalUsers }}</h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <i class="fas fa-th-large"></i>
                    <h4>Total Categories</h4>
                    <h5 id="totalCategories">{{ $totalCategories }}</h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <i class="fas fa-th"></i>
                    <h4>Total Products</h4>
                    <h5 id="totalProducts">{{ $totalProducts }}</h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <i class="fas fa-list"></i>
                    <h4>Total Orders</h4>
                    <h5 id="totalOrders">{{ $totalOrders }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="users" class="content-section">
    <h2>Users</h2>
    @if($users->isEmpty())
        <p>No users found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td data-label="ID">{{ $user->id }}</td>
                        <td data-label="Name">{{ $user->name }}</td>
                        <td data-label="Email">{{ $user->email }}</td>
                        <td data-label="Role">{{ $user->role == 2 ? 'Admin' : 'User' }}</td>
                        <!-- <td data-label="Actions">
                            
                            <a href="#">Edit</a> | 
                            <a href="#">Delete</a>
                        </td> -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div id="category" class="content-section">
    <h2>Category</h2>
    @if($categories->isEmpty())
        <p>No categories found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td data-label="ID">{{ $category->id }}</td>
                        <td data-label="Name">{{ $category->product_title }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>


<div id="products" class="content-section">
    <h2>Products</h2>
    @if($products->isEmpty())
        <p>No products found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td data-label="ID">{{ $product->id }}</td>
                        <td data-label="Name">{{ $product->product_name }}</td>
                        <td data-label="Category">{{ $product->description }}</td>
                        <td data-label="Price">{{ $product->price }}</td>
                        <td data-label="Stock">{{ $product->stock }}</td>
                        <!-- <td data-label="Actions">
                            <a href="#">Edit</a> | 
                            <a href="#">Delete</a>
                        </td> -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>


<div id="orders" class="content-section">
    <h2>Orders</h2>
    @if($orders->isEmpty())
        <p>No orders found.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Payment Method</th>
                    <th>Delivery Date</th>
                    <th>Delivery Address</th>
                    <th>Status</th>
                    <th>Courier Office</th>
                    <th>Consignment Number</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr data-id="{{ $order->id }}" data-consignment-number="{{ $order->consignment_number }}" data-courier-service="{{ $order->courier_service }}" data-order-status="{{ $order->status }}">
                        <td data-label="Order ID">{{ $order->id }}</td>
                        <td data-label="User">{{ $order->user->name }}</td>
                        <td data-label="Product">{{ $order->product->product_name }}</td>
                        <td data-label="Quantity">{{ $order->quantity }}</td>
                        <td data-label="Payment Method">{{ $order->payment_method }}</td>
                        <td data-label="Delivery Date">{{ $order->created_at }}</td>
                        <td data-label="Delivery Address">{{ $order->delivery_address }}</td>
                        <td data-label="Status">
                        <a href="{{ route('editOrder', $order->id) }}" class="status-link">
                        {{$order->status}}
                         </a> </td>
                         <td>{{ $order->courier_office ? $order->courier_office : 'Null' }}</td>
                         <td>{{ $order->consignment_number ? $order->consignment_number : 'Null' }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>





 <script>
     // JavaScript to update the numbers (you'd typically fetch these from a server)
        document.getElementById('totalUsers').innerText = {{ $totalUsers }};
        document.getElementById('totalCategories').innerText = {{ $totalCategories }};
        document.getElementById('totalProducts').innerText ={{ $totalProducts }};
        document.getElementById('totalOrders').innerText = {{ $totalOrders }};

        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementsByClassName("content")[0].style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementsByClassName("content")[0].style.marginLeft = "0";
        }

        function showSection(sectionId) {
            // Hide all sections
            var sections = document.getElementsByClassName('content-section');
            for (var i = 0; i < sections.length; i++) {
                sections[i].classList.remove('active');
            }

            // Show the selected section
            document.getElementById(sectionId).classList.add('active');
        }


</script>
@endsection
