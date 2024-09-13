<!DOCTYPE html>
<html>
<head>
    <title>店舗からの通知</title>
</head>
<body>
    <p>{{ $user->name }} 様</p>
    <p>{{ $notificationMessage }}</p>
    <p>以下のQRコードを店舗でご提示ください。</p>
    <p><img src="cid:reservation_qrcode.png" alt="QR Code"></p>
</body>
</html>
