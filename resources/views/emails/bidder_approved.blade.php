<!DOCTYPE html>
<html>

<head>
    <title>Bidder Account Approved</title>
</head>

<body>
    <h2>Congratulations, {{ $bidder->name }}!</h2>

    <p>আপনার bidder হিসেবে registration request অনুমোদিত হয়েছে।</p>

    <p>আপনি চাইলে এখন লগইন করতে পারেন:</p>
    <p>Email: {{ $bidder->email }}</p>

    <a href="{{ route('bidder.login') }}"
        style="display:inline-block;padding:10px 20px;background:#4CAF50;color:white;text-decoration:none;border-radius:5px;">Login
        Now</a>

    <p>ধন্যবাদ,<br>RHD Auction Team</p>
</body>

</html>
