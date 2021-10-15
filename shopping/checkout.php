<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>checkout</title>
        <!--css-->
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
        <link href="bootstrap/css/checkout.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="title">
                <h2>ยืนยันคำสั่งซื้อ</h2>
            </div>
            <div class="d-flex">
                <form action="" method="">
                    <label>
                    <span class="fname">ชื่อ <span class="required">*</span></span>
                    <input type="text" name="cus_name">
                    </label>
                    <label>
                    <span class="lname">นามสกุล <span class="required">*</span></span>
                    <input type="text" name="cus_surname">
                    </label>
                    <label>
                    <span>ที่อยู่ <span class="required">*</span></span>
                    <textarea name="address_detail" rows="10" cols="60"></textarea>
                    </label>
                    <label>
                    <span>รายละเอียดเพิ่มเติม</span>
                    <textarea name="" rows="10" cols="60" placeholder="เช่น ใกล้เซเว่น"></textarea>
                    </label>
                    <label>
                    <span>เบอร์โทรศัพท์ <span class="required">*</span></span>
                    <input type="tel" name="cus_tel"> 
                    </label>
                    <div class="btn">
                        <button class="btn-change" type="button">แก้ไขที่อยู่</button>
                        <button class="btn-save" type="button">บันทึก</button>
                    </div>
                </form>
                <div class="Yorder">
                    <table>
                    <tr>
                        <th colspan="2" >รายละเอียด</th>
                    </tr>
                    <tr>
                        <td>ข้าวผัด</td>
                        <td>40 บาท</td>
                    </tr>
                    <tr>
                        <td>ค่าส่ง</td>
                        <td>10 บาท</td>
                    </tr>
                    <tr>
                        <td>รวม</td>
                        <td>50 บาท</td>
                    </tr>
                    </table><br>
                    <!--<div>
                    <input type="radio" name="dbt" value="dbt" checked> ชำระผ่าน Moblie Banking
                    </div>-->
                    <div>
                    <input type="radio" name="dbt" value="cd"> ชำระเงินปลายทาง
                    </div>
                    <button class="button"type="button">สั่งซื้อ</button>
                </div><!-- Yorder -->
            </div>
        </div> <!-- /container -->
    </body>
</html>