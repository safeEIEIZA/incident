<?php
include('../config/db-config.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../css/login-form.css">
<title>Login</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
            <form name="formlogin" action="login_process.php" method="POST" id="login" class="form-horizontal">
                    <h2>Incident Login</h2>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="username" name="username" autocomplete="off"  required>
                        <label for="">Username</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="eye-outline" onmousedown="startLongPress()" onmouseup="endLongPress()"></ion-icon>
                        <input type="password" class="show-password-icon"  name="password" id="passwordInput" autocomplete="off" required>
                        <label for="">Password</label>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-success">Log in</button>
					
					

					

					
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>



<div id="popup" class="popup" onload="showPopup()">
    <div class="popup-content">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img src="../img/multiply.png" class="small-image">
        <?php
        if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
            echo '<p class="error-message">รหัสผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง !!</p>';
        }
        ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button onclick="closePopup()" class="close-button">ตกลง</button>
    </div>
</div>




<div id="popupNotAdmin" class="popup" onload="showPopupNotAdmin()">
    <div class="popup-content">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img src="../img/admin.png" class="small-image">
        <p class="error-message"> คุณต้องมีสิทธิ์ Admin</p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button onclick="closePopupNotAdmin()" class="close-button">ตกลง</button>
    </div>
</div>







<script>
        // ฟังก์ชันเพื่อแสดง password
        let longPressTimer;
        const pressDuration = 1; // milliseconds

        function startLongPress() {
            longPressTimer = setTimeout(showPassword, pressDuration);
        }

        function endLongPress() {
            clearTimeout(longPressTimer);
            hidePassword();
        }

        function showPassword() {
            const passwordInput = document.getElementById('passwordInput');
            const icon = document.querySelector('.show-password-icon');

            passwordInput.type = 'text';
            icon.setAttribute('name', 'eye-off-outline');
        }

        function hidePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const icon = document.querySelector('.show-password-icon');

            passwordInput.type = 'password';
            icon.setAttribute('name', 'eye-outline');
        }


    // ฟังก์ชันเพื่อแสดง popup
    function showPopup() {
        const popup = document.getElementById('popup');
        const popupContent = document.querySelector('.popup-content');

        popup.style.display = 'flex';
        popupContent.classList.remove('zoom-out'); // ลบคลาส zoom-out ที่อาจมีอยู่
        popupContent.classList.add('zoom-in');
    }

    // ฟังก์ชันเพื่อปิด popup
    function closePopup() {
        const popup = document.getElementById('popup');
        const popupContent = document.querySelector('.popup-content');

        popupContent.classList.remove('zoom-in'); // ลบคลาส zoom-in ที่อาจมีอยู่
        popupContent.classList.add('zoom-out');

        // รอ animation สำหรับการ zoom-out เสร็จสิ้นก่อนที่จะซ่อน popup
        setTimeout(() => {
            popup.style.display = 'none';
        }, 300); // 300 milliseconds ตรงกับเวลาใน animation popup-zoom-out
    }
	

    // ฟังก์ชันเพิ่มเหตุการณ์การโหลดหน้าเพจ
    window.addEventListener('load', function() {
        <?php
        if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
            echo 'showPopup();';
        }
        ?>
    });
	
	
	
	
	
	    // ฟังก์ชันเพื่อแสดง popup ไม่ใช่ Admin
    function showPopupNotAdmin() {
        const popup = document.getElementById('popupNotAdmin');
        const popupContent = document.querySelector('.popup-content');

        popup.style.display = 'flex';
        popupContent.classList.remove('zoom-out'); // ลบคลาส zoom-out ที่อาจมีอยู่
        popupContent.classList.add('zoom-in');
    }

    // ฟังก์ชันเพื่อปิด popup ไม่ใช่ Admin
    function closePopupNotAdmin() {
        const popup = document.getElementById('popupNotAdmin');
        const popupContent = document.querySelector('.popup-content');

        popupContent.classList.remove('zoom-in'); // ลบคลาส zoom-in ที่อาจมีอยู่
        popupContent.classList.add('zoom-out');

        // รอ animation สำหรับการ zoom-out เสร็จสิ้นก่อนที่จะซ่อน popup
        setTimeout(() => {
            popup.style.display = 'none';
        }, 300); // 300 milliseconds ตรงกับเวลาใน animation popup-zoom-out
		
		window.location.href = '../index.php';
    }

    // ฟังก์ชันเพิ่มเหตุการณ์การโหลดหน้าเพจ
    window.addEventListener('load', function() {
        <?php
        if (isset($_GET['error']) && $_GET['error'] === 'not_admin') {
            echo 'showPopupNotAdmin();';
        }
        ?>
    });
	
	
	function goToIndexPage() {
	window.location.href = "../index.php";
}
</script>
</html>