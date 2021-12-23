$(function() {
    // ハンバーガーメニュー開閉操作
    $('#pagesTemplateHumburgerMenus').on('click', function() {
        $('#pagesTemplateSpMenus').toggleClass('hidden');
    });

    // パスワード表示・非表示処理
    $('#password-eye').on('click', function() {
        if ($(this).hasClass('fa-eye')) {
            // パスワードが黒丸の状態の時
            $(this).removeClass('fa-eye').addClass('fa-eye-slash').attr('title', 'パスワードを隠す'); // 目のアイコンを切り替える
            $('#password').attr('type', 'text'); // パスワードを黒丸から表示へ
        } else {
            $(this).removeClass('fa-eye-slash').addClass('fa-eye').attr('title', 'パスワードを表示する'); // 目のアイコンを切り替える
            $('#password').attr('type', 'password'); // パスワードを表示から黒丸へ
        }
    });
    $('#password_confirmation-eye').on('click', function() {
        if ($(this).hasClass('fa-eye')) {
            // パスワードが黒丸の状態の時
            $(this).removeClass('fa-eye').addClass('fa-eye-slash').attr('title', 'パスワードを隠す'); // 目のアイコンを切り替える
            $('#password_confirmation').attr('type', 'text'); // パスワードを黒丸から表示へ
        } else {
            $(this).removeClass('fa-eye-slash').addClass('fa-eye').attr('title', 'パスワードを表示する'); // 目のアイコンを切り替える
            $('#password_confirmation').attr('type', 'password'); // パスワードを表示から黒丸へ
        }
    });

    // バリデーション時に該当の入力箇所に色をつける
    if ($('#email_validation').length) {
        $('#email').addClass('border-red-400 border-2');
    }
    if ($('#password_validation').length) {
        $('#password').addClass('border-red-400 border-2');
        $('#password_confirmation').addClass('border-red-400 border-2');
    }
    if ($('#username_validation').length) {
        $('#username').addClass('border-red-400 border-2');
    }
})
