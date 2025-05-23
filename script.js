const images = document.querySelectorAll('.background-slideshow img');
let currentImageIndex = 0;
const fadeDuration = 5000; // 圖片停留時間 (毫秒)。您可以調整這個值來改變圖片切換的速度。例如：
                          // 3000 表示 3 秒
                          // 8000 表示 8 秒

function changeImage() {
    // 移除當前活躍圖片的 'active' class
    // 這會觸發 CSS 中的 transition 效果，使其淡出
    images[currentImageIndex].classList.remove('active');

    // 計算下一張圖片的索引
    // 使用模運算符 (%) 確保當達到最後一張圖片時，索引會回到 0，實現循環播放
    currentImageIndex = (currentImageIndex + 1) % images.length;

    // 添加 'active' class 到下一張圖片
    // 這會觸發 CSS 中的 transition 效果，使其淡入
    images[currentImageIndex].classList.add('active');
}

// 頁面載入後立即開始輪播
// setInterval 函數會每隔 fadeDuration 毫秒執行一次 changeImage 函數
setInterval(changeImage, fadeDuration);

// 初始化：確保當網頁載入時，第一張圖片立即顯示
// 'DOMContentLoaded' 事件確保在 HTML 文檔完全載入和解析後才執行此腳本
document.addEventListener('DOMContentLoaded', () => {
    if (images.length > 0) {
        images[0].classList.add('active');
    }
});