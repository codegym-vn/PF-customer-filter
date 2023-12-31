<?php

$customerList = [
    "1" => [
        "name" => "Mai Văn Hoàn",
        "day_of_birth" => "1983/08/20",
        "address" => "Hà Nội",
        "profile" => "images/img1.jpg"],
    "2" => [
        "name" => "Nguyễn Văn Nam",
        "day_of_birth" => "1983/08/21",
        "address" => "Bắc Giang",
        "profile" => "images/img2.jpg"],
    "3" => [
        "name" => "Nguyễn Thái Hòa",
        "day_of_birth" => "1983/08/22",
        "address" => "Nam Định",
        "profile" => "images/img3.jpg"],
    "4" => [
        "name" => "Trần Đăng Khoa",
        "day_of_birth" => "1983/08/17",
        "address" => "Hà Tây",
        "profile" => "images/img4.jpg"],
    "5" => [
        "name" => "Nguyễn Đình Thi",
        "day_of_birth" => "1983/08/19",
        "address" => "Hà Nội",
        "profile" => "images/img5.jpg"]
];

function searchByDate($customers, $fromDate, $toDate): array
{
    if (empty($fromDate) || empty($toDate)) {
        return $customers;
    }

    $filteredCustomers = [];
    foreach ($customers as $customer) {
        if (strtotime($customer['day_of_birth']) < strtotime($fromDate))
            continue;
        if (strtotime($customer['day_of_birth']) > strtotime($toDate))
            continue;
        $filteredCustomers[] = $customer;
    }
    return $filteredCustomers;
}

$fromDate = $_REQUEST["from"] ?? null;
$toDate =  $_REQUEST["to"]?? null;

$filteredCustomers = searchByDate($customerList, $fromDate, $toDate);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Customers filter</title>
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
</head>
<body>
<form method="GET">
    Chọn ngày sinh từ: <input id="from" type="date" name="from" placeholder="yyyy/mm/dd"
                              value="<?php echo $fromDate ?? ''; ?>"/>
    đến: <input id="to" type="date" name="to" placeholder="yyyy/mm/dd"
                value="<?php echo $toDate ?? ''; ?>"/>
    <input type="submit" id="submit" value="Lọc"/>
</form>
<table>
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
    <?php foreach ($filteredCustomers as $index => $customer): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $customer['name']; ?></td>
            <td><?php echo $customer['day_of_birth']; ?></td>
            <td><?php echo $customer['address']; ?></td>
            <td>
                <div class="profile"><img src="<?php echo $customer['profile']; ?>"/></div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>