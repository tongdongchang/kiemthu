<?php
require("../../../util/dataProvider.php");
$dp = new DataProvider();
session_start();

$bill = getOrder();
sortBillByDateDesc($bill);
//get bill detail
$billDetail = getOderDetail($bill);
//handle detail bil to bill
filtBillDetailToBill($billDetail, $bill);
?> 
<div id="myaccount">
    <div class="flex-container">
    <!-- Header Section Starts -->

    <!-- Header Section Ends -->  


    <!-- Cart Section Starts -->
   

    <h2>Purchase history</h2>
        <?php foreach ($bill as $b): ?>
            <div class="bottom-container">
                <div class="order-placeholder">
                    <div class="order-header">
                        <div class="order-date">
                            <?= date("j-m-Y", strtotime($b['thoigiandat'])); ?>
                        </div>
                        <div class="order-id">Bill ID:
                            <?= str_pad($b['idhoadon'], 5, "0", STR_PAD_LEFT) ?>
                        </div>
                        <div class="order-status">
                            <?php if($b['trangthai']==1) 
                                echo 'Pending';
                                if($b['trangthai']==2)
                                echo 'Complete';
                                if($b['trangthai']==0)
                                echo 'Cancel';
                            ?>
                        </div>
                    </div>
                    <div class="order-details">
                        <?php foreach ($b['detail'] as $detail): ?>
                            <div class="product-placeholder">
                                <div class="img-placeholder">
                                    <img src="./data/img/<?=$detail['idsanpham']?>/<?= $detail['hinh'] ?>" alt="">
                                </div>
                                <div class="info-placeholder">
                                    <div class="album-name">
                                        <?= $detail['tensanpham'] ?>
                                    </div>
                                    <div class="sub-total">
                                        <?= $detail['gia'] * $detail['soluong'] ?> đ
                                    </div>
                                    <div class="artists-name">
                                        <?= $detail['tenMau'] ?>
                                    </div>
                                    <div></div>
                                    <div class="price">Price: 
                                        <?= $detail['gia'] ?> đ
                                    </div>
                                    <div></div>
                                    <div class="quantity">Quantity:
                                        <?= $detail['soluong'] ?>
                                    </div>
                                    <div></div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <div class="order-total">
                        <div class="total-title">Total billed:</div>
                        <?php
                        $total = 0;
                        foreach ($b['detail'] as $detail) {
                            $total += $detail['gia'] * $detail['soluong'];
                        }
                        ?>
                        <div class="total-bill">
                        
                            <?php echo $total ?> đ
                        </div>
                    </div>
                    <div class="order-address">
                        <div class="shipping-address">Ship to
                            <?= $b['diachigiaohang'] ?>
                        </div>
                        <?php if ($b['trangthai'] == 1): ?>
                            <div class="cancel-button" onclick="cancelOrder(
                            <?= $b['idhoadon'] ?>)">
                                <i class="fa-solid fa-xmark"></i>Cancel
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
</div>
</div>
<?php
function getOrder(){
    global $dp;
    $sql1="SELECT * from  hoadon  where idnguoidung=".$_SESSION['userID'];
    $result1 = $dp->excuteQuery($sql1);
    $bill = array();
    while ($row = $result1->fetch_assoc()) {
        array_push($bill, $row);
    }
    return $bill;
}
function getOderDetail($bill){
    if (count($bill) == 0) {
        return array();
    }
    global $dp;
    $sql2="SELECT * from sanpham join chitiethoadon on sanpham.idsanpham=chitiethoadon.idsanpham and sanpham.idmau=chitiethoadon.idmau join mau on  sanpham.idmau=mau.idmau where idhoadon in(";
    for ($i = 0; $i < count($bill); $i++) {
        if ($i != count($bill) - 1) {
            $sql2 = $sql2 . $bill[$i]['idhoadon'] . ",";
        } else {
            $sql2 = $sql2 . $bill[$i]['idhoadon'] . ")";
        }
    }
    $result2 = $dp->excuteQuery($sql2);
    $billDetail = array();
    while ($row = $result2->fetch_assoc()) {
        array_push($billDetail, $row);
    }
    return $billDetail;
}
function sortBillByDateDesc(&$bill)
{
    for ($i = 0; $i < count($bill); $i++) {
        for ($j = $i + 1; $j < count($bill); $j++) {
            if (strtotime($bill[$i]['thoigiandat']) < strtotime($bill[$j]['thoigiandat'])) {
                $temp = $bill[$i];
                $bill[$i] = $bill[$j];
                $bill[$j] = $temp;
            }
            else if($bill[$i]['idhoadon']<$bill[$j]['idhoadon']){
                $temp = $bill[$i];
                $bill[$i] = $bill[$j];
                $bill[$j] = $temp;
            }
        }
    }
    return $bill;
}
function filtBillDetailToBill($billDetail, &$bill)
{
    for ($i = 0; $i < count($bill); $i++) {
        $bill[$i]['detail'] = array();
        for ($j = 0; $j < count($billDetail); $j++) {
            if ($bill[$i]['idhoadon'] == $billDetail[$j]['idhoadon']) {
                array_push($bill[$i]['detail'], $billDetail[$j]);
            }
        }
    }
}
?>
