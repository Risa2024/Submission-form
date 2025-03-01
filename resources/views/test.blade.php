<!DOCTYPE html>
<html>
<head>
    <title>テストページ</title>
</head>
<body>
    <h1>テストページへようこそ</h1>
    
    <div>
        <!-- ここにコンテンツを追加 -->
    </div>

    @if(Auth::check())
        <div>
            {{ Auth::user()->name }}さん、こんにちは。
        </div>
    @else
        <div>
            ゲストさん、こんにちは。
        </div>
    @endif
</body>
</html> 