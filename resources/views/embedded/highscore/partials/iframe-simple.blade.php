@props([
    'game',
    'fontSize' => null,
    'bgColor' => null,
    'textColor' => null,
    'borderColor' => null,
])
@php(
    $query = http_build_query([
        'fontSize' => $fontSize,
        'bgColor' => $bgColor,
        'textColor' => $textColor,
        'borderColor' => $borderColor,
    ])
)

<iframe src="{{ route('games.embed.simple', $game) }}?{{ $query }}" title="Highscore table for {{ $game->title }}" width="100%" height="100%"></iframe>
