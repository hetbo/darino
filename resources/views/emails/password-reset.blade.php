<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بازنشانی رمز عبور</title>
    <style>
        body {
            font-family: 'Tahoma', Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            direction: rtl;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
            line-height: 1.6;
        }
        .button {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <p>بازنشانی رمز عبور</p>
    </div>

    <div class="content">
        <h2>سلام {{ $user->name }}،</h2>

        <p>درخواست بازنشانی رمز عبور برای حساب کاربری شما دریافت شد.</p>

        <p>برای تنظیم رمز عبور جدید، روی دکمه زیر کلیک کنید:</p>

        <div style="text-align: center;">
            <a href="{{ $resetUrl }}" class="button">
                بازنشانی رمز عبور
            </a>
        </div>

        <div class="warning">
            <strong>توجه:</strong> این لینک تنها برای 60 دقیقه معتبر است.
        </div>

        <p>اگر شما این درخواست را نداده‌اید، هیچ اقدامی لازم نیست.</p>

        <p>در صورت مشکل با دکمه بالا، لینک زیر را کپی کرده و در مرورگر خود باز کنید:</p>
        <p style="word-break: break-all; color: #666; font-size: 14px;">
            {{ $resetUrl }}
        </p>
    </div>

    <div class="footer">
        <p>با تشکر،<br>تیم {{ config('app.name') }}</p>
        <p style="font-size: 12px;">
            اگر مشکلی دارید، با پشتیبانی تماس بگیرید.
        </p>
    </div>
</div>
</body>
</html>
