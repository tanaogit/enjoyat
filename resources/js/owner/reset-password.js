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

    // 念のためにメールアドレスが変更されていないかを確認(表示されているものと送信されるものが異なる場合バリデーション)
    $('#reset-password-button').on('click', function(e) { // パスワードリセットボタンが押された時
        const displayEmail = $('#display-email').text();
        const hiddenEmail  = $('#hidden-email').val();
        if (displayEmail !== hiddenEmail) {
            e.preventDefault();
            if ($('#hidden-email').length) {
                $('#hidden-email').val(displayEmail);
            } else {
                $('#email-area').after('<input id="hidden-email" name="email" type="hidden" value="' + displayEmail + '">');
            }
            $('#password').val('');
            $('#password_confirmation').val('');
            $('#password-reset-heading').after('<div class="mt-4"><span id="email_validation" class="text-red-500 text-sm font-semibold">※ 問題が発生したため、再度お試しください。</span></div>');
            return false;
        }
    });

    // バリデーション時に該当の入力箇所に色をつける
    if ($('#password_validation').length) {
        $('#password').addClass('border-red-400 border-2');
        $('#password_confirmation').addClass('border-red-400 border-2');
    }
})
