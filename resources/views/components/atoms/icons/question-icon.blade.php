{{-- クエスチョンアイコン(基本的にツールチップを付ける) --}}
{{-- 色は固定、サイズは都度指定 --}}
{{-- ※スマホにも対応させるためツールチップ付加時はjQueryUIを用いる --}}
@props(['title' => '', 'id' => ''])
<i {{ $attributes->merge(['title' => $title, 'id' => $id, 'class' => 'fas fa-question-circle text-pink-400 hover:text-pink-500 cursor-pointer']) }}></i>
