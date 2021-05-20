<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <textarea name="input"></textarea>
    <button type="submit">Gửi</button>
</form>
<?php
$viettel = ["0162", "0163", "0164", "0165", "0166", "0167", "0168", "0169", "032", "033", "034", "035", "036", "037", "038", "039"];
$mobiphone = ["090", "093", "089", "0120", "0121", "0122", "0126", "0128"];
$vinaphone = ["0125", "0127", "0129", "085", "081", "082"];
$all = [$viettel, $mobiphone, $vinaphone];

if (empty($_REQUEST['input'])) {
    echo "Danh sach trong";
} else {
    $numbers = $_REQUEST['input'];
    $numbersArr = explode(',', $numbers);
    $newNumbersArr = check10numbers($numbersArr);
    $dataUser = checkPhonecarrier($newNumbersArr, $all);
}
function check10numbers($numberArr)
{
    foreach ($numberArr as $key => $number) {
        if (strlen($number) !== 10) {
            echo "SDT: " . $number . " khong hop le. Xoá số này khỏi danh sách";
            array_splice($numberArr, $key, 1);
        }
    }
    return $numberArr;
}

function checkPhonecarrier($newNumberArr, $data)
{
    $data1 = [[], [], []];
    foreach ($newNumberArr as $item) {
        $item1 = substr($item, 0, 4);
        for ($i = 0; $i < count($data); $i++) {
            for ($j = 0; $j < count($data[$i]); $j++) {
                if (str_contains($item1, $data[$i][$j])) {
                    switch ($i) {
                        case 0 :
                            array_push($data1[0], $item);
                            break;
                        case 1 :
                            array_push($data1[1], $item);
                            break;
                        case 2 :
                            array_push($data1[2], $item);
                            break;
                    }
                }
            }
        }
    }
    return $data1;
}

?>
<table border="1" style="border-collapse: collapse">
    <tr>
        <td>STT</td>
        <td>Nhà Mạng</td>
        <td>SDT</td>
    </tr>
    <?php foreach ($dataUser[0] as $key => $value): ?>
        <tr>
            <td><?php echo $key+1 ?></td>
            <td>Viettel</td>
            <td><?php echo $value ?></td>
        </tr>
    <?php endforeach; ?>
    <?php foreach ($dataUser[1] as $key => $value): ?>
        <tr>
            <td><?php echo $key+count($dataUser[0])+1 ?></td>
            <td>Mobi</td>
            <td><?php echo $value ?></td>
        </tr>
    <?php endforeach; ?>
    <?php foreach ($dataUser[2] as $key => $value): ?>
        <tr>
            <td><?php echo $key+count($dataUser[0])+count($dataUser[1])+1 ?></td>
            <td>Vina</td>
            <td><?php echo $value ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>




