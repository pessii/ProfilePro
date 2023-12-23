@component('mail::message')
# お客様からのお問い合わせです

以下はお問い合わせ内容です：

- **名前**: {{ $data['name'] }}
- **メールアドレス**: {{ $data['email'] }}

@php
$type = $data['type'];
$types = [
    1 => 'サイトへの要望',
    2 => 'エラー',
    3 => '操作方法',
    4 => 'トラブル',
    99 => 'その他',
];
@endphp

- **タイプ**: {{ $types[$type] }}
- **メッセージ**:
  {{ $data['content'] }}

@endcomponent
