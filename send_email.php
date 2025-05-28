<?php
// 設定您的 Email 地址
$to_email = 'mooreyen114001@accvisinno.com'; // **請將此處替換為您實際接收郵件的 Email 地址**

// 檢查是否是 POST 請求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取表單資料並進行基本的清理
    $name = htmlspecialchars(trim($_POST['user_name']));
    $email = htmlspecialchars(trim($_POST['user_email']));
    $message = htmlspecialchars(trim($_POST['user_message']));

    // 基本驗證
    if (empty($name) || empty($email) || empty($message)) {
        echo "請填寫所有欄位。";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "請輸入有效的 Email 地址。";
        exit;
    }

    // Email 主旨
    $subject = "來自網頁聯絡表單的訊息 - " . $name;

    // Email 內容
    $email_body = "姓名: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n\n";
    $email_body .= "訊息:\n" . $message;

    // Email 標頭
    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n"; // 確保中文不亂碼

    // 發送 Email
    if (mail($to_email, $subject, $email_body, $headers)) {
        // 發送成功
        echo "<!DOCTYPE html><html><head><title>成功</title><meta charset='UTF-8'><style>body{font-family: Arial, sans-serif; background-color: #222; color: white; text-align: center; padding-top: 50px;} .message-box{background-color: rgba(0,0,0,0.7); padding: 30px; border-radius: 8px; max-width: 500px; margin: 50px auto; box-shadow: 0 0 15px rgba(255,255,255,0.3);} a{color: #98FB98; text-decoration: none;} a:hover{text-decoration: underline;}</style></head><body><div class='message-box'><h1>訊息已成功送出！</h1><p>感謝您的聯絡，我們會盡快回覆您。</p><p><a href='index.html'>返回首頁</a></p></div></body></html>";
    } else {
        // 發送失敗
        echo "<!DOCTYPE html><html><head><title>失敗</title><meta charset='UTF-8'><style>body{font-family: Arial, sans-serif; background-color: #222; color: white; text-align: center; padding-top: 50px;} .message-box{background-color: rgba(0,0,0,0.7); padding: 30px; border-radius: 8px; max-width: 500px; margin: 50px auto; box-shadow: 0 0 15px rgba(255,255,255,0.3);} a{color: #98FB98; text-decoration: none;} a:hover{text-decoration: underline;}</style></head><body><div class='message-box'><h1>訊息送出失敗！</h1><p>請稍後再試，或直接發送 Email 至 " . htmlspecialchars($to_email) . "</p><p><a href='index.html'>返回首頁</a></p></div></body></html>";
    }

} else {
    // 如果不是 POST 請求，則重定向回首頁或顯示錯誤
    header("Location: index.html");
    exit;
}
?>