<?php
session_start();   // ✅ MUST

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<h2>Access Denied</h2>";
    exit;
}
?>

<h2>🏠 Agreement Requests</h2>

<div class="table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Room</th>
                <th>Rent</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- DEMO DATA -->
            <tr>
                <td>Rahim Uddin</td>
                <td>rahim@gmail.com</td>
                <td>302</td>
                <td>৳15000</td>
                <td>
                    <button class="accept">Accept</button>
                    <button class="reject">Reject</button>
                </td>
            </tr>

            <tr>
                <td>Karim Ahmed</td>
                <td>karim@gmail.com</td>
                <td>502</td>
                <td>৳18000</td>
                <td>
                    <button class="accept">Accept</button>
                    <button class="reject">Reject</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<style>
.table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}
.table th, .table td {
    padding: 10px;
    border: 1px solid #e5e7eb;
    text-align: center;
}
.table thead {
    background: #2563eb;
    color: white;
}
.accept {
    background: #16a34a;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 5px;
}
.reject {
    background: #dc2626;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 5px;
}
</style>
