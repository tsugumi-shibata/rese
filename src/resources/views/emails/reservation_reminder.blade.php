<!DOCTYPE html>
<html>
<head>
    <title>リマインダー</title>
</head>
<body>
    <p>{{ $reservation->user->name }} 様</p>
    <p>ご予約のリマインダーです。</p>
    <p>予約日: {{ $reservation->reservation_date }}</p>
    <p>予約時間: {{ $reservation->reservation_time}}</p>
    <p>予約人数: {{ $reservation->number_of_people}}</p>
</body>
</html>
